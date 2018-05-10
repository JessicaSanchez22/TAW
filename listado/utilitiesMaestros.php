<?php
$file = fopen("maestros.txt", "r");
while ($linea = fgets($file)) { //linea es mi archivo de texto en string
    $alumno= explode(' ', $linea);
}

$user_access[] = [
    'noempleado' => $alumno[0],
    'nombre' => $alumno[1],
    'carrera' => $alumno[2],
    'email' => $alumno[3],
    'telefono' => $alumno[4]
];

 fclose($file);
 ?>