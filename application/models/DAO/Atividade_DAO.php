<?php

class Atividade_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('atividade');
    }

    function inserir($atv) {
        $dados =    ['id' => $atv->id,
                     'relatorio_id' => $atv->relatorio_id,
                     'nome' => $atv->nome,
                     'data' => $atv->data,
                     'qtd_horas' => $atv->qtd_horas,
                     'categoria' => $atv->categoria,
                     'comprovante' => $atv->comprovante];
        $this->db->insert('atividade', $dados);
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $this->db->select('*');
        $this->db->from('atividade');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $atv) {
            $retAtividades[$i] = Atividade::Builder($atv->id, $atv->relatorio_id, $atv->nome, $atv->data, $atv->qtd_horas, $atv->comprovante);
        }
        return $retAtividades; 
    }

    function editar($campo_unico, $atv) {
        $dados =    ['id' => $atv->id,
                     'relatorio_id' => $atv->relatorio_id,
                     'nome' => $atv->nome,
                     'data' => $atv->data,
                     'qtd_horas' => $atv->qtd_horas,
                     'categoria' => $atv->categoria,
                     'comprovante' => $atv->comprovante];
        $this->db->replace('atividade', $dados);
    }

    function remover($campo_unico, $valor) {
        $this->db->where($campo_unico, $valor);
        $this->db->delete('atividade');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('atividade');
        $query = $this->db->get();

        foreach($query->result() as $i => $atv) {
            $retAtividades[$i] = Atividade::Builder($atv->id, $atv->relatorio_id, $atv->nome, $atv->data, $atv->qtd_horas, $atv->comprovante);
        }
        return $retAtividades; 
    }
}

?>