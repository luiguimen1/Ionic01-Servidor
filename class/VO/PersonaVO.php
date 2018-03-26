<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonaVO
 *
 * @author TECH INSTITUTE PC8
 */
class PersonaVO {
    //put your code here
   private $id;
   private $cc;
   private $nombre;
   private $apellido;
   private $url;
   private $perfil;
   private $genero;
   
   
   public function getId() {
       return $this->id;
   }

   public function getCc() {
       return $this->cc;
   }

   public function getNombre() {
       return $this->nombre;
   }

   public function getApellido() {
       return $this->apellido;
   }

   public function getUrl() {
       return $this->url;
   }

   public function getPerfil() {
       return $this->perfil;
   }

   public function getGenero() {
       return $this->genero;
   }

   public function setId($id) {
       $this->id = $id;
   }

   public function setCc($cc) {
       $this->cc = $cc;
   }

   public function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   public function setApellido($apellido) {
       $this->apellido = $apellido;
   }

   public function setUrl($url) {
       $this->url = $url;
   }

   public function setPerfil($perfil) {
       $this->perfil = $perfil;
   }

   public function setGenero($genero) {
       $this->genero = $genero;
   }
    
}
