<?php
header('Access-Control-Allow-Origin: *');
$respuesta = array();

//$arreglo[] = (array) json_decode($_POST);
$postdata = file_get_contents("php://input");
$losdatos = json_decode($postdata);
$losdatos->ok="los datos ya estan aqui";

$respuesta["data"] = $losdatos;
echo json_encode($respuesta);