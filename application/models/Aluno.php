<?php

class Aluno extends CI_Model {

    public $usuario_id;
    public $disc_nprevistas = 0;
    public $cursos_atualizacao = 0;
    public $monitoria = 0;
    public $estagio_nobrigatorio = 0;
    public $ev_internos = 0;
    public $ev_externos = 0;
    public $cursos_ext = 0;
    public $init_cientifica = 0;
    public $publicacoes = 0;
    public $trab_cientifico = 0;

    public static function Builder($usuario_id) {
        $aluno = new Aluno();        
        $aluno->usuario_id = $usuario_id;
        return $aluno;
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