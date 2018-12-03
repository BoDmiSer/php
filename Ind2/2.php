<!DOCTYPE html>
<html>
<head>
    <title>oop</title>
</head>
<body>
    <?php
       /* function convertString($a,$b)
        {

            preg_match_all( '/'.preg_quote($b,"/").'/',$a,$t);
            if (count($t[0]) > 1)
            {
                $newa = preg_replace('/'.preg_quote($b,"/").'/',strrev($b),$a,2);
                $newa = preg_replace('/'.preg_quote(strrev($b),"/").'/',$b,$newa,1);
                return $newa;
            }
            else
                {
                return $t;
                }
        }
        $a = "q/we q/we w eweq qe qew q/w";
        $b = "q/w";
        $newstring = convertString($a,$b);
        var_dump($newstring);

        function mySortForKey ($a,$b)
        {
            $flag = false;
           foreach ($a as $key=>$value)
           {
               if ($key == $b)
               {
                   sort($a[$b]);
                   $flag = true;
               }
           }
           if (!$flag)
           {
               throw new Exception("Нет $b ключа");
           }
           return $a;
        }
        $a = array("3"=>array("a"=>2,"b"=>1),"2"=>array("a"=>4,"b"=>3),"4"=>array("a"=>5,"b"=>2),"1"=>array("a"=>4,"b"=>2));
        //var_dump($a);
        try
        {
            print_r(mySortForKey($a,5 ));
        }
        catch (Exception $e1)
        {
            echo "Исключение: ", $e1->getMessage(),"\n";
        }
*/


        function importXml($a)
        {
            $servername = "localhost";
            $database = "test_samson";
            $username = "";
            $password = "";
            $mysqli = new mysqli($servername, $username, $password, $database);
            $mysqli->set_charset("utf8");
            if (!$mysqli) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else{echo "Connected successfully";}
            if (file_exists($a))
            {
                $xml = simplexml_load_file($a);
                $json = json_encode($xml);
                $data = json_decode($json,TRUE);
            }
            else
                {
                    throw new Exception("Фалй $a не найден");
                }
            foreach ($data['Товар'] as $item)
            {
                //var_dump($item);
                $code = $item['@attributes']['Код'];
                $name = $item['@attributes']['Название'];
                $price = $item['Цена'][0];
                $price_2 = $item['Цена'][1];
                $properties = ($item['Свойства']);

                $sql_prod = "INSERT INTO test_samson.a_product (`код`,`название`) VALUES ('$code','$name')";
                var_dump($sql_prod);
                $mysqli->query($sql_prod);

                if (is_string($item['Разделы']['Раздел']))
                {
                    $part[0] = $item['Разделы']['Раздел'];
                    foreach ($part as $key => $part_name)
                    {
                        $sql_part = "INSERT INTO test_samson.a_category (`код`,`название`) VALUES ('$code','$part_name')";
                        var_dump($sql_part);
                        if ($mysqli->query($sql_part))
                        {
                            echo "New record created successfully";
                        }else
                        {
                           var_dump($mysqli->error_list);
                        }
                    }
                }
                else
                    {
                        $part = $item['Разделы']['Раздел'];
                        foreach ($part as $key => $part_name)
                        {
                            $sql_part1 = "INSERT INTO test_samson.a_category (`код`,`название`) VALUES ('$code','$part_name')";
                            var_dump($sql_part1);
                            $mysqli->query($sql_part1);
                            if (mysqli_query($mysqli, $sql_part1)) {
                                echo "New record created successfully";
                            }
                        }
                    }
                $sql_price = "INSERT INTO test_samson.a_price (`тип_цены`,`цена`)VALUES ('$price','$price_2')";
               var_dump($sql_price);
                if (mysqli_query($mysqli, $sql_price))
                {
                    echo "New record created successfully";
                }
                $mysqli->query($sql_price);
                foreach ($properties as $key2 => $properties_name)
                {
                    if (is_string($properties_name))
                    {
                        $sql_properties = "INSERT INTO test_samson.a_property  (`значение_свойства`) VALUES ('$properties_name')";
                        var_dump($sql_properties);
                        $mysqli->query($sql_properties);
                        if (mysqli_query($mysqli, $sql_properties)) {
                            echo "New record created successfully";
                        }
                    }
                    else
                    {
                        $sql_properties1 = "INSERT INTO test_samson.a_property  (`значение_свойства`) VALUES ('$properties_name[0]')";
                        $sql_properties2 = "INSERT INTO test_samson.a_property  (`значение_свойства`) VALUES ('$properties_name[1]')";
                        var_dump($sql_properties1);
                        var_dump($sql_properties2);
                        $mysqli->query($sql_properties1);
                        $mysqli->query($sql_properties2);
                        if (mysqli_query($mysqli, $sql_properties1)) {
                            echo "New record created successfully";
                        }
                        if (mysqli_query($mysqli, $sql_properties2)) {
                            echo "New record created successfully";
                        }

                    }

                }

            }
        }
        try
        {
            importXml("StructXML");
        }
        catch (Exception $e2)
        {
            echo "Исключение: ", $e2->getMessage(),"\n";
        }

    function exportXml($a)
    {

        $servername = "localhost";
        $database = "test_samson";
        $username = "";
        $password = "";
        $mysqli = new mysqli($servername, $username, $password, $database);
        $mysqli->set_charset("utf8");
        if (!$mysqli) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            echo "Connected successfully";
        }
        if (file_exists($a)) {
            $xml = simplexml_load_file($a);
            $json = json_encode($xml);
            $data = json_decode($json, TRUE);
        } else {
            throw new Exception("Фалй $a не найден");
        }
        $domtree = new DOMDocument('1.0','UTF-8');
        $xmlRoot = $domtree->createElement("РАЗДЕЛЫ");
        $xmlRoot = $domtree->appendChild($xmlRoot);
        $query = "SELECT `test_samson`.a_category.код FROM `a_category`";
        $newcode = $mysqli->query($query);
        while($row = mysqli_fetch_array($newcode))
        {
            $xmlRoot->appendChild($domtree->createElement('Раздел',$row['код']));
        }
        $query = "SELECT `test_samson`.a_category.название FROM `a_category`";
        $newcode = $mysqli->query($query);
        while($row = mysqli_fetch_array($newcode))
        {
            $xmlRoot->appendChild($domtree->createElement('Раздел',$row['название']));
        }


        $query = "SELECT `a_product`.`название` FROM `a_product`,`a_category` WHERE `a_product`.`код` = `a_category`.`код`";
        $newcode = $mysqli->query($query);
        while($row = mysqli_fetch_array($newcode))
        {

            $xmlRoot->appendChild($domtree->createElement('Название',$row['название']));

        }
        file_put_contents("StructXML1.xml", $domtree->saveXML());
        echo $domtree->saveXML();
    }
    try
    {
        exportXml("StructXML1");
    }
    catch (Exception $e2)
    {
        echo "Исключение: ", $e2->getMessage(),"\n";
    }



    ?>
</body>
</html>
