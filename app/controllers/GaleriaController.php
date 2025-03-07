<?php

class GaleriaController extends Controller
{
    private $galeriaModel;
    private $galeriaqualidade;
    private $pg_galeria;
    private $sobrehome;

    public function __construct(){
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Galeria

        $this->galeriaModel = new Galeria();
        $this->galeriaqualidade = new Galeria();
        $this->sobrehome = new Galeria();
        $this->pg_galeria = new Galeria();
    }

    public function index(){
        $dados = array();

        $galeria_banner = new  Banner();

        // Obtém os dados da galeria
        $galeria_pg = $this->galeriaModel->getGaleria_pg_galeria();
        $banner_galeria = $galeria_banner->getBanner_galeria();
        $dados['pg_galeria'] = $galeria_pg;
        $dados['banner'] = $banner_galeria;

        // Carrega a view de listagem da galeria
        $this->carregarViews('galeria', $dados);
    }

    public function editarG($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Valida o ID
        if (!is_numeric($id)) {
            header('Location: ' . BASE_URL . 'ben_vindo');
            exit();
        }

        // Obtém os dados da foto para edição
        $foto = $this->galeriaModel->getGaleriaPorId($id);



        if (!$foto) {
            // Se a foto não for encontrada, redireciona para a lista da galeria
            header('Location: ' . BASE_URL . 'ben_vindo');
            exit();
        }







        // Prepara os dados para a view
        $dados = array();
        $dados['foto'] = $foto;
        $dados['titulo'] = 'Editar Foto - Guloseimas do Olimpo';

        // Carrega a view de edição
        $this->carregarViews('dash/servico/editarG', $dados);
    }



    public function editarQ($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Valida o ID
        if (!is_numeric($id)) {
            header('Location: ' . BASE_URL . 'ben_vindo');
            exit();
        }

        // Obtém os dados da foto para edição
        $foto = $this->galeriaqualidade->getGaleriaPorId($id);



        if (!$foto) {
            // Se a foto não for encontrada, redireciona para a lista da galeria
            header('Location: ' . BASE_URL . 'qualidade');
            exit();
        }





        // Prepara os dados para a view
        $dados = array();
        $dados['foto'] = $foto;
        $dados['titulo'] = 'Editar Foto - Guloseimas do Olimpo';

        // Carrega a view de edição
        $this->carregarViews('dash/servico/editarQ', $dados);
    }


    public function statusG($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados da galeria
        $galeria_pg = $this->pg_galeria->getGaleriaPorId($id);

        if (!$galeria_pg) {
            $_SESSION['erro'] = "Produto não encontrado.";
            header('Location: ' . BASE_URL . 'produtos/banners');
            exit();
        }

        // Prepara os dados para a view
        $dados = [
            'galeria_pg' => $galeria_pg,
            'titulo' => 'Alterar Status do Produto'
        ];

        // Carrega a view do formulário
        $this->carregarViews('dash/galeria/statusG', $dados);
    }


    public function status_S_G($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados da galeria
        $galeria_pg = $this->pg_galeria->getGaleriaPorId($id);

        if (!$galeria_pg) {
            $_SESSION['erro'] = "Produto não encontrado.";
            header('Location: ' . BASE_URL . 'produtos/banners');
            exit();
        }

        // Prepara os dados para a view
        $dados = [
            'galeria_pg' => $galeria_pg,
            'titulo' => 'Alterar Status do Produto'
        ];

        // Carrega a view do formulário
        $this->carregarViews('dash/sobre/status_S_G', $dados);
    }



    public function atualizarStatusG(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_galeira'];
            $status = $_POST['status_galeria'];

            // Atualiza o status do produto
            if ($this->pg_galeria->atualizarStatusGaleria($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'galeria/galeria_pg_galeria');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'galeria/galeria_pg_galeria' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }


    public function atualizarstatus_S_G(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_galeira'];
            $status = $_POST['status_galeria'];

            // Atualiza o status do produto
            if ($this->pg_galeria->atualizarStatusGaleria($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'sobre/carrosel_sobre');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'sobre/carrosel_sobre' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }



    public function atualizarImagem(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_galeira'];

            // Recebe os campos do formulário
            $altFotoGaleria = $_POST['alt_foto_galeria'];
            $caminhoAntigoImagem = $_POST['foto_galeria_antiga']; // Caminho da imagem antiga
            $nome_galeria = $_POST['nome_galeria'];

            // Define o caminho padrão como a imagem antiga
            $novoCaminhoImagem = $caminhoAntigoImagem;

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_galeria']['name'])) {
                $diretorioUploads = __DIR__ . '/../../public/uploads/galeria/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_galeria']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_galeria']['tmp_name'], $caminhoCompleto)) {
                    $novoCaminhoImagem = 'galeria/' . $nomeArquivo;

                    // Remove a imagem antiga, se existir
                    if (!empty($caminhoAntigoImagem) && file_exists(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem)) {
                        unlink(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem);
                    }
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
                    exit();
                }
            }

            // Atualiza os dados no banco
            $dados = [
                'alt_foto_galeria' => $altFotoGaleria,
                'foto_galeria' => $novoCaminhoImagem, // Mantém o caminho antigo se não houve nova imagem
                'nome_galeria' => $nome_galeria,
            ];

