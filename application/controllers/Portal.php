<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    public function index() {
        if(!isset($_SESSION['usr_autenticado']) || empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('index');
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
            switch($_SESSION['usr_autenticado']['tipo'])
            {
                case "AL": {
                    redirect(base_url("index.php/controle_usuario/dados_usr/{$_SESSION[usr_autenticado][id]}"));
                    break;
                }
                case "C": {
                    redirect(base_url("index.php/controle_relatorio/relatorios_pendentes"));
                    break;
                }
                case "ADM": {
                    redirect(base_url('index.php/controle_usuario/'));
                    break;
                }
                default: {
                    show_404();
                }
            }
        }
    }
}
?>