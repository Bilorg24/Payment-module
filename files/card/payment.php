<?php 
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = json_decode(file_get_contents('php://input'), true);

    if ($jsonData !== null) {
        if (isset($jsonData['cardNumber'], $jsonData['cardName'], $jsonData['cardMonth'], $jsonData['cardYear'], $jsonData['cardCvv'], $jsonData['serviceId'])) {
            $cardNumber = $jsonData['cardNumber'];
            $cardName = $jsonData['cardName'];
            $cardMonth = $jsonData['cardMonth'];
            $cardYear = $jsonData['cardYear'];
            $cardCvv = $jsonData['cardCvv'];
            $serviceId = $jsonData['serviceId'];

            // Проверяем, что serviceId является целым числом в пределах от 1 до 4
            if (!filter_var($serviceId, FILTER_VALIDATE_INT) || $serviceId < 1 || $serviceId > 4) {
                http_response_code(400);
                echo "Ошибка: Некорректный serviceId";
                exit;
            }

            if (!empty($cardNumber) && !empty($cardName) && !empty($cardMonth) && !empty($cardYear) && !empty($cardCvv)) {
                $paymentToken = md5($cardNumber . $cardCvv . time());
                
                // Маппинг id к цене и названию услуг
                $services = [
                    1 => ["name" => "Покупка и продажа жилой недвижимости", "price" => 100000.00],
                    2 => ["name" => "Аренда жилой и коммерческой недвижимости", "price" => 5000.00],
                    3 => ["name" => "Консультации по ипотеке и кредитованию", "price" => 500.00],
                    4 => ["name" => "Юридическое сопровождение сделок с недвижимостью", "price" => 2000.00]
                ];

                $serviceName = $services[$serviceId]['name'];
                $amount = $services[$serviceId]['price'];
                $transactionId = uniqid();

                $checkQuery = "SELECT * FROM processed_payments WHERE payment_token='$paymentToken'";
                $checkResult = $conn->query($checkQuery);

                if ($checkResult->num_rows == 0) {
                    $sql = "INSERT INTO payments_log (transaction_id, service_name, amount, payment_date) VALUES ('$transactionId', '$serviceName', $amount, CURRENT_TIMESTAMP)";

                    if ($conn->query($sql) === TRUE) {
                        $processedQuery = "INSERT INTO processed_payments (payment_token) VALUES ('$paymentToken')";
                        $conn->query($processedQuery);

                        header('Content-Type: application/json');
                        echo json_encode([
                            'transactionId' => $transactionId,
                            'success' => true
                        ]);
                    } else {
                        http_response_code(500);
                        echo "Ошибка записи в базу данных: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    http_response_code(400);
                    echo "Ошибка: повторный запрос";
                }
            } else {
                http_response_code(400);
                echo "Ошибка: Не все поля карты заполнены";
            }
        } else {
            http_response_code(400);
            echo "Ошибка: Не все необходимые поля карты были переданы";
        }
    } else {
        http_response_code(400);
        echo "Ошибка: Неверный формат данных";
    }
} else {
    http_response_code(405);
    echo "Метод не поддерживается";
}
$conn->close();
?>