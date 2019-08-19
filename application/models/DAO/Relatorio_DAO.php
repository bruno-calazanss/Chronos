<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('relatorio');
    }

    function inserir($relatorio) {
        $dados =    ['estado' => $relatorio->estado,
                    'data' => $relatorio->data,
                    'coordenador_usuario_id' => $relatorio->coordenador_usuario_id,
                    'aluno_usuario_id' => $relatorio->aluno_usuario_id];
        $this->db->insert('relatorio', $dados);
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $query = $this->db->where($campo, $valor)->get('relatorio');

        $retRelatorios = [];
        foreach($query->result() as $i => $relatorio) {
            $retRelatorios[$i] = Relatorio::Builder($relatorio->estado, $relatorio->data, $relatorio->coordenador_usuario_id, 
                                                   $relatorio->aluno_usuario_id);
            $retRelatorios[$i]->set('id', $relatorio->id);
        }
        return $retRelatorios; 
    }

    function editar($relatorio) {
        $dados =    ['id' => $relatorio->id,
                    'data' => $relatorio->data,
                    'coordenador_usuario_id' => $relatorio->coordenador_usuario_id,
                    'aluno_usuario_id' => $relatorio->aluno_usuario_id];
        return $this->db->replace('relatorio', $dados);
    }

    function remover($campo_unico, $valor) {
        return $this->db->where($campo_unico, $valor)->delete('relatorio');
    }

    function listar() {
        $query = $this->db->get('relatorio');

        $retRelatorios = [];
        foreach($query->result() as $i => $relatorio) {
            $retRelatorios[$i] = Relatorio::Builder($relatorio->estado, $relatorio->data, $relatorio->coordenador_usuario_id, 
                                                   $relatorio->aluno_usuario_id);
            $retRelatorios[$i]->set('id', $relatorio->id);
        }
        return $retRelatorios; 
    }

    function avaliar($id, $coordenador_usuario_id) {
        return $this->db->where('id', $id)->set('estado', 1)->set('coordenador_usuario_id', $coordenador_usuario_id)->update('relatorio');
    }
}

?>