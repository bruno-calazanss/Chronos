<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('aluno');
    }

    function inserir($aluno) {
        $dados =    ['usuario_id' => $aluno->usuario_id,
                    'disc_nprevistas' => $aluno->disc_nprevistas,
                    'cursos_atualizacao' => $aluno->cursos_atualizacao,
                    'monitoria' => $aluno->monitoria,
                    'estagio_nobrigatorio' => $aluno->estagio_nobrigatorio,
                    'ev_internos' => $aluno->ev_internos,
                    'ev_externos' => $aluno->ev_externos,
                    'cursos_ext' => $aluno->cursos_ext,
                    'init_cientifica' => $aluno->init_cientifica,
                    'publicacoes' => $aluno->publicacoes,
                    'trab_cientifico' => $aluno->trab_cientifico];
        $this->db->insert('aluno', $dados);
    }

    function buscar($campo, $valor) {
        $this->db->select('*');
        $this->db->from('aluno');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $aluno) {
            $retAlunos[$i] = Aluno::Builder($aluno->usuario_id);
            $retAlunos[$i]->set('disc_nprevistas', $aluno->disc_nprevistas)->set('cursos_atualizacao', $aluno->cursos_atualizacao)
                          ->set('monitoria', $aluno->monitoria)->set('estagio_nobrigatorio', $aluno->estagio_nobrigatorio)->set('ev_internos', $aluno->ev_internos)
                          ->set('ev_externos', $aluno->ev_externos)->set('cursos_ext', $aluno->cursos_ext)->set('init_cientifica', $aluno->init_cientifica)
                          ->set('publicacoes', $aluno->publicacoes)->set('trab_cientifico', $aluno->trab_cientifico);
        }
        return $retAlunos; 
    }

    function editar($aluno) {
        $dados =    ['usuario_id' => $aluno->usuario_id,
                    'disc_nprevistas' => $aluno->disc_nprevistas,
                    'cursos_atualizacao' => $aluno->cursos_atualizacao,
                    'monitoria' => $aluno->monitoria,
                    'estagio_nobrigatorio' => $aluno->estagio_nobrigatorio,
                    'ev_internos' => $aluno->ev_internos,
                    'ev_externos' => $aluno->ev_externos,
                    'cursos_ext' => $aluno->cursos_ext,
                    'init_cientifica' => $aluno->init_cientifica,
                    'publicacoes' => $aluno->publicacoes,
                    'trab_cientifico' => $aluno->trab_cientifico];
        $this->db->replace('aluno', $dados);
        
    }

    function remover($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->delete('aluno');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('aluno');
        $query = $this->db->get();

        foreach($query->result() as $i => $aluno) {
            $retAlunos[$i] = Aluno::Builder($aluno->id);
            $retAlunos[$i]->set('disc_nprevistas', $aluno->disc_nprevistas)->set('cursos_atualizacao', $aluno->cursos_atualizacao)
                          ->set('monitoria', $aluno->monitoria)->set('estagio_nobrigatorio', $aluno->estagio_nobrigatorio)->set('ev_internos', $aluno->ev_internos)
                          ->set('ev_externos', $aluno->ev_externos)->set('cursos_ext', $aluno->cursos_ext)->set('init_cientifica', $aluno->init_cientifica)
                          ->set('publicacoes', $aluno->publicacoes)->set('trab_cientifico', $aluno->trab_cientifico);
        }
        return $retAlunos; 
    }

    function total_horas_computadas($usuario_id) {
        $aluno = $this->buscar('usuario_id', $usuario_id)[0];
        return $aluno->disc_nprevistas + $aluno->cursos_atualizacao + $aluno->monitoria + $aluno->estagio_nobrigatorio + 
               $aluno->ev_internos + $aluno->ev_externos + $aluno->cursos_ext + $aluno->init_cientifica + $aluno->publicacoes + 
               $aluno->trab_cientifico;
    }
}

?>