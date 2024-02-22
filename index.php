TEST
<?php
if $_GET['test']==1{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AntPool Earnings</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            border: 2px solid #ffffff;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .value {
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ffffff;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
        }

        tr:nth-child(even) {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="label">Невыплаченный баланс:</div>
        <div class="value" id="earningsNoPay"></div>
    </div>
    <div class="container">
        <div class="label">Доход всего:</div>
        <div class="value" id="earningsTotal"></div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Параметр</th>
                    <th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Текущий хешрейт</td>
                    <td id="currentHashrate"></td>
                </tr>
                <tr>
                    <td>Хешрейт 1D</td>
                    <td id="hashrate1D"></td>
                </tr>
                <tr>
                    <td>Количество майнеров</td>
                    <td id="minerCount"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Функция для выполнения запроса к API и обновления значений на странице
        function fetchData() {
            var earningsUrl = 'https://www.antpool.com/auth/v3/observer/api/earnings/query?accessKey=fCfkRpJWdL3sQEC60kGn&coinType=BTC&observerUserId=GeorgyMB111';
            var hashUrl = 'https://www.antpool.com/auth/v3/observer/api/hash/query?accessKey=fCfkRpJWdL3sQEC60kGn&coinType=BTC&observerUserId=GeorgyMB111';

            // Получаем данные о доходе
            fetch(earningsUrl)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('earningsNoPay').innerText = data.data.earningsNoPay;
                    document.getElementById('earningsTotal').innerText = data.data.earningsTotal;
                })
                .catch(error => console.error('Ошибка получения данных о доходе:', error));

            // Получаем данные о хешрейте и майнерах
            fetch(hashUrl)
                .then(response => response.json())
                .then(data => {
                    // Вычисляем значения согласно заданным формулам
                    var currentHashrate = parseFloat(data.data.userHsNow) + 2 * 120;
                    var hashrate1D = parseFloat(data.data.userHsLast1D) + 2 * 120;
                    var minerCount = parseInt(data.data.onlineWorkerNum) + 2;

                    // Обновляем значения на странице
                    document.getElementById('currentHashrate').innerText = currentHashrate.toFixed(2) + ' ' + data.data.userHsNowUnit;
                    document.getElementById('hashrate1D').innerText = hashrate1D.toFixed(2) + ' ' + data.data.userHsLast1DUnit;
                    document.getElementById('minerCount').innerText = minerCount;
                })
                .catch(error => console.error('Ошибка получения данных о хешрейте и майнерах:', error));
        }

        // Вызываем функцию fetchData() при загрузке страницы
        window.onload = fetchData;
    </script>
 <iframe frameborder="0" allowfullscreen src="https://www.antpool.com/observer?accessKey=5mbOZCgWGbiCTWlSGS92&coinType=BTC&observerUserId=GeorgyMB111" title="description"></iframe> 
</body>
</html>
      <?php
      }
      ?>
