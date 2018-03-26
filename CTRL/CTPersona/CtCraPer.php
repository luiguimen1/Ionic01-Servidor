<?php
if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    require '../../class/DAO/PersonaDAO.php';
    require '../../class/VO/PersonaVO.php';
    require '../../class/bd/datos.php';
    require '../../class/bd/MySQLi.php';

    $PersonaDAO = new PersonaDAO();
    $res = Array();
    if (isset($_POST["pc"])) {
        $json = json_encode($_POST);
        $res["resp"] = $PersonaDAO->crearPersona($json) == 1 ? "ok" : "no";
    } else {
        $json = file_get_contents("php://input");
        //$json = json_decode($postdata);
        $res["resp"] = $PersonaDAO->crearPersona($json) == 1 ? "ok" : "no";
       // $res["resp"] ="si";
    }
    echo json_encode($res);
} else {
    header("location: ./");
}
