<?php
	/*Ordenar el arreglo ascendente*/
	$arreglo=array(1,4,2,3,5,9,21);
	$len = count($arreglo);
	sort($arreglo);
	echo "Ascendente: "; 
	for($i=0; $i<$len; $i++){
	  echo $arreglo[$i];
	  echo ', ';
	}

	/*Ordenar el arreglo descendente*/
	rsort($arreglo);
	echo "Descendente: ";
	for($i=0; $i<$len; $i++){
	  echo $arreglo[$i];
	  echo', ';
	}

	/*Imprime mi nombre y ciudad*/
	$minombre= "Jessica";
	$miciudad = "Ciudad Victoria";

	echo "<p> Mi nombre es <b>". $minombre . " </b> y vivo en ". $miciudad . "</p>";

	/*Llenar el arreglo de 10 posiciones e imprimirlo con un ciclo for*/
	$arreglito=array(4,2,3,0,6,7,3,2,8,9,6);
	for($j=0; $j<10; $j++)
	{
		echo "Arreglo en posicion ".$j.": ". $arreglito[$j]. "<br>";
	}
?>