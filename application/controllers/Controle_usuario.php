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
            if(isset($_SESSION['status']) && isset($_SESSION['msg'])) {
                $this->load->view('templates/msg_sucesso', $_SESSION);
            }
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function dados_usr($id = NULL) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            $id = ($id !== NULL && $_SESSION['usr_autenticado']['tipo'] != "AL") ? $id : $this->session->usr_autenticado['id'] ;
            $dados['usuario'] = $this->usuario_dao->buscar('id', $id)[0];
            if($dados['usuario']->tipo == "AL") {
                $dados['aluno'] = $this->aluno_dao->buscar('usuario_id', $id)[0];
                $dados['total_horas_computadas'] = $this->aluno_dao->total_horas_computadas($id);
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

    function desativar($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            $this->usuario_dao->desativar($id);
            $this->session->set_flashdata(["status" => TRUE, "msg" => "Usuário desativado com sucesso!"]);
            redirect(base_url('index.php/controle_usuario/listar_usuarios'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }
    
    function ativar($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            $this->usuario_dao->ativar($id);
            $this->session->set_flashdata(["status" => TRUE, "msg" => "Usuário ativado com sucesso!"]);
            redirect(base_url('index.php/controle_usuario/listar_usuarios'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function listar_usuarios($pagina = 1) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] != "AL") {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            if($_SESSION['usr_autenticado']['tipo'] == "ADM") {   
                $dados['usuarios'] = $this->usuario_dao->listar();
            }
            else {
                $dados['usuarios'] = $this->usuario_dao->buscar('tipo', "AL");
            }

            usort($dados['usuarios'], function ($usr1, $usr2) { return strcmp($usr1->nome, $usr2->nome); });
            for($i=0; $i<count($dados['usuarios']); $i++) {
                if($dados['usuarios'][$i]->tipo == "AL") {
                    $dados['total_horas_computadas'][$i] = $this->aluno_dao->total_horas_computadas($dados['usuarios'][$i]->id);
                } else {
                    $dados['total_horas_computadas'][$i] = "N/A";
                }
                $dados['tipo'][$i] = ($dados['usuarios'][$i]->tipo == "ADM") ? "Administrador" : ($dados['usuarios'][$i]->tipo == "AL") ? "Aluno" : "Coordenador";
            }

            $this->load->library('pagination');

            $config['base_url'] = base_url("index.php/controle_usuario/listar_usuarios/");
            $config['total_rows'] = count($dados['usuarios'])-1;
            $config['per_page'] = 8;
            $config['num_links'] = 2;

            $this->pagination->initialize($config);

            $dados["links"] = $this->pagination->create_links();
            $dados["pagina"] = $pagina;
            $dados['usr_autenticado'] = $_SESSION['usr_autenticado'];

            $this->load->view('templates/scripts');
            $this->load->view('listar_usuarios', $dados);
            
            if(isset($_SESSION['status']) && isset($_SESSION['msg'])) {
                $this->load->view('templates/msg_sucesso', $_SESSION);
            }
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function alterar_usuario($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            $dados['usuario'] = $this->usuario_dao->buscar('id', $id)[0];
            $dados['tipo'] = ($dados['usuario']->tipo == "ADM") ? "Administrador" : ($dados['usuario']->tipo == "AL") ? "Aluno" : "Coordenador";
            
            $this->load->view('alterar_usr', $dados);

            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function alterar($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "ADM") {
            // $this->output->enable_profiler(TRUE);

            // VALIDATION RULES
            $this->form_validation->set_rules('matricula', 'Matrícula', 'required|numeric|min_length[13]');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|max_length[70]');
            $this->form_validation->set_rules('conf_email', 'Confirmação de e-mail', 'required|matches[email]');
            $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[80]');
            $this->form_validation->set_rules('nome_usr', 'Nome de usuário', 'required');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $this->usuario_dao->alterar_dados($id, $this->input->post('matricula'), $this->input->post('email'),
                                                    $this->input->post('nome'), $this->input->post('nome_usr'));
            }

            $this->session->set_flashdata(["status" => TRUE, "msg" => "Dados atualizados com sucesso!"]);
            redirect(base_url('index.php/controle_usuario/listar_usuarios'));
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
                    $this->session->set_flashdata(["status" => TRUE, "msg" => "Usuário cadastrado com sucesso!"]);
                }
            }
            redirect(base_url('index.php/controle_usuario/'));
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