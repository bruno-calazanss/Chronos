<?php

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
        $this->db->select('*');
        $this->db->from('relatorio');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $relatorio) {
            $retRelatorios[$i] = Relatorio::Builder($relatorio->estado, $relatorio->data, $relatorio->coordenador_usuario_id, 
                                                   $relatorio->aluno_usuario_id);
            $retRelatorios[$i]->set('id', $relatorio->id);
        }
        return $retRelatorios; 
    }

    function editar($campo_unico, $relatorio) {
        $dados =    ['id' => $relatorio->id,
                    'data' => $relatorio->data,
                    'coordenador_usuario_id' => $relatorio->coordenador_usuario_id,
                    'aluno_usuario_id' => $relatorio->aluno_usuario_id];
        $this->db->replace('relatorio', $dados);
    }

    function remover($campo_unico, $valor) {
        $this->db->where($campo_unico, $valor);
        $this->db->delete('relatorio');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('relatorio');
        $query = $this->db->get();

        foreach($query->result() as $i => $relatorio) {
            $retRelatorios[$i] = Relatorio::Builder($relatorio->estado, $relatorio->data, $relatorio->coordenador_usuario_id, 
                                                   $relatorio->aluno_usuario_id);
            $retRelatorios[$i]->set('id', $relatorio->id);
        }
        return $retRelatorios; 
    }
}

?>