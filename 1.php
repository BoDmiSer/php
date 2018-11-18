<!DOCTYPE html>
<html>
<head>
	<title>Task</title>
</head>
<body>
	<?php

		// 1 Задание
		// Создаю функцию с входящими 2 папрметрами
		echo("1 Задание"."<br>");
		function findSimple ($a,$b)
		{
			// Создаю пустой массив и в цикле добавляю новое значение элементам массива
			$array = array();
			while ($a <= $b) 
			{
				if ($a <= 3)
				{
					$array[] = $a;
				}
				if ($a % 2 ==0) 
				{			
					$a++;
					continue;
				}
				$k = 0;
				if ($a > 3)
				{
					$i = 3;					
					while ($i < $a)
					{
						if ($a % $i == 0)
						{
							$k = 0;
							break;					
						}
						else
						{
							$k = 1;
							$i+=2;
						}
					}
					if ($k == 1) 
					{
						$array[] = $a;
					}
				}
				$a++;
			}
			// На выходе получаю массив, состоящий из цифр
			return $array;
		}
		$a = 1;
		$b = 150;
		// Проверяю, если входящие числа являются типом integer то запускаю функцию
		if ((is_int($a)) && (is_int($b))) 
		{
			$array = (findSimple($a,$b));
			var_dump($array);
		}		
		echo("<br><br>");

		// 2 Задание
		echo("2 Задание"."<br>");
		function createTrapeze($a)
		{
			$array_new[] =array();
			$i = 0;
			if (!(count($a) % 3))
			{	
				$k = 0;		
				while ($i < count($a)/3)
				{
					
					for ($j=0; $j < 3; $j++)
					{						
						$array_new[$i] = array("a"=>$a[$k],"b"=>$a[$k+1],"c"=>$a[$k+2]);
					}
				$k+=3;			
				$i++;
				}
			return $array_new;
			}
			else
			{
				return "Массив не кратен 3";
			}
		}

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 1, 2, 3, 14, 15, 16, 3, 4, 5);
		$array_new = createTrapeze($array);
		print_r($array_new);
		echo("<br><br>");
		//var_dump($array_new);

		// 3 Задание
		echo("3 Задание"."<br>");
		function squareTrapeze($a)
		{
			$i =0;
			while ( $i < count($a)) 
			{
				$a_1 = $a[$i]["a"];
				$b = $a[$i]["b"];
				$h = $a[$i]["c"];
				$s = ($a_1+$b)*$h/2;
				$a[$i]["s"] = $s;
				$i++;
			}
			return $a;
		}
		$array_new_2 = squareTrapeze($array_new);
		print_r($array_new_2);
		echo("<br><br>");

		// 4 Задание
		echo("4 Задание"."<br>");
		function getSizeForLimit($a,$b)
		{	
			$array_new_4[] = array();	
			$i = 0;
			foreach ($a as $key => $value)
			{				
				if (($a[$key]["s"])&&($a[$key]["s"] <= $b)) 
					{
						$array_new_4[$i] = $a[$key];
						$i++;
					}			
				
			}			
			return $array_new_4;			
		}
		$b = 67.5;
		$array_new_3 = getSizeForLimit($array_new_2,$b);
		print_r($array_new_3);
		echo("<br><br>");

		// 5 Задание
		echo("5 Задание"."<br>");
		function getMin($a)
		{

			$min = reset($a);
			foreach ($a as $key => $value)
			{
				if ($a[$key]<$min) 
				{
					$min = $a[$key];
				}
			}
			return $min;

		}
		$array_new_5 = array("a"=>5,"b"=>2,"c"=>6,"d"=>5,"e"=>2,"f"=>7);
		//$array_new_5 = array(3,4,5,7,6,3,3);
		$min = getMin($array_new_5);
		echo("min = ").$min;
		echo("<br><br>");

		// 6 Задание
		echo("6 Задание"."<br>");
		function printTrapeze($a)
		{
			echo '<table cellspacing="0" border="1">';
			foreach ($a as $key => $value) 
			{
				echo "<tr>";
				foreach ($value as $key_1 => $value_1) 
				{
					if ($key_1 == "s") 
					{
						if ($value_1 % 2) 
						{
							echo "<td bgcolor = silver  >Площадь $key_1 = "."$value_1"."</td>";
						}
						else
						{
							echo "<td bgcolor = white  >Площадь $key_1 = "."$value_1"."</td>";
						}
					}
					else
					{
						echo "<td>Сторона $key_1 = "."$value_1"."</td>";	
					}					
				}
				echo "</tr>";
			}
			echo "</table>";

		}

		printTrapeze($array_new_2);
		echo("<br>");

		// 7 - 8 Задание
		echo("7 - 8 Задание"."<br>");

		abstract class BaseMath
		{
			protected $f;
			function __construct($a,$b,$c)
			{
				$this->f =($a*($b**$c)+((($a/$c)**$b)%3)**min($a,$b,$c));
			}	
			public function exp1($a,$b,$c)
			{return $a*($b**$c);}
			public function exp2($a,$b,$c)
			{return ($a/$b)**$c;}
			public function getValue()
			{return $this->f;}
		}

		class F1 extends BaseMath
		{		
			function __construct($a,$b,$c)
			{
				parent::__construct($a,$b,$c);
			}

		}

		$new_class = new F1(3,4,5);
		echo "Результат рабооты метода getValue() = ".$new_class->getValue();
		echo "<br>";
		echo 'Результат рабооты метода exp1($a,$b,$c) = '.$new_class->exp1(1,2,3);
		echo "<br>";
		echo 'Результат рабооты метода exp2($a,$b,$c) = '.$new_class->exp2(1,2,3);
		echo "<br>";
	?>

</body>
</html>