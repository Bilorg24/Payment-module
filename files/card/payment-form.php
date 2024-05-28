<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма оплаты</title>
    <link rel="stylesheet" type="text/css" href="card-style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
</head>
<body>
    <div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>     
            <div class="card-item__wrapper">
              <div class="card-item__top">
                <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
                <div class="card-item__type">
                  <transition name="slide-fade-up">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                  </transition>
                </div>
              </div>
              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-if="getCardType === 'amex'">
                 <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
                </template>
                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div
                        class="card-item__numberItem"
                        v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                      >*</div>
                      <div class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        :key="$index" v-else-if="cardNumber.length > $index">
                        {{cardNumber[$index]}}
                      </div>
                      <div
                        class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        v-else
                        :key="$index + 1"
                      >{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>
              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__holder">Держатель</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2">Ivanov Ivan</div>
                  </transition>
                </label>
                <div class="card-item__date" ref="cardDate">
                  <label for="cardMonth" class="card-item__dateTitle">Мес/Год</label>
                  <label for="cardMonth" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                      <span v-else key="2">MM</span>
                    </transition>
                  </label>
                  /
                  <label for="cardYear" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                      <span v-else key="2">YY</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-item__side -back">
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>
            <div class="card-item__band"></div>
            <div class="card-item__cvv">
                <div class="card-item__cvvTitle">CVV</div>
                <div class="card-item__cvvBand">
                  <span v-for="(n, $index) in cardCvv" :key="$index">
                    *
                  </span>
              </div>
                <div class="card-item__type">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                </div>
            </div>
          </div>
        </div>
      </div>
      <form onsubmit="event.preventDefault(); submitPayment();">
      <div class="card-form__inner">
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Номер карты</label>
          <input type="text" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Держатель</label>
          <input type="text" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
        </div>
        <div class="card-form__row">
          <div class="card-form__col">
            <div class="card-form__group">
              <label for="cardMonth" class="card-input__label">Срок действия карты</label>
              <select class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Месяц</option>
                <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                    {{n < 10 ? '0' + n : n}}
                </option>
              </select>
              <select class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Год</option>
                <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                    {{$index + minCardYear}}
                </option>
              </select>
            </div>
          </div>
          <div class="card-form__col -cvv">
            <div class="card-input">
              <label for="cardCvv" class="card-input__label">CVC</label>
              <input type="text" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="3" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
            </div>
          </div>
        </div>

        <button id="submitPaymentButton" type="submit" class="card-form__button">
          Оплатить
        </button>
      </div>
    </div>
  </div>
  </form>
<!-- partial -->
<!-- Обработка кнопки оплатить -->
<script>
let paymentInProgress = false; // Объявляем переменную paymentInProgress и инициализируем её значением false

function submitPayment() {
    if (!paymentInProgress) {
        paymentInProgress = true;

        const urlParams = new URLSearchParams(window.location.search);  // Получаем параметры из URL
        const serviceId = urlParams.get('serviceId');  // Извлекаем значение serviceId

        // Теперь мы можем использовать serviceId в нашем коде
        console.log('ID услуги:', serviceId); // Устанавливаем флаг в true для предотвращения повторной отправки
        const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, ''); // удалить все пробелы
        const cardName = document.getElementById('cardName').value;
        const cardMonth = document.getElementById('cardMonth').value;
        const cardYear = document.getElementById('cardYear').value;
        const cardCvv = document.getElementById('cardCvv').value;

        console.log('Полученные данные:');
        console.log('Номер карты:', cardNumber);
        console.log('Держатель карты:', cardName);
        console.log('Месяц:', cardMonth);
        console.log('Год:', cardYear);
        console.log('CVV:', cardCvv);
        console.log('ID:', serviceId);

        const testCardNumber = "4111111111111111"; // Тестовый номер карты для оплаты
        const testCardCvv = "123"; // Тестовый CVV

        // Дополнительные проверки
        if (!/^\d{16}$/.test(cardNumber)) {
            console.error('Ошибка: Некорректный номер карты.');
            alert('Некорректный номер карты.');
            paymentInProgress = false; // Сброс флага
            return;
        }

        if (cardCvv.length !== 3 || !cardCvv.match(/^\d+$/)) {
            console.error('Ошибка: Некорректный CVV.');
            alert('Некорректный CVV.');
            paymentInProgress = false; // Сброс флага
            return;
        }

        // Проверка введенных данных на тестовую карту
        console.log('Проверка данных на тестовую карту...');
        if (cardNumber === testCardNumber && cardCvv === testCardCvv) {
            console.log('Данные прошли проверку.');

            const jsonData = {
                cardNumber: cardNumber,
                cardName: cardName,
                cardMonth: cardMonth,
                cardYear: cardYear,
                cardCvv: cardCvv,
                serviceId: serviceId  // Добавляем serviceId в данные для отправки
            };

            console.log('Отправка данных на сервер...');
            // Отправка данных на сервер
            fetch('/files/card/payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Полученный ответ:');
                console.log(data);
                if (data.success) {
                    alert('Оплата прошла успешно! ID транзакции: ' + data.transactionId);
                } else {
                    alert('Ошибка оплаты. ' + data.message);
                }
            })
            .catch(error => {
                console.error('Произошла ошибка:', error);
                alert('Произошла ошибка при обработке оплаты');
            })
            .finally(() => {
                console.log('Завершение обработки оплаты.');
                paymentInProgress = false; // Установка флага в false независимо от результата
            });
        } else {
            console.error('Ошибка: данные не прошли проверку.');
            alert('Пожалуйста, используйте тестовую карту для оплаты.');
            paymentInProgress = false; // Сброс флага
        }
    }
}
</script>

 <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<script  src="./script.js"></script>
</body>
</html>