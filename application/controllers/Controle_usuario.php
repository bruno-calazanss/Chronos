<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle_usuario extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['usuario', 'DAO/usuario_dao']);
        $this->load->model(['administrador', 'DAO/administrador_dao']);
        $this->load->model(['aluno', 'DAO/aluno_dao']);
        $this->load->model(['coordenador', 'DAO/coordenador_dao']);
    }

    public function index()
    {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);
            $this->load->view('cadastrar_usr');
            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function dados_usr() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            $dados['usuario'] = $this->usuario_dao->buscar('id', $this->session->usr_autenticado['id'])[0];
            if($this->session->usr_autenticado['tipo'] == "AL") {
                $dados['aluno'] = $this->aluno_dao->buscar('usuario_id', $this->session->usr_autenticado['id'])[0];
                $dados['total_horas_computadas'] = $this->aluno_dao->total_horas_computadas($this->session->usr_autenticado['id']);
            }
            $dados['tipo'] = ($dados['usuario']->tipo == "ADM") ? "Administrador" : ($dados['usuario']->tipo == "AL") ? "Aluno" : "Coordenador";
            
            $this->load->view('dados_usr', $dados);

            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function cadastrar() {

        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            // $this->output->enable_profiler(TRUE);

            // VALIDATION RULES
            $this->form_validation->set_rules('matricula', 'Matrícula', 'required|numeric|min_length[13]');
            $this->form_validation->set_rules('tipo', 'Tipo', 'required');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|max_length[70]');
            $this->form_validation->set_rules('conf_email', 'Confirmação de e-mail', 'required|matches[email]');
            $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[80]');
            $this->form_validation->set_rules('nome_usr', 'Nome de usuário', 'required');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model(['usuario', 'DAO/usuario_dao']);
                $this->load->helper('string');

                $this->db->trans_start();
                
                $usr = Usuario::Builder($this->input->post('nome'), $this->input->post('matricula'), $this->input->post('email'), 
                                        $this->input->post('nome_usr'), $this->input->post('tipo'), TRUE);
                $usr->set('senha', random_string('alnum', 10));

                $usuario_id = $this->usuario_dao->inserir($usr);

                switch ($this->input->post('tipo')) {
                    case 'ADM': {
                        $this->load->model(['administrador', 'DAO/administrador_dao']);
                        $this->administrador_dao->inserir(Administrador::Builder($usuario_id));
                        break;
                    }
                    case 'AL': {
                        $this->load->model(['aluno', 'DAO/aluno_dao']);
                        $this->aluno_dao->inserir(Aluno::Builder($usuario_id));
                        break;
                    }
                    case 'C': {
                        $this->load->model(['coordenador', 'DAO/coordenador_dao']);
                        $this->coordenador_dao->inserir(Coordenador::Builder($usuario_id));
                        break;
                    }
                }
                $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE)
                {
                    $this->load->library('email');
                    
                    $this->email->to('smtp@smtp.com');
                    $this->email->from('smtp@smtp.com', 'smtp');
                    
                    $this->email->subject('Chronos - Senha temporária');
                    $this->email->message("Cadastro concluído! <br> Usuário: {$usr->nome_usr} <br> Senha temporária: {$usr->senha}");
                    
                    $this->email->send();
                    // $this->email->print_debugger();
                }
            }
            redirect(base_url('index.php/cadastrar_usr'));
        }
        else {
            redirect(base_url('index.php'));
        }
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
                redirect(base_url('index.php'));
            }

            $this->session->usr_autenticado = (array) $usr;
            
            if($usr->tipo !== "ADM") {   
                redirect(base_url('index.php/controle_usuario/dados_usr'));
            }
            redirect(base_url('index.php/controle_usuario/'));
        }
        redirect(base_url('index.php'));
    }

    function sair() {
        $this->session->sess_destroy();
        redirect(base_url('index.php'));
    }
}

?>