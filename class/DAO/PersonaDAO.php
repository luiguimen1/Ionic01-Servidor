<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonaDAO
 *
 * @author TECH INSTITUTE PC8
 */
class PersonaDAO {

    //put your code here
    public function crearPersona($json) {
        $Local = json_decode($json);
        $PersonaVO = new PersonaVO();
        $PersonaVO->setCc($Local->CC);
        $PersonaVO->setApellido($Local->APE);
        $PersonaVO->setGenero($Local->Genero);
        $PersonaVO->setNombre($Local->NOM);
        $PersonaVO->setPerfil($Local->perfil);
        $PersonaVO->setUrl($Local->URL);
        //      $sql="insert into persona (id,cc,nombre,apellido,URL,perfil,genero) "
        //              . "values (null,'".$PersonaVO->getCc()."','".$PersonaVO->getNombre()."',"
        //              . "'".$PersonaVO->getApellido()."','".$PersonaVO->getUrl()."','".$PersonaVO->getPerfil()."','".$PersonaVO->getGenero()."');";
        $sql = "insert into persona (id,cc,nombre,apellido,URL,perfil,genero) "
                . "values (null,?,?,?,?,?,?);";
        $bd = new ConectarBD();
        $comm = $bd->getMysqli();
        $smtp = $comm->prepare($sql);
        $c = $PersonaVO->getCc();
        $n = $PersonaVO->getNombre();
        $a = $PersonaVO->getApellido();
        $u = $PersonaVO->getUrl();
        $p = $PersonaVO->getPerfil();
        $g = $PersonaVO->getGenero();
        $smtp->bind_param("ssssss", $c, $n, $a, $u, $p, $g);

        $res = $smtp->execute();
        $smtp->close();
        $comm->close();
        return $res;
    }
    
    function ModiPersona($json){
        $Local = json_decode($json);
        $PersonaVO = new PersonaVO();
        $PersonaVO->setId($Local->ID);
        $PersonaVO->setCc($Local->CC);
        $PersonaVO->setApellido($Local->APE);
        $PersonaVO->setGenero($Local->Genero);
        $PersonaVO->setNombre($Local->NOM);
        $PersonaVO->setPerfil($Local->perfil);
        $PersonaVO->setUrl($Local->URL);        
        $sql = "update persona set cc=?,nombre=?,apellido=?,URL=?,perfil=?,genero=? where id =?;";
        $bd = new ConectarBD();
        $comm = $bd->getMysqli();
        $smtp = $comm->prepare($sql);
        $c = $PersonaVO->getCc();
        $n = $PersonaVO->getNombre();
        $a = $PersonaVO->getApellido();
        $u = $PersonaVO->getUrl();
        $p = $PersonaVO->getPerfil();
        $g = $PersonaVO->getGenero();
        $i = $PersonaVO->getId();
        $smtp->bind_param("ssssssi", $c, $n, $a, $u, $p, $g,$i);
        $res = $smtp->execute();
        $smtp->close();
        $comm->close();
        return $res;
    }
    
    
    
    
    

    public function listar() {
        $sql = "select * from persona;";
        $bd = new ConectarBD();
        echo json_encode($bd->query($sql));
    }

    public function listarID($json) {
        $Local = json_decode($json);
        $personaVO = new PersonaVO();
        $personaVO->setId($Local->ID);

        $sql = "select id,cc,nombre,apellido,URL,perfil,genero from persona where id = ?;";
        $bd = new ConectarBD();
        $conn = $bd->getMysqli();

        $stmp = $conn->prepare($sql);
        $id = $personaVO->getId();
        $stmp->bind_param("i", $id);
        $resp = $stmp->execute();
        $stmp->bind_result($id, $cc, $nombre, $apellido, $URL, $perfil, $genero);
        $data = $stmp->fetch();
        if ($data == 1) {
            $data = array();
            $data["ok"] = 1;
            $data["id"] = $id;
            $data["cc"] = $cc;
            $data["nombre"] = $nombre;
            $data["apellido"] = $apellido;
            $data["URL"] = $URL;
            $data["perfil"] = $perfil;
            $data["genero"] = $genero;
        }else{
            $data = array();
            $data["ok"] = 0;
        }
        echo json_encode($data);
        $stmp->close();
        $conn->close();
    }

    public function eliminar($json) {
        $Local = json_decode($json);
        $PersonaVO = new PersonaVO();
        $PersonaVO->setId($Local->ID);

        $sql = "delete from persona where id = ?;";
        $bd = new ConectarBD();
        $comm = $bd->getMysqli();
        $stmp = $comm->prepare($sql);
        $stmp->bind_param("i", $id);
        $id = $PersonaVO->getId();
        $res = $stmp->execute();
        $stmp->close();
        $comm->close();
        return $res;
    }

}
