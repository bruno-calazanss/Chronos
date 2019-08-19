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
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $query = $this->db->where($campo, $valor)->get('coordenador');

        $retCoordenadores = [];
        foreach($query->result() as $i => $coordenador) {
            $retCoordenadores[$i] = Coordenador::Builder($coordenador->id);
        }
        return $retCoordenadores; 
    }

    function editar($coordenador) {
        $dados = ['usuario_id' => $coordenador->usuario_id];
        return $this->db->replace('coordenador', $dados); 
    }

    function remover($usuario_id) {
        return $this->db->where('usuario_id', $usuario_id)->delete('coordenador');
    }

    function listar() {
        $query = $this->db->get('coordenador');

        $retCoordenadores = [];
        foreach($query->result() as $i => $coordenador) {
            $retCoordenadores[$i] = Coordenador::Builder($coordenador->id);
        }
        return $retCoordenadores; 
    }
}

?>