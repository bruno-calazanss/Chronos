<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('administrador');
    }

    function inserir($adm) {
        $dados = ['usuario_id' => $adm->usuario_id];
        $this->db->insert('administrador', $dados);
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $query = $this->db->where($campo, $valor)->get('administrador');

        $retAdms = [];
        foreach($query->result() as $i => $adm) {
            $retAdms[$i] = Administrador::Builder($adm->id);
        }
        return $retAdms; 
    }

    function editar($adm) {
        $dados = ['usuario_id' => $adm->usuario_id];
        return $this->db->replace('administrador', $dados);
    }

    function remover($usuario_id) {
        return $this->db->where('usuario_id', $usuario_id)->delete('administrador');
    }

    function listar() {
        $query = $this->db->get('administrador');

        $retAdms = [];
        foreach($query->result() as $i => $adm) {
            $retAdms[$i] = Administrador::Builder($adm->id);
        }
        return $retAdms; 
    }
}

?>