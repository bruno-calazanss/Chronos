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
    }

    function buscar($campo, $valor) {
        $this->db->select('*');
        $this->db->from('administrador');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $adm) {
            $retAdms[$i] = Administrador::Builder($adm->id);
        }
        return $retAdms; 
    }

    function editar($adm) {
        $dados = ['usuario_id' => $adm->usuario_id];
        $this->db->replace('administrador', $dados);
        
    }

    function remover($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->delete('administrador');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('administrador');
        $query = $this->db->get();

        foreach($query->result() as $i => $adm) {
            $retAdms[$i] = Administrador::Builder($adm->id);
        }
        return $retAdms; 
    }
}

?>