<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade extends CI_Model {

    public $id;
    public $relatorio_id;
    public $nome;
    public $data;
    public $qtd_horas;
    public $horas_validadas;
    public $categoria;
    public $comprovante;

    public const string_categorias = [10 => "Disciplinas não previstas", 
                                      11 => "Cursos de atualização", 
                                      12 => "Monitoria",
                                      13 => "Estágio não-obrigatório", 
                                      20 => "Eventos internos", 
                                      21 => "Eventos externos", 
                                      22 => "Ministrar cursos de extensão", 
                                      30 => "Iniciação científica (Tecnológica e Inovação)",
                                      31 => "Publicações",
                                      32 => "Apresentação de trabalho científico"];

    public static function Builder($id, $relatorio_id, $nome, $data, $qtd_horas, $categoria, $comprovante) {
        $atv = new Atividade();
        $atv->id = $id;
        $atv->relatorio_id = $relatorio_id;
        $atv->nome = $nome;
        $atv->data = $data;
        $atv->qtd_horas = $qtd_horas;
        $atv->categoria = $categoria;
        $atv->comprovante = $comprovante;
        return $atv;
    }

    public function __call($nome, $args) {
        return null;
    }

    public function get($campo) {
        return $$campo;
    }

    public function set($campo, $val) {
        $this->$campo = $val;
        return $this;
    }

    public function enviarComprovantes($relatorio_id) {
        if(!empty($_FILES['comprovante']['name'])) {
            
            $this->load->helper(['directory', 'path', 'file']);
            
            if(!is_dir(set_realpath('./comprovantes/' . $_SESSION['usr_autenticado']['matricula']))) {
                mkdir(set_realpath('./comprovantes/' . $_SESSION['usr_autenticado']['matricula']));
            }

            if(is_dir(set_realpath('./comprovantes/' . $_SESSION['usr_autenticado']['matricula'] . "/$relatorio_id"))) {
                delete_files('./comprovantes/' . $_SESSION['usr_autenticado']['matricula'] . "/$relatorio_id", TRUE);
                rmdir(set_realpath('./comprovantes/' . $_SESSION['usr_autenticado']['matricula'] . "/$relatorio_id"));
            }

            mkdir(set_realpath('./comprovantes/' . $_SESSION['usr_autenticado']['matricula'] . "/$relatorio_id"));

            $dadosArq = [];
            foreach($_FILES['comprovante']['name'] as $i => $arq) {
                if(empty($_FILES['comprovante']['name'][$i])) continue;

                $_FILES['aux']['name']     = $_FILES['comprovante']['name'][$i];
                $_FILES['aux']['type']     = $_FILES['comprovante']['type'][$i];
                $_FILES['aux']['tmp_name'] = $_FILES['comprovante']['tmp_name'][$i];
                $_FILES['aux']['error']     = $_FILES['comprovante']['error'][$i];
                $_FILES['aux']['size']     = $_FILES['comprovante']['size'][$i];

                $config['upload_path'] = './comprovantes/' . $_SESSION['usr_autenticado']['matricula'] . "/$relatorio_id";
                $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|zip';
                $config['max_size'] = 5120;
                $config['file_ext_tolower'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('aux')) {
                    $dadosArq[$i] = $this->upload->data();
                }
                else {
                    return NULL;
                }
            }
            return $dadosArq;
        }
        return NULL;
    }
}

?>