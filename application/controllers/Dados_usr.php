<?php

class Dados_usr extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['usuario', 'DAO/usuario_dao']);
        $this->load->model(['aluno', 'DAO/aluno_dao']);
    }

    public function index()
    {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');

            $dados['usuario'] = $this->usuario_dao->buscar('id', $this->session->usr_autenticado['id'])[0];
            $dados['aluno'] = $this->aluno_dao->buscar('usuario_id', $this->session->usr_autenticado['id'])[0];
            $dados['total_horas_computadas'] = $this->aluno_dao->total_horas_computadas($this->session->usr_autenticado['id']);
            $dados['tipo'] = ($dados['usuario']->tipo == "ADM") ? "Administrador" : ($dados['usuario']->tipo == "AL") ? "Aluno" : "Coordenador";
            
            $this->load->view('dados_usr', $dados);

            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }
}

?>