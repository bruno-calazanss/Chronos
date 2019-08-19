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
                if($_SESSION['status'] == TRUE) {
                    $this->load->view('templates/msg_sucesso', $_SESSION);
                }
                else {
                    $this->load->view('templates/msg_erro', $_SESSION);
                }
            }
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    public function redefinir_senha() {
        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $usr = $this->usuario_dao->buscar('email', $_POST['email'])[0];
            if($usr) {
                // $this->output->enable_profiler(TRUE);

                $this->load->helper('string');
                $novaSenha = random_string('alnum', 10);

                $this->db->trans_begin();
                if ($this->usuario_dao->mudarSenha($usr->id, $novaSenha)) {
                    $this->load->library('email');
                    
                    $this->email->to($_POST['email']);
                    $this->email->from('smtp@smtp.com', 'smtp');
                    
                    $this->email->subject('Chronos - Senha redefinida');
                    $this->email->message("Sua senha foi redefinida. <br> Senha temporária: $novaSenha");
                    
                    $this->db->trans_commit();
                    if($this->email->send()) {
                        $this->session->set_flashdata(["status" => TRUE, "msg" => "Operação concluída! <br> Uma senha temporária será enviada para o e-mail especificado."]);
                        redirect(base_url('index.php'));
                    }
                    $this->session->set_flashdata(["status" => FALSE, "msg" => "Operação não concluída! <br> Uma falha ocorreu na tentativa de enviar o e-mail de redefinição de senha."]);
                    redirect(base_url('index.php/controle_senha'));
                }
                $this->db->trans_rollback();
                $this->session->set_flashdata(["status" => FALSE, "msg" => "Operação não concluída! <br> Um erro desconhecido impediu a redefinição de senha."]);
                redirect(base_url('index.php/controle_senha'));
            }
            $this->session->set_flashdata(["status" => FALSE, "msg" => "Erro: nenhuma conta associada à esse e-mail foi encontrada!"]);
            redirect(base_url('index.php/controle_senha'));
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
                if($_SESSION['status'] == TRUE) {
                    $this->load->view('templates/msg_sucesso', $_SESSION);
                }
                else {
                    $this->load->view('templates/msg_erro', $_SESSION);
                }
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
            $this->form_validation->set_rules('senha_atual', 'Senha atual', 'required');
            $this->form_validation->set_rules('nova_senha', 'Nova senha', 'required|min_length[8]');
            $this->form_validation->set_rules('conf_nova_senha', 'Confirmação de nova senha', 'required|matches[nova_senha]');

            if ($this->form_validation->run()) {
                if($this->usuario_dao->validar_acesso($this->session->usr_autenticado['nome_usr'], $this->input->post('senha_atual'))) {
                    $this->db->trans_begin();
                    if ($this->usuario_dao->mudarSenha($this->session->usr_autenticado['id'], $this->input->post('nova_senha'))) {
                        $this->load->library('email');
                        
                        $this->email->to('smtp@smtp.com');
                        $this->email->from('smtp@smtp.com', 'smtp');
                        
                        $this->email->subject('Chronos - Mudança de senha');
                        $this->email->message("Sua senha foi modificada no sistema Chronos com sucesso! <br> 
                                            Caso não reconheça essa atividade redefina sua senha o mais rápido possível.");
                        
                        $this->db->trans_commit();
                        if($this->email->send()) {
                            $this->session->set_flashdata(["status" => TRUE, "msg" => "Senha modificada com sucesso!"]);
                            redirect(base_url('index.php/controle_senha/modificar_senha/modificar_senha'));
                        }
                    }
                    $this->db->trans_rollback();
                    $this->session->set_flashdata(["status" => FALSE, "msg" => "Senha não modificada! Um erro desconhecido impediu a alteração da senha."]);
                    redirect(base_url('index.php/controle_senha/modificar_senha/'));
                } 
                $this->session->set_flashdata(["status" => FALSE, "msg" => "Senha atual incorreta!"]);
                redirect(base_url('index.php/controle_senha/modificar_senha'));
            }
            $this->session->set_flashdata(["status" => FALSE, "msg" => "Erro de validação: o campo de confirmação não coincide com a nova senha informada."]);
            redirect(base_url('index.php/controle_senha/modificar_senha/'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }
}
?>