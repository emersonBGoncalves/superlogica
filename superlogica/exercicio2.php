<?php

$array = Array();

$array[] = "6542";
$array[] = "154";
$array[] = "3";
$array[] = "4121";
$array[] = "48548";
$array[] = "54653";
$array[] = "788";

echo $array[3] . "\n";

$array_string = implode(",", $array);

$array2 = explode(",", $array_string);
unset($array);

if(in_array(14,$array2))
{
	// contém o valor 14
}

$posicao_anterior = 0;
for($i = 0; $i < count($array2); $i++)
{
	if($i > 0 && isset($array2[$i]))
	{
		if($array2[$i] < $array2[$i - 1])
		{
			array_splice($array2, $i, 1);
		}
	}
}

array_pop($array2);

$qtd = count($array2);

array_reverse($array2);
?>