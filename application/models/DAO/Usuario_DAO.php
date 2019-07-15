<?php

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
}

?>