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
                    'senha' => password_hash($usr->senha, PASSWORD_BCRYPT),
                    'tipo' => $usr->tipo,
                    'status' => $usr->status];
        $this->db->insert('usuario', $dados);
        return $this->db->insert_id();
    }

    function buscar($campo, $valor) {
        $query = $this->db->where($campo, $valor)->get('usuario');

        $retUsrs = [];
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
                    'senha' => password_hash($usr->senha, PASSWORD_BCRYPT),
                    'tipo' => $usr->tipo,
                    'status' => $usr->status];
        return $this->db->replace('usuario', $dados);
    }

    function remover($campo_unico, $valor) {
        return $this->db->where($campo_unico, $valor)->delete('usuario');
    }

    function listar() {
        $query = $this->db->get('usuario');

        $retUsrs = [];
        foreach($query->result() as $i => $usr) {
            $retUsrs[$i] = Usuario::Builder($usr->nome, $usr->matricula, $usr->email, $usr->nome_usr, $usr->tipo, $usr->status);
            $retUsrs[$i]->set('id', $usr->id)->set('senha', $usr->senha);
        }
        return $retUsrs; 
    }

    function validar_acesso($nome_usr, $senha) {
        $query = $this->db->where('nome_usr', $nome_usr)->where('status', TRUE)->get('usuario');

        if ($query->num_rows() === 1) { 
            $usr = Usuario::Builder($query->result()[0]->nome, $query->result()[0]->matricula, $query->result()[0]->email, 
                                    $query->result()[0]->nome_usr, $query->result()[0]->tipo, $query->result()[0]->status);
            $usr->set('id', $query->result()[0]->id)->set('senha', $query->result()[0]->senha);

            if(password_verify($senha, $usr->senha)) {
                return $usr;
            }
        }
        return false;
    }

    function mudarSenha($id, $senha) {
        return $this->db->where('id', $id)->set('senha', password_hash($senha, PASSWORD_BCRYPT))->update('usuario');
    }

    function alterar_dados($id, $matricula, $email, $nome) {
        return $this->db->where('id', $id)->set('matricula', $matricula)->set('email', $email)->set('nome', $nome)->update('usuario');
    }

    function desativar($id) {
        return $this->db->where('id', $id)->set('status', FALSE)->update('usuario');
    }

    function ativar($id) {
        return $this->db->where('id', $id)->set('status', TRUE)->update('usuario');
    }
}

?>