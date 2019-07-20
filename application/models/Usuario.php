<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    public $id;
    public $nome;
    public $matricula;
    public $email;
    public $nome_usr;
    public $senha;
    public $tipo;
    public $status;

    public static function Builder($nome, $matricula, $email, $nome_usr, $tipo, $status) {
        $usr = new Usuario();
        $usr->nome = $nome;
        $usr->matricula = $matricula;
        $usr->email = $email;
        $usr->nome_usr = $nome_usr;
        $usr->tipo = $tipo;
        $usr->status = $status;
        return $usr;
    }

    public function __call($nome, $args) {
        return null;
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