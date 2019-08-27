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
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $query = $this->db->where($campo, $valor)->get('aluno');

        $retAlunos = [];
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
        return $this->db->replace('aluno', $dados);
    }

    function remover($usuario_id) {
        return $this->db->where('usuario_id', $usuario_id)->delete('aluno');
    }

    function listar() {
        $query = $this->db->get('aluno');

        $retAlunos = [];
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

    function atualizar_somatorios($usuario_id, $atividades) {
        $aluno = $this->buscar('usuario_id', $usuario_id)[0];

        $this->db->trans_start();
        foreach($atividades as $atv) {
            switch($atv->categoria) {
                case 10: {
                    $this->db->set('disc_nprevistas', $aluno->disc_nprevistas + $atv->horas_validadas);
                    break;
                }
                case 11: {
                    $this->db->set('cursos_atualizacao', $aluno->cursos_atualizacao + $atv->horas_validadas);
                    break;
                }
                case 12: {
                    $this->db->set('monitoria', $aluno->monitoria + $atv->horas_validadas);
                    break;
                }
                case 13: {
                    $this->db->set('estagio_nobrigatorio', $aluno->estagio_nobrigatorio + $atv->horas_validadas);
                    break;
                }
                case 20: {
                    $this->db->set('ev_internos', $aluno->ev_internos + $atv->horas_validadas);
                    break;
                }
                case 21: {
                    $this->db->set('ev_externos', $aluno->ev_externos + $atv->horas_validadas);
                    break;
                }
                case 22: {
                    $this->db->set('cursos_ext', $aluno->cursos_ext + $atv->horas_validadas);
                    break;
                }
                case 30: {
                    $this->db->set('init_cientifica', $aluno->init_cientifica + $atv->horas_validadas);
                    break;
                }
                case 31: {
                    $this->db->set('publicacoes', $aluno->publicacoes + $atv->horas_validadas);
                    break;
                }
                case 32: {
                    $this->db->set('trab_cientifico', $aluno->trab_cientifico + $atv->horas_validadas);
                    break;
                }
            }
            $this->db->where('usuario_id', $usuario_id)->update('aluno');
        }
        return $this->db->trans_complete();
    }

    function verificar_limites($id) {
        $aluno = $this->buscar('usuario_id', $id)[0];
        if($aluno) {
            $ret['ensino'] = 60-($aluno->disc_nprevistas+$aluno->cursos_atualizacao+$aluno->monitoria+$aluno->estagio_nobrigatorio);
            $ret[10] = 20-$aluno->disc_nprevistas;
            $ret[11] = 20-$aluno->cursos_atualizacao;
            $ret[12] = 20-$aluno->monitoria;
            $ret[13] = 20-$aluno->estagio_nobrigatorio;
            $ret['extensao'] = 40-($aluno->ev_internos+$aluno->ev_externos+$aluno->cursos_ext);
            $ret[20] = 30-$aluno->ev_internos;
            $ret[21] = 30-$aluno->ev_externos;
            $ret[22] = 10-$aluno->cursos_ext;
            $ret['pesquisa'] = 30-($aluno->init_cientifica+$aluno->publicacoes+$aluno->trab_cientifico);
            $ret[30] = 20-$aluno->init_cientifica;
            $ret[31] = 20-$aluno->publicacoes;
            $ret[32] = 20-$aluno->trab_cientifico;
        } else {
            return FALSE;
        }
        return $ret;
    }

    function somatorio_atividades($atvs) {
        foreach($atvs as $atv) {
            if(!isset($ret[$atv->categoria])) $ret[$atv->categoria] = 0;
            $ret[$atv->categoria] += $atv->qtd_horas;
            if($atv->categoria < 20) {
                if(!isset($ret['ensino'])) $ret['ensino'] = 0;
                $ret['ensino'] += $atv->qtd_horas;
            }
            elseif($atv->categoria < 30) {
                if(!isset($ret['extensao'])) $ret['extensao'] = 0;
                $ret['extensao'] += $atv->qtd_horas;
            }
            else {
                if(!isset($ret['pesquisa'])) $ret['pesquisa'] = 0;
                $ret['pesquisa'] += $atv->qtd_horas;
            }
        }
        return $ret;
    }
}

?>