<?php

/* @var array $orders **/
/* @var array $products **/
/* @var array $categories **/
/* @var array $totalPriceOfProductsInCategories **/
/* @var array $totalPopularity **/

?>

<h1 class="mt-4 mb-5">Статистика</h1>
<div id="orderStatistic" style="width: 100%; height:400px;"></div>
<div id="orderPopularityStatistic" style="width: 100%; height:500px;"></div>
<div id="totalProductsCountAndPrice" style="width: 100%;height: 500px;"></div>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script type="text/javascript">
    // Статистика замовлень на певну суму
    let orderStatistic = echarts.init(document.getElementById('orderStatistic'));
    orderStatisticOption = {
        title: {
            text: 'Статистика замовлень на певну суму'
        },
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
    orderStatistic.setOption(orderStatisticOption);


    // Статистика популярності товарів за замовленнями
    let orderPopularityStatistic = echarts.init(document.getElementById('orderPopularityStatistic'));
    orderPopularityOption = {
        title: {
            text: 'Статистика популярності товарів за замовленнями'
        },
        grid: {
            bottom: 150,
        },
        xAxis: {
            <?php
            $categoriesName = '';
            foreach ($categories as $category) {
                $categoriesName .= "'" . $category['Name'] . "', ";
            }
            ?>
            data: [<?php echo $categoriesName?>],
            axisLabel: {
                interval: 0,
                rotate: 45,
            }
        },
        yAxis: {},
        series: [
            {
                <?php
                $orderTotalPopularity = '';
                foreach ($totalPopularity as $item) {
                    $orderTotalPopularity .= "'" . $item['TotalCount'] . "', ";
                }
                ?>
                data: [<?php echo $orderTotalPopularity?>],
                type: 'bar',
                smooth: true
            }
        ]
    };
    orderPopularityStatistic.setOption(orderPopularityOption);


    // Загальна вартість продуктів у кожній категорії
    let totalProductsCountAndPrice = echarts.init(document.getElementById('totalProductsCountAndPrice'));

    totalProductsCountAndPriceOption = {
        title: {
            text: 'Загальна вартість продуктів у кожній категорії'
        },
        grid: {
            bottom: 150,
        },
        xAxis: {
            <?php
            $categoriesName = '';
            foreach ($categories as $category) {
                $categoriesName .= "'" . $category['Name'] . "', ";
            }
            ?>
            data: [<?php echo $categoriesName?>],
            axisLabel: {
                interval: 0,
                rotate: 45,
            }
        },
        yAxis: {},
        series: [
            {
                type: 'bar',
                <?php
                $totalPrices = '';
                foreach ($totalPriceOfProductsInCategories as $totalPriceOfProductsInCategory) {
                    $totalPrices .= "'" . $totalPriceOfProductsInCategory['TotalCategoryPrice'] . "', ";
                }
                ?>
                data: [<?php echo $totalPrices?> 30000, 30000, 30000, 30000, 30000, 30000, 30000, 30000],
            }
        ]
    };

    totalProductsCountAndPrice.setOption(totalProductsCountAndPriceOption);

</script>

