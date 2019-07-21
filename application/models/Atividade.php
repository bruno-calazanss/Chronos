<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade extends CI_Model {

    public $id;
    public $relatorio_id;
    public $nome;
    public $data;
    public $qtd_horas;
    public $horas_validadas;
    public $categoria;
    public $comprovante;

    public static function Builder($id, $relatorio_id, $nome, $data, $qtd_horas, $categoria, $comprovante) {
        $atv = new Atividade();
        $atv->id = $id;
        $atv->relatorio_id = $relatorio_id;
        $atv->nome = $nome;
        $atv->data = $data;
        $atv->qtd_horas = $qtd_horas;
        $atv->categoria = $categoria;
        $atv->comprovante = $comprovante;
        return $atv;
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