<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordenador_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('coordenador');
    }

    function inserir($coordenador) {
        $dados = ['usuario_id' => $coordenador->usuario_id];
        $this->db->insert('coordenador', $dados);
    }

    function buscar($campo, $valor) {
        $this->db->select('*');
        $this->db->from('coordenador');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $coordenador) {
            $retCoordenadores[$i] = Coordenador::Builder($coordenador->id);
        }
        return $retCoordenadores; 
    }

    function editar($coordenador) {
        $dados = ['usuario_id' => $coordenador->usuario_id];
        $this->db->replace('coordenador', $dados);
        
    }

    function remover($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->delete('coordenador');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('coordenador');
        $query = $this->db->get();

        foreach($query->result() as $i => $coordenador) {
            $retCoordenadores[$i] = Coordenador::Builder($coordenador->id);
        }
        return $retCoordenadores; 
    }
}

?>