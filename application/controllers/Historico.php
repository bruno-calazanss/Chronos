<?php

class Historico extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['relatorio', 'DAO/relatorio_dao']);
        $this->load->model(['atividade', 'DAO/atividade_dao']);
    }

    public function index()
    {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            // $this->output->enable_profiler(TRUE);
            
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');

            $dados['relatorios'] = $this->relatorio_dao->buscar('aluno_usuario_id', $this->session->usr_autenticado['id']);

            for($i=0; $i<count($dados['relatorios']); $i++) {
                $dados['soma_horas_informadas'][$i] = $this->atividade_dao->somar_horas_informadas($dados['relatorios'][$i]->id);
                $dados['soma_horas_validadas'][$i] = $this->atividade_dao->somar_horas_validadas($dados['relatorios'][$i]->id);
            }
            
            $this->load->view('historico', $dados);
            
            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');

        }
        else {
            redirect(base_url('index.php'));
        }
    }
}

?>