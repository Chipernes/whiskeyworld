<?php

/* @var array $orders **/

?>

<h1 class="mt-4 mb-5">Статистика</h1>
<div id="main" style="width: 600px;height:400px;"></div>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script type="text/javascript">
    let myChart = echarts.init(document.getElementById('main'));
    option = {
        xAxis: {
            <?php
                $orderIds = '';
                foreach ($orders as $order) {
                    $orderIds .= "'" . $order['OrderId'] . "', ";
                }
            ?>
            data: [<?php echo $orderIds?>],
        },
        yAxis: {},
        series: [
            {
                <?php
                $orderTotalPrices = '';
                foreach ($orders as $order) {
                    $orderTotalPrices .= "'" . $order['TotalPrice'] . "', ";
                }
                ?>
                data: [<?php echo $orderTotalPrices?>],
                type: 'line',
                smooth: true
            }
        ]
    };
    myChart.setOption(option);
</script>
<!--<script type="text/javascript">
    // Initialize the echarts instance based on the prepared dom
    let myChart = echarts.init(document.getElementById('main'));

    // Specify the configuration items and data for the chart
    let option = {
        title: {
            text: 'ECharts Getting Started Example'
        },
        tooltip: {},
        legend: {
            data: ['sales']
        },
        xAxis: {
            data: ['Shirts', 'Cardigans', 'Chiffons', 'Pants', 'Heels', 'Socks']
        },
        yAxis: {},
        series: [
            {
                name: 'sales',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }
        ]
    };

    // Display the chart using the configuration items and data just specified.
    myChart.setOption(option);
</script>-->

