<?php

class SobreController extends Controller
{

    private $quem_sou_eu;
    private $minha_historia;
    private $carrosel_sobre;
    private $servicos;

    public function __construct()
    {
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
        $this->quem_sou_eu = new Galeria();
        $this->minha_historia = new Galeria();
        $this->carrosel_sobre = new Galeria();
        $this->servicos = new Servicos();
    }

    public function index()
    {


        $dados = array();


        $bannerModel = new  Banner();
        $galeriasobre = new Galeria();
        $servicosobreModel = new Servicos();
        $quem_sou_eu = new Galeria();
        $minha_historia = new Galeria();


        $Banner = $bannerModel->getBanner();
        $Galeria = $galeriasobre->getGaleriasobre();
        $Servicos = $servicosobreModel->getServicos();
        $GaleriaQuemSouEu = $quem_sou_eu->getGaleriaquemsoueu();
        $Galeriaminha_historia = $minha_historia->getGaleriaminha_historia();

        $dados['banner'] =  $Banner;
        $dados['galeria_sobre'] = $Galeria;
        $dados['servicos'] = $Servicos;
        $dados['quem_sou_eu'] =  $GaleriaQuemSouEu;
        $dados['minha_historia'] = $Galeriaminha_historia;

        $this->carregarViews('sobre', $dados);
    }



    public function quem_sou_eu()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['quem_sou_eu'] = $this->quem_sou_eu->getGaleriaquemsoueu();

        $dados['conteudo'] = 'dash/sobre/quem_sou_eu';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function minha_historia()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['minha_historia'] = $this->minha_historia->getGaleriaminha_historia();

        $dados['conteudo'] = 'dash/sobre/minha_historia';



        $this->carregarViews('dash/dashboard', $dados);
    }



    public function carrosel_sobre()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['carrosel_sobre'] = $this->carrosel_sobre->getGaleriasobre();

        $dados['conteudo'] = 'dash/sobre/carrosel_sobre';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function servicos()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['servicos'] = $this->servicos->getServicos();

        $dados['conteudo'] = 'dash/sobre/servicos';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function editarS($id)
    {
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
        $foto = $this->servicos->getServicoPorId($id);



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
        $this->carregarViews('dash/sobre/editarS', $dados);
    }


    public function status_S_S($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados da galeria
        $galeria_pg = $this->servicos->getServicoPorId($id);

       

        // Prepara os dados para a view
        $dados = [
            'galeria_pg' => $galeria_pg,
            'titulo' => 'Alterar Status do Produto'
        ];

        // Carrega a view do formulário
        $this->carregarViews('dash/sobre/status_S_S', $dados);
    }



    public function atualizarstatus_S_S(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_servico'];
            $status = $_POST['status_servico'];

            // Atualiza o status do produto
            if ($this->servicos->atualizarStatusServico($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'sobre/servicos');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'sobre/servicos' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }


    public function atualizarImagem_servico(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_servico'];

            // Recebe os campos do formulário
            $alt_foto_servico = $_POST['alt_foto_servico'];
            $caminhoAntigoImagem = $_POST['foto_servico_antiga']; // Caminho da imagem antiga
            $nome_servico = $_POST['nome_servico'];
            $descricao_servico = $_POST['descricao_servico'];


            // Define o caminho padrão como a imagem antiga
            $novoCaminhoImagem = $caminhoAntigoImagem;

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_servico']['name'])) {
                $diretorioUploads = __DIR__ . '/../../public/uploads/servico/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_servico']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_servico']['tmp_name'], $caminhoCompleto)) {
                    $novoCaminhoImagem = 'servico/' . $nomeArquivo;

                    // Remove a imagem antiga, se existir
                    if (!empty($caminhoAntigoImagem) && file_exists(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem)) {
                        unlink(__DIR__ . '/../../public/uploads/' . $caminhoAntigoImagem);
                    }
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'galeria/editarS/' . $id);
                    exit();
                }
            }

            // Atualiza os dados no banco
            $dados = [
                'alt_foto_servico' => $alt_foto_servico,
                'foto_servico' => $novoCaminhoImagem, // Mantém o caminho antigo se não houve nova imagem
                'nome_servico' => $nome_servico,
                'descricao_servico' => $descricao_servico,
            ];

            // Chama o modelo para atualizar os dados da galeria
            if ($this->servicos->atualizarservico($id, $dados)) {
                $_SESSION['mensagem'] = "Serviço atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a imagem da galeria.";
                header('Location: ' . BASE_URL . 'galeria/editarS/' . $id);
            }
            exit();
        }
    }
}
