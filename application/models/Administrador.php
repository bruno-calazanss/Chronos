<?php

class Administrador extends CI_Model {

    public $usuario_id;

    public static function Builder($usuario_id) {
        $adm = new Administrador();        
        $adm->usuario_id = $usuario_id;
        return $adm;
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