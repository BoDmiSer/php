<!DOCTYPE html>
<html>
<head>
    <title>oop</title>
</head>
<body>
    <?php
        function convertString($a,$b)
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

        function importXml($a)
        {
            if (file_exists($a))
            {
                $xml = simplexml_load_file($a);
              //  print_r($xml);
            }
            else
                {
                    throw new Exception("Фалй $a не найден");
                }
            foreach ($xml -> Товар as $row)
            {
                $Товар = $row->Товар;
            }
            $sql = "INSERT INTO `StructXML`(`Товар`)"." VALUES (`$Товар`)";
            return $sql;
        }
        try
        {
            importXml("StructXML");
        }
        catch (Exception $e2)
        {
            echo "Исключение: ", $e2->getMessage(),"\n";
        }
        $mysqli = new mysqli("localhost","","","test_samson");
        if ($mysqli->connect_errno)
        {
            die('Ошибка подключения ('.$mysqli->connect_errno.')'.$mysqli->connect_error);
        }



    ?>
</body>
</html>
