<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle_relatorio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['atividade', 'DAO/atividade_dao']);
        $this->load->model(['relatorio', 'DAO/relatorio_dao']);
    }

    public function index()
    {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "AL") {
            $this->load->view('templates/head', ['fileUpload' => true]);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);
            $includes['scripts'] = $this->load->view('templates/scripts', NULL, TRUE);
            $this->load->view('adicionar_relatorio', $includes);
            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function historico() {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'] && $_SESSION['usr_autenticado']['tipo'] !== "ADM")) {
            // $this->output->enable_profiler(TRUE);
            
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            if($this->session->usr_autenticado['tipo'] == "AL") {
                $dados['relatorios'] = $this->relatorio_dao->buscar('aluno_usuario_id', $this->session->usr_autenticado['id']);
            }
            else {
                $dados['relatorios'] = $this->relatorio_dao->listar();
            }

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

    function enviar() {

        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "AL") {
            // $this->output->enable_profiler(TRUE);

            // VALIDATION RULES
            $this->form_validation->set_rules('nome[]', 'Nome da atividade', 'required|max_length[80]');
            $this->form_validation->set_rules('categoria[]', 'Categoria', 'required|max_length[45]');
            $this->form_validation->set_rules('data[]', 'Data', 'required');
            $this->form_validation->set_rules('horas[]', 'Qtd. de horas informadas', 'required|is_numeric');
            // $this->form_validation->set_rules('comprovante[]', 'Comprovante', 'required');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $this->db->trans_start();
                
                $this->load->model(['relatorio', 'DAO/relatorio_dao']);
                $this->load->model(['atividade', 'DAO/atividade_dao']);

                $relatorio = Relatorio::Builder('FALSE', date('d/m/Y'), NULL, $this->session->usr_autenticado['id']);
                $id = $this->relatorio_dao->inserir($relatorio);

                for($i = 0; $i < count($this->input->post('nome[]')); $i++) {
                    $atv = Atividade::Builder($i+1, $id, $this->input->post('nome[]')[$i], $this->input->post('data[]')[$i], 
                                            $this->input->post('horas[]')[$i], $this->input->post('categoria[]')[$i], 'teste');
                    $this->atividade_dao->inserir($atv);
                }

                $this->db->trans_complete();
            }
            redirect(base_url('index.php/controle_relatorio'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }
}

?>