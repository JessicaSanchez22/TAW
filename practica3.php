<?php
	class Serie{
		/*Propiedades*/
		public $arreglo1;

		/*Métodos*/
		public function serieFibonacci(){
			echo "Serie original: ";
			$arreglo=$this->arreglo1;
			$len=count($arreglo);
			$fibo=array();
			/*Ciclo for que imprime el arreglo original*/
			for ($j=0; $j< $len ; $j++) { 
				echo $arreglo[$j]. ',';
			}	

			/*Ciclo for que crea e imprime la serie Fibonacci del arreglo*/
			echo "<br>Serie fibonacci: ";
			for ($i=0; $i < $len ; $i++) { 
				if ($i==0) {
					$fibo[$i]=$arreglo[$i];
				}

				elseif($i>=1) {
					$fibo[$i]=$arreglo[$i-1]+$arreglo[$i];
				}
				echo $fibo[$i]. ', ';
			}
			
		}
	}

	$serie= new Serie();
	$serie->arreglo1=array(4,57,8,9,4,5,64);
	$serie->serieFibonacci($serie->arreglo1);
?>