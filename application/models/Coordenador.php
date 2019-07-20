<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordenador extends CI_Model {

    public $usuario_id;

    public static function Builder($usuario_id) {
        $coordenador = new Coordenador();        
        $coordenador->usuario_id = $usuario_id;
        return $coordenador;
    }

    public function get($campo) {
        return $$campo;
    }

    public function set($campo, $val) {
        $this->$campo = $val;
        return $this;
    }
}

?>