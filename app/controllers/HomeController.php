<?php

class HomeController extends Controller
{

    private $destaqueModel;
    private $galeriaModel;

    private $galeriaqualidade;
    private $sobrehome;

    private $carrosel_home;
    private $produtoModel;

    public function __construct()
    {
        $this->destaqueModel = new Destaque();
        $this->galeriaModel = new Galeria();  // Inicializa o modelo Destaque
        $this->galeriaqualidade = new Galeria();
        $this->sobrehome = new Galeria();
        $this->carrosel_home = new Produto();
        $this->produtoModel = new Produto();
    }


    public function index(){
        $dados = array();



        $galeriaModel = new  Galeria();
        $destaqueModel  = new Destaque();
        $produtoModel = new Produto();
        $quem_sou_eu = new Galeria();
        $qualidade = new Galeria();


        $Galeria = $galeriaModel->getGaleria([
            'order' => 'RAND()',  // Ordenação aleatória
            'limit' => 2          // Limite de 2 fotos
        ]);

        $Destaque = $destaqueModel->getDestaque();
        $Produto = $produtoModel->getProduto();
        $GaleriaQuemSouEu = $quem_sou_eu->getGaleriaquemsoueu();
        $Galeriaqualidade = $qualidade->getGaleriaqualidade();


        $dados['galeria'] = $Galeria;
        $dados['destaque'] = $Destaque;
        $dados['produto'] = $Produto;
        $dados['quem_sou_eu'] =  $GaleriaQuemSouEu;
        $dados['qualidade'] = $Galeriaqualidade;

        $this->carregarViews('home', $dados);
    }


    public function destaque(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarDestaque'] = $this->destaqueModel->getDestaque();

        $dados['conteudo'] = 'dash/servico/destaque';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function ben_vindo(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarDestaque'] = $this->galeriaModel->getGaleria();

        $dados['conteudo'] = 'dash/servico/ben_vindo';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function qualidade(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location:' . BASE_URL);
            exit;
        }

        // Cria um array para os dados
        $dados = array();

        // Obtém a galeria de qualidade (apenas uma linha)
        $dados['qualidade'] = $this->galeriaqualidade->getGaleriaqualidade();

        // Define o conteúdo a ser carregado na visualização
        $dados['conteudo'] = 'dash/servico/qualidade';

        // Carrega as views passando os dados
        $this->carregarViews('dash/dashboard', $dados);
    }


    public function sobre_ceo(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location:' . BASE_URL);
            exit;
        }

        // Cria um array para os dados
        $dados = array();

        // Obtém a galeria de qualidade (apenas uma linha)
        $dados['qualidade'] = $this->sobrehome->getGaleriaquemsoueu();

        // Define o conteúdo a ser carregado na visualização
        $dados['conteudo'] = 'dash/servico/sobre_ceo';

        // Carrega as views passando os dados
        $this->carregarViews('dash/dashboard', $dados);
    }


    public function carrosel(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarServico'] = $this->carrosel_home->getProduto();

        $dados['conteudo'] = 'dash/servico/carrosel';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function statusC($id){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados do produto
        $produto = $this->produtoModel->getProdutoPorId($id);

        if (!$produto) {
            $_SESSION['erro'] = "Produto não encontrado.";
            header('Location: ' . BASE_URL . 'servico/carrosel');
            exit();
        }

        // Prepara os dados para a view
        $dados = [
            'produto' => $produto,
            'titulo' => 'Alterar Status do Produto'
        ];

        // Carrega a view do formulário
        $this->carregarViews('dash/servico/statusC', $dados);
    }


    public function atualizarStatusC(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_produto'];
            $status = $_POST['status_pedido'];

            // Atualiza o status do produto
            if ($this->produtoModel->atualizarStatusProduto($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'home/carrosel');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'home/carrosel' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }
}
