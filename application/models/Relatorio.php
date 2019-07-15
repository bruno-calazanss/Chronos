<?php

class Relatorio extends CI_Model {

    public $id;
    public $estado;
    public $data;
    public $coordenador_usuario_id;
    public $aluno_usuario_id;

    public static function Builder($estado, $data, $coordenador_usuario_id, $aluno_usuario_id) {
        $relatorio = new Relatorio();
        $relatorio->estado = $estado;
        $relatorio->data = $data;
        $relatorio->coordenador_usuario_id = $coordenador_usuario_id;
        $relatorio->aluno_usuario_id = $aluno_usuario_id;
        return $relatorio;
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