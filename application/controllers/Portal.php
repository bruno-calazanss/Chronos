<?php
class Portal extends CI_Controller {

        public function index() {
                $this->load->view('templates/head');
                $this->load->view('index');
                $this->load->view('templates/scripts');
                $this->load->view('templates/footer');
        }

        public function inicial() {
                $this->load->view('templates/head');
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $this->load->view('inicial');
                $this->load->view('templates/scripts');
                $this->load->view('templates/footer');
        }

        public function historico() {
                $this->load->view('templates/head');
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $this->load->view('historico');
                $this->load->view('templates/scripts');
                $this->load->view('templates/footer');
        }

        public function adicionar() {
                $this->load->view('templates/head', ['fileUpload' => true]);
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $includes['scripts'] = $this->load->view('templates/scripts', NULL, TRUE);
                $this->load->view('adicionar', $includes);
                $this->load->view('templates/footer');
        }

        public function adicionar_usr() {
                $this->load->view('templates/head');
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $this->load->view('adicionar_usr');
                $this->load->view('templates/scripts');
                $this->load->view('templates/footer');
        }

        public function avaliar() {
                $this->load->view('templates/head');
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $this->load->view('avaliar');
                $this->load->view('templates/scripts');
                $this->load->view('templates/footer');
        }

        public function relatorio() {
                $this->load->view('templates/head', ['fileUpload' => true]);
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $includes['scripts'] = $this->load->view('templates/scripts', NULL, TRUE);
                $this->load->view('relatorio', $includes);
                $this->load->view('templates/footer');
        }
}
?>