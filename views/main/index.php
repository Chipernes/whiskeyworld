<?php
    echo $_GET['route'];

    echo '<h1>PHP + MySQL + AlcoWorld</h1>';

    function printResults($result) {
        if ($result->num_rows > 0) {
            //print_r($result->fetch_all());
            while ($row = $result->fetch_assoc()) {
                echo '<br>';

                echo "<b>ID:</b> ".$row['ProductId'].'. '.'<br>';
                echo "<b>Name:</b> ".$row['Name'].'<br>';
                if (!empty($row['Type'])) {
                    echo "<b>Type:</b> ".$row['Type'].'<br>';
                }
                echo "<b>Color:</b> ".$row['Color'].'<br>';
                echo "<b>Volume:</b> ".$row['Volume'].'<br>';
                echo "<b>Strength:</b> ".$row['Strength'].'<br>';
                echo "<b>Country:</b> ".$row['Country'].'<br>';
                echo "<b>Taste:</b> ".$row['Taste'].'<br>';
                if (!empty($row['Aging'])) {
                    echo "<b>Aging:</b> ".$row['Aging'].'<br>';
                }
                if (!empty($row['GrapeVariety'])) {
                    echo "<b>GrapeVariety:</b> ".$row['GrapeVariety'].'<br>';
                }
                echo "<b>Price:</b> ".$row['Price'].'<br>';
                echo "<b>Image:</b> ".$row['Image'].'<br>';
                print_r('<img src="img/'.$row['Image'].'.jpg" alt="">');

                echo '<hr>';
            }
        }
    }

    $mysql = new mysqli("AlcoWorld", "AlcoWorld", "AlcoWorld", "AlcoWorld");
    $mysql->query("SET NAMES 'utf8'");

    if($mysql->connect_error) {
        echo 'Error number: '.$mysql->connect_errno.'<br>';
        echo 'Error: '.$mysql->connect_error;
    } else {
        echo 'Host info: '.$mysql->host_info.'<br>'.'<br>'.'<br>';

        $result = $mysql->query("SELECT * FROM `Products`");

        /*$joinResult = $mysql->query(
            "SELECT Categories.Name AS 'Вид алкоголю', COUNT(Categories.AlcoholId) AS 'Кількість алкоголю'
                   FROM Categories
                   JOIN Products ON Categories.AlcoholId = Products.AlcoholId
                   GROUP BY Categories.AlcoholId
        ");

        //print_r($joinResult->fetch_all());
        while ($row = $joinResult->fetch_assoc()) {
            echo '<br>';

            echo "<b>Вид алкоголю:</b> ".$row['Вид алкоголю'].'. '.'<br>';
            echo "<b>Кількість алкоголю:</b> ".$row['Кількість алкоголю'].'<br>';

            echo '<hr>';
        }*/

        printResults($result);
    }

    $mysql->close();
