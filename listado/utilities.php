<?php
$file = fopen("alumnos.txt", "r"); //Se abre el archivo de texto 
while ($linea = fgets($file)) { //linea es mi archivo de texto en string
    $alumno= explode(' ', $linea);//Mientras que existan registros va a ir separando en el arreglo alumno, los elementos de cada registro
}

$user_access[] = [
    'matricula' => $alumno[0], //Se le asignan los valores a cada una de las variables para poder imprimirlas después
    'nombre' => $alumno[1],
    'carrera' => $alumno[2],
    'email' => $alumno[3],
    'telefono' => $alumno[4]
];

 fclose($file);
 ?>