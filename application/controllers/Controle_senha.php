<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle_senha extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['usuario', 'DAO/usuario_dao']);
        // $this->load->model(['administrador', 'DAO/administrador_dao']);
        // $this->load->model(['aluno', 'DAO/aluno_dao']);
        // $this->load->model(['coordenador', 'DAO/coordenador_dao']);
    }

    public function index() {
        if(!isset($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('redefinir_senha');
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

    public function redefinir_Senha() {
        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $usr = $this->usuario_dao->buscar('email', $_POST['email'])[0];
            if($usr) {
                // $this->output->enable_profiler(TRUE);

                $this->load->helper('string');
                $novaSenha = random_string('alnum', 10);

                $this->db->trans_start();
                $this->usuario_dao->mudarSenha($usr->id, $novaSenha);
                $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE) {
                    $this->load->library('email');
                    
                    $this->email->to($_POST['email']);
                    $this->email->from('smtp@smtp.com', 'smtp');
                    
                    $this->email->subject('Chronos - Senha redefinida');
                    $this->email->message("Sua senha foi redefinida. <br> Senha temporária: {$usr->senha}");
                    
                    $this->email->send();
                    // $this->email->print_debugger();

                    $this->session->set_flashdata(["status" => TRUE, "msg" => "Senha redefinida com sucesso! <br> Uma senha temporária foi enviada para o e-mail especificado."]);
                    redirect(base_url('index.php/controle_senha'));
                } 
                else {
                    redirect(base_url('index.php'));
                }
            }
        }
    }

    public function modificar_senha() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);
            $this->load->view('modificar_senha');
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

    public function nova_senha() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            // $this->output->enable_profiler(TRUE);

            // VALIDATION RULES
            $this->form_validation->set_rules('senha_atual', 'Senha atual', 'required');
            $this->form_validation->set_rules('nova_senha', 'Nova senha', 'required|min_length[8]');
            $this->form_validation->set_rules('conf_nova_senha', 'Confirmação de nova senha', 'required|min_length[8]|matches[nova_senha]');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {

                $this->db->trans_start();
                
                $usr = $this->usuario_dao->validar_acesso($this->session->usr_autenticado['nome_usr'], $this->input->post('senha_atual'));

                if(!empty($usr)) {
                    $this->usuario_dao->mudarSenha($this->session->usr_autenticado['id'], $this->input->post('nova_senha'));    
                }                
                
                $this->db->trans_complete();

                if (!empty($usr) && $this->db->trans_status() === TRUE)
                {
                    $this->load->library('email');
                    
                    $this->email->to('smtp@smtp.com');
                    $this->email->from('smtp@smtp.com', 'smtp');
                    
                    $this->email->subject('Chronos - Mudança de senha');
                    $this->email->message("Senha modificada com sucesso! <br> Nova senha: " . $this->input->post('nova_senha'));
                    
                    $this->email->send();
                    // $this->email->print_debugger();
                }
            }
            $this->session->set_flashdata(["status" => TRUE, "msg" => "Senha modificada com sucesso!"]);
            redirect(base_url('index.php/controle_senha/modificar_senha/modificar_senha'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }
}
?>