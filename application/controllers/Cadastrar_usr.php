<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastrar_usr extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/head');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('cadastrar_usr');
        $this->load->view('templates/scripts');
        $this->load->view('templates/footer');
    }

    function cadastrar() {

        // $this->output->enable_profiler(TRUE);

        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('matricula', 'Matrícula', 'required|numeric|min_length[13]');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|max_length[70]');
        $this->form_validation->set_rules('conf_email', 'Confirmação de e-mail', 'required|matches[email]');
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[80]');
        $this->form_validation->set_rules('nome_usr', 'Nome de usuário', 'required|min_length[8]');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        // MODELO MEMBERSHIP
        $this->load->model(['usuario', 'DAO/usuario_dao']);
        $usr = Usuario::Builder($this->input->post('nome'), $this->input->post('matricula'), $this->input->post('email'), 
                           $this->input->post('nome_usr'), $this->input->post('tipo'), TRUE);
        $usr->set('senha', 'teste');
        $this->usuario_dao->inserir($usr);
        $usuario_id = $this->usuario_dao->buscar('nome_usr', $this->input->post('nome_usr'))[0]->id;

        if ($this->form_validation->run() == TRUE) {
            redirect('Portal/index');
        } else {
            switch ($this->input->post('tipo')) {
                case 'ADM': {
                    $this->load->model(['aluno', 'DAO/aluno_dao']);
					$this->aluno_dao->inserir(Aluno::Builder($usuario_id));
                }
                case 'AL': {
                    $this->load->model(['administrador', 'DAO/administrador_dao']);
					$this->administrador_dao->inserir(Administrador::Builder($usuario_id));
                }
                case 'C': {
                    $this->load->model(['coordenador', 'DAO/coordenador_dao']);
					$this->coordenador_dao->inserir(Coordenador::Builder($usuario_id));
                }
            }
        }
    }
}

?>