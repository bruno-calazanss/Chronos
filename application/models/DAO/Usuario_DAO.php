<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_DAO extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario');
    }

    function inserir($usr) {
        $dados =    ['nome' => $usr->nome,
                    'matricula' => $usr->matricula,
                    'email' => $usr->email,
                    'nome_usr' => $usr->nome_usr,
                    'senha' => $usr->senha,
                    'tipo' => $usr->tipo,
                    'status' => $usr->status];
        $this->db->insert('usuario', $dados);
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where($campo, $valor);
        $query = $this->db->get();

        foreach($query->result() as $i => $usr) {
            $retUsrs[$i] = Usuario::Builder($usr->nome, $usr->matricula, $usr->email, $usr->nome_usr, $usr->tipo, $usr->status);
            $retUsrs[$i]->set('id', $usr->id)->set('senha', $usr->senha);
        }
        return $retUsrs; 
    }

    function editar($campo_unico, $usr) {
        $dados =    ['id' => $usr->id,
                    'nome' => $usr->nome,
                    'matricula' => $usr->matricula,
                    'email' => $usr->email,
                    'nome_usr' => $usr->nome_usr,
                    'senha' => $usr->senha,
                    'tipo' => $usr->tipo,
                    'status' => $usr->status];
        $this->db->replace('usuario', $dados);
    }

    function remover($campo_unico, $valor) {
        $this->db->where($campo_unico, $valor);
        $this->db->delete('usuario');
    }

    function listar() {
        $this->db->select('*');
        $this->db->from('usuario');
        $query = $this->db->get();

        foreach($query->result() as $i => $usr) {
            $retUsrs[$i] = Usuario::Builder($usr->nome, $usr->matricula, $usr->email, $usr->nome_usr, $usr->tipo, $usr->status);
            $retUsrs[$i]->set('id', $usr->id)->set('senha', $usr->senha);
        }
        return $retUsrs; 
    }

    function validar_acesso($nome_usr, $senha) {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('nome_usr', $nome_usr);
        $this->db->where('senha', $senha);
        $this->db->where('status', TRUE);
        
        $query = $this->db->get();

        if ($query->num_rows() === 1) { 
            $usr = Usuario::Builder($query->result()[0]->nome, $query->result()[0]->matricula, $query->result()[0]->email, 
                                    $query->result()[0]->nome_usr, $query->result()[0]->tipo, $query->result()[0]->status);
            $usr->set('id', $query->result()[0]->id);
            return $usr;
        }
        return false;
    }

    function mudarSenha($id, $senha) {
        $this->db->where('id', $id);
        $this->db->set('senha', $senha);
        $this->db->update('usuario');
    }
}

?>