// const daily = document.getElementById('dailyExpenses').getContext('2d');
// const myChart = new Chart(daily, {
//     type: 'pie',
//     responsive: true,
//     data: {
//         labels: ["Load", "Transportation", "Delivery"],
//         datasets: [{
//             data: [
//                 "<?php
//                 while ($pie_daily = mysqli_fetch_array($query)) {
//                     echo '"' . $pie_daily['SUM(l_amount)'] . '",';
//                 }
//                 ?>"
//             ],
//             backgroundColor: ['#031166', '#010538', '#FEE6AA'],
//             borderWidth: 1
//         }]
//     },
//     options: {

//     },
//     plugins: [ChartDataLabels]
// });