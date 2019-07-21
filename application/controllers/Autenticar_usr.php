<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticar_usr extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['usuario', 'DAO/usuario_dao']);
    }

    public function index()
    {
        redirect(base_url('index.php'));
    }

    function autenticar() {

        // $this->output->enable_profiler(TRUE);

        // VALIDATION RULES
        $this->form_validation->set_rules('nome_usr', 'Nome de usuário', 'required');
        // $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if ($this->form_validation->run() == TRUE) {
            
            $usr = $this->usuario_dao->validar_acesso($this->input->post('nome_usr'), $this->input->post('senha'));
            
            if($usr === false) {
                $this->index();
            }

            $this->session->usr_autenticado = (array) $usr;
            redirect(base_url('index.php/Portal/dados_usr'));
        }
        $this->index();
    }
}

?>