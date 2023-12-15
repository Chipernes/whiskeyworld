<?php

/* @var array $orders **/
/* @var array $groupedOrdersByDateAndPrice **/
/* @var array $products **/
/* @var array $categories **/
/* @var array $totalPriceOfProductsInCategories **/
/* @var array $totalCountOfProductsInCategories **/
/* @var array $totalPopularity **/
/* @var array $userGenders **/
/* @var array $ordersStatuses **/

?>

<h1 class="mt-4 mb-5">Статистика</h1>
<div id="orderStatistic" style="width: 100%; height:400px;"></div>
<div id="orderPopularityStatistic" style="width: 100%; height:500px;"></div>
<div id="totalProductsCountAndPrice" style="width: 100%;height: 500px;"></div>
<div id="totalProductsCount" style="width: 100%;height: 500px;"></div>
<div id="userGenders" style="width: 100%;height: 500px;"></div>
<div id="orders" style="width: 100%;height: 500px;"></div>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script type="text/javascript">
    // Статистика замовлень на певну суму
    let orderStatistic = echarts.init(document.getElementById('orderStatistic'));
    orderStatisticOption = {
        title: {
            text: 'Статистика замовлень на по даті'
        },

        xAxis: {
            <?php
                $date = '';
                foreach ($groupedOrdersByDateAndPrice as $item) {
                    $date .= "'" . $item['Date'] . "', ";
                }
            ?>
            data: [<?php echo $date?>],
            axisLabel: {
                interval: 0,
                rotate: 45,
            }
        },
        yAxis: {},
        series: [
            {
                <?php
                $orderTotalPrices = '';
                foreach ($groupedOrdersByDateAndPrice as $item) {
                    $orderTotalPrices .= "'" . $item['TotalPrice'] . "', ";
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
                data: [<?php echo $totalPrices?>],
            }
        ]
    };

    totalProductsCountAndPrice.setOption(totalProductsCountAndPriceOption);


    // Загальна кількість продуктів у кожній категорії
    let totalProductsCount = echarts.init(document.getElementById('totalProductsCount'));

    totalProductsCountOption = {
        title: {
            text: 'Загальна кількість продуктів у кожній категорії'
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
                $totalCounts = '';
                foreach ($totalCountOfProductsInCategories as $totalCountOfProductsInCategory) {
                    $totalCounts .= "'" . $totalCountOfProductsInCategory['TotalCategoryCount'] . "', ";
                }
                ?>
                data: [<?php echo $totalCounts?>],
            }
        ]
    };

    totalProductsCount.setOption(totalProductsCountOption);



    // Статистика гендеру користувачів
    let userGenders = echarts.init(document.getElementById('userGenders'));

    userGendersOption = {
        title: {
            text: 'Статистика по обробці замовлень'
        },
        grid: {
            bottom: 150,
        },
        series: [
            {
                type: 'pie',
                data: [
                    {
                        value: <?php echo $userGenders[0]['GenderCount'] ?>,
                        name: 'Не встановлено'
                    },
                    {
                        value: <?php echo $userGenders[1]['GenderCount'] ?>,
                        name: 'Чоловічий'
                    },
                    {
                        value: <?php echo $userGenders[2]['GenderCount'] ?>,
                        name: 'Жіночий'
                    }
                ]
            }
        ]
    };

    userGenders.setOption(userGendersOption);


    // Статистика замовлень
    let orders = echarts.init(document.getElementById('orders'));

    ordersOption = {
        title: {
            text: 'Статистика по статі користувачів'
        },
        grid: {
            bottom: 150,
        },
        series: [
            {
                type: 'pie',
                data: [
                    {
                        value: <?php echo $ordersStatuses[0]['StatusCount'] ?>,
                        name: 'В обробці'
                    },
                    {
                        value: <?php echo $ordersStatuses[1]['StatusCount'] ?>,
                        name: 'Оброблено'
                    },
                    {
                        value: <?php echo $ordersStatuses[2]['StatusCount'] ?>,
                        name: 'Доставлено'
                    }
                ]
            }
        ]
    };

    orders.setOption(ordersOption);

</script>