            // Chama o modelo para atualizar os dados da galeria
            if ($this->galeriaModel->atualizargaleria($id, $dados)) {
                $_SESSION['mensagem'] = "Imagem da galeria atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a imagem da galeria.";
                header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
            }
            exit();
        }
    }

    public function atualizarImagem_(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_galeira'];

            // Recebe os campos do formulário
            $altFotoGaleria = $_POST['alt_foto_galeria'];
            $caminhoAntigoImagem = $_POST['foto_galeria_antiga']; // Caminho da imagem antiga
            $nome_galeria = $_POST['nome_galeria'];

            // Define o caminho padrão como a imagem antiga
            $novoCaminhoImagem = $caminhoAntigoImagem;

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_galeria']['name'])) {
                $diretorioUploads = __DIR__ . '/../../public/uploads/galeria/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_galeria']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_galeria']['tmp_name'], $caminhoCompleto)) {
                    $novoCaminhoImagem = 'galeria/' . $nomeArquivo;

                    // Remove a imagem antiga, se existir
                    if (!empty($caminhoAntigoImagem) && file_exists(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem)) {
                        unlink(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem);
                    }
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
                    exit();
                }
            }

            // Atualiza os dados no banco
            $dados = [
                'alt_foto_galeria' => $altFotoGaleria,
                'foto_galeria' => $novoCaminhoImagem, // Mantém o caminho antigo se não houve nova imagem
                'nome_galeria' => $nome_galeria,
            ];

            // Chama o modelo para atualizar os dados da galeria
            if ($this->galeriaModel->atualizargaleria($id, $dados)) {
                $_SESSION['mensagem'] = "Imagem da galeria atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'servico/ben_vind');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a imagem da galeria.";
                header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
            }
            exit();
        }
    }


    public function atualizar_qualidade(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ID fixo da galeria do parque de qualidade
            $id = 1; // Certifique-se de que o ID correto está no banco

            // Recebe os campos do formulário
            $altFotoGaleria = $_POST['alt_foto_galeria'];
            $caminhoAntigoImagem = $_POST['foto_galeria_antiga'];
            $nome_galeria = $_POST['nome_galeria'];

            // Caminho padrão para a imagem antiga
            $novoCaminhoImagem = $caminhoAntigoImagem;

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_galeria']['name'])) {
                $diretorioUploads = __DIR__ . '/../../public/uploads/galeria/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_galeria']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_galeria']['tmp_name'], $caminhoCompleto)) {
                    $novoCaminhoImagem = 'galeria/' . $nomeArquivo;

                    // Remove a imagem antiga, se existir
                    if (!empty($caminhoAntigoImagem) && file_exists(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem)) {
                        unlink(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem);
                    }
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'galeria/editarQ/' . $id);
                    exit();
                }
            }

            // Dados para atualizar
            $dados = [
                'alt_foto_galeria' => $altFotoGaleria,
                'foto_galeria' => $novoCaminhoImagem,
                'nome_galeria' => $nome_galeria,
            ];

            // Chama o modelo para atualizar os dados da galeria
            if ($this->galeriaqualidade->atualizar_qualidade_home($id, $dados)) {
                $_SESSION['mensagem'] = "Imagem atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'home/qualidade');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a imagem.";
                header('Location: ' . BASE_URL . 'galeria/editarQ/' . $id);
            }
            exit();
        }
    }


    public function atualizar_sobre_home(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ID fixo da galeria do parque de qualidade
            $id = 1; // Certifique-se de que o ID correto está no banco

            // Recebe os campos do formulário
            $altFotoGaleria = $_POST['alt_foto_galeria'];
            $caminhoAntigoImagem = $_POST['foto_galeria_antiga'];
            $nome_galeria = $_POST['nome_galeria'];

            // Caminho padrão para a imagem antiga
            $novoCaminhoImagem = $caminhoAntigoImagem;

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_galeria']['name'])) {
                $diretorioUploads = __DIR__ . '/../../public/uploads/galeria/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_galeria']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_galeria']['tmp_name'], $caminhoCompleto)) {
                    $novoCaminhoImagem = 'galeria/' . $nomeArquivo;

                    // Remove a imagem antiga, se existir
                    if (!empty($caminhoAntigoImagem) && file_exists(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem)) {
                        unlink(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem);
                    }
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
                    exit();
                }
            }

            // Dados para atualizar
            $dados = [
                'alt_foto_galeria' => $altFotoGaleria,
                'foto_galeria' => $novoCaminhoImagem,
                'nome_galeria' => $nome_galeria,
            ];

            // Chama o modelo para atualizar os dados da galeria
            if ($this->sobrehome->atualizar_sobre_home($id, $dados)) {
                $_SESSION['mensagem'] = "Imagem atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'home/sobre_ceo');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a imagem.";
                header('Location: ' . BASE_URL . 'galeria/editarG/' . $id);
            }
            exit();
        }
    }



    public function galeria_pg_galeria(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarDestaque'] = $this->pg_galeria->getGaleria_pg_galeria();

        $dados['conteudo'] = 'dash/galeria/galeria';



        $this->carregarViews('dash/dashboard', $dados);
    }
}
