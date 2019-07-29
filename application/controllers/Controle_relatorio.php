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

    function historico($pagina = 1) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            // $this->output->enable_profiler(TRUE);
            
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            if($this->session->usr_autenticado['tipo'] == "AL") {
                $dados['relatorios'] = $this->relatorio_dao->buscar('aluno_usuario_id', $this->session->usr_autenticado['id']);
            }
            elseif($this->session->usr_autenticado['tipo'] == "ADM") {
                $dados['relatorios'] = $this->relatorio_dao->listar();
            }
            else {
                $this->load->model(['usuario', 'DAO/usuario_dao']);
                $dados['relatorios'] = $this->relatorio_dao->buscar('estado', 1);
            }

            $this->load->model(['usuario', 'DAO/usuario_dao']);

            for($i=0; $i<count($dados['relatorios']); $i++) {
                $dados['alunos'][$i] = $this->usuario_dao->buscar('id', $dados['relatorios'][$i]->aluno_usuario_id)[0];
                $dados['soma_horas_informadas'][$i] = $this->atividade_dao->somar_horas_informadas($dados['relatorios'][$i]->id);
                $dados['soma_horas_validadas'][$i] = $this->atividade_dao->somar_horas_validadas($dados['relatorios'][$i]->id);
            }
            
            $this->load->library('pagination');

            $config['base_url'] = base_url("index.php/controle_relatorio/historico/");
            $config['total_rows'] = count($dados['relatorios']);
            $config['per_page'] = 8;
            $config['num_links'] = 2;

            $this->pagination->initialize($config);

            $dados["links"] = $this->pagination->create_links();
            $dados["pagina"] = $pagina;
            
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
            $this->form_validation->set_rules('horas[]', 'Qtd. de horas informadas', 'required|greater_than[0]|is_numeric');
            // $this->form_validation->set_rules('comprovante[]', 'Comprovante', 'required');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $this->db->trans_begin();

                $relatorio = Relatorio::Builder('FALSE', date('Y-m-d'), NULL, $this->session->usr_autenticado['id']);
                $id = $this->relatorio_dao->inserir($relatorio);

                $uploads = $this->atividade->enviarComprovantes($id);
                if(isset($uploads)) {    
                    for($i = 0; $i < count($this->input->post('nome[]')); $i++) {
                        $atv = Atividade::Builder($i+1, $id, $this->input->post('nome[]')[$i], $this->input->post('data[]')[$i], 
                        $this->input->post('horas[]')[$i], $this->input->post('categoria[]')[$i], $uploads[$i]['full_path']);
                        $this->atividade_dao->inserir($atv);
                    }

                    if($this->db->trans_status() === TRUE) {
                        $this->db->trans_commit();
                    } else {
                        $this->db->trans_rollback();
                    }
                } else {
                    $this->db->trans_rollback();
                }
            }
            redirect(base_url('index.php/controle_relatorio'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function enviar_avaliacao($id) {

        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "C") {
            // $this->output->enable_profiler(TRUE);

            // VALIDATION RULES
            $this->form_validation->set_rules('horas_validadas[]', 'Qtd. de horas informadas', 'required|greater_than[0]|is_numeric');
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model(['usuario', 'DAO/usuario_dao']);
                $this->load->model(['aluno', 'DAO/aluno_dao']);

                $this->db->trans_start();

                $atividades = $this->atividade_dao->buscar('relatorio_id', $id);
                foreach($atividades as $i => $atv) {
                    $atv->horas_validadas = $this->input->post('horas_validadas[]')[$i];
                    $this->atividade_dao->editar($atv);
                }

                $relatorio = $this->relatorio_dao->buscar('id', $id)[0];
                $aluno = $this->aluno_dao->buscar('usuario_id', $relatorio->aluno_usuario_id);
                $this->aluno_dao->atualizar_somatorios($relatorio->aluno_usuario_id, $atividades);
                
                $this->relatorio_dao->avaliar($id, $this->session->usr_autenticado['id']);

                $this->db->trans_complete();
            }
            redirect(base_url('index.php/controle_relatorio/historico'));
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function avaliar($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado']) && $_SESSION['usr_autenticado']['tipo'] == "C") {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);
            $this->load->view('templates/scripts');

            $dados['id'] = $id;
            $dados['atividades'] = $this->atividade_dao->buscar('relatorio_id', $id);
            $dados['strings_categoria'] = Atividade::string_categorias;
            $this->load->view('avaliar', $dados);

            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function visualizar($id) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'])) {
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);
            $this->load->view('templates/scripts');

            $dados['id'] = $id;
            $dados['atividades'] = $this->atividade_dao->buscar('relatorio_id', $id);
            $dados['strings_categoria'] = Atividade::string_categorias;
            $this->load->view('relatorio', $dados);

            $this->load->view('templates/footer');
        }
        else {
            redirect(base_url('index.php'));
        }
    }

    function relatorios_pendentes($pagina = 1) {
        if(isset($_SESSION['usr_autenticado']) && !empty($_SESSION['usr_autenticado'] && $_SESSION['usr_autenticado']['tipo'] == "C")) {
            // $this->output->enable_profiler(TRUE);
            
            $this->load->view('templates/head');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $_SESSION['usr_autenticado']);

            $this->load->model(['usuario', 'DAO/usuario_dao']);

            $dados['relatorios'] = $this->relatorio_dao->buscar('estado', 0);

            for($i=0; $i<count($dados['relatorios']); $i++) {
                $dados['alunos'][$i] = $this->usuario_dao->buscar('id', $dados['relatorios'][$i]->aluno_usuario_id)[0];
                $dados['soma_horas_informadas'][$i] = $this->atividade_dao->somar_horas_informadas($dados['relatorios'][$i]->id);
            }

            $this->load->library('pagination');

            $config['base_url'] = base_url("index.php/controle_relatorio/relatorios_pendentes/");
            $config['total_rows'] = count($dados['relatorios']);
            $config['per_page'] = 8;
            $config['num_links'] = 2;

            $this->pagination->initialize($config);

            $dados["links"] = $this->pagination->create_links();
            $dados["pagina"] = $pagina;
            
            $this->load->view('relatorios_pendentes', $dados);
            
            $this->load->view('templates/scripts');
            $this->load->view('templates/footer');

        }
        else {
            redirect(base_url('index.php'));
        }
    }
}

?>