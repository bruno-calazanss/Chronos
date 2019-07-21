<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    public function index() {
        $this->load->view('templates/head');
        $this->load->view('index');
        $this->load->view('templates/scripts');
        $this->load->view('templates/footer');
    }

    public function avaliar() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('avaliar');
            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    public function relatorio() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head', ['fileUpload' => true]);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $includes['scripts'] = $this->load->view('templates/scripts', NULL, TRUE);
            $this->load->view('relatorio', $includes);
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }
}
?>