<?php
if($_POST){
    header('Access-Control-Allow-Origin: *');
    require '../../class/DAO/PersonaDAO.php';
    require '../../class/VO/PersonaVO.php';
    require '../../class/bd/datos.php';
    require '../../class/bd/MySQLi.php';
    
    $PersonaDAO = new PersonaDAO();
    $PersonaDAO->listar();
}else{
    header("location: ./");
}