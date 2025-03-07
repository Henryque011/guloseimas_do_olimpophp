<?php

class info_produtosController extends Controller
{


    private $info_produtos;




    public function __construct(){



        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
        $this->info_produtos = new Produto();
    }





    public function index(){




        $dados = array();


        $dados['nome'] = 'cheguei aqui ';



        $this->carregarViews('info_produtos', $dados);
    }


    public function info_produtos($id = null){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit;
        }

        $dados = array();

        if ($id) {
            // Busca o produto pelo ID, caso ele seja fornecido
            $dados['listarServico'] = $this->info_produtos->getTodosServicos($id);
        } else {
            // Busca todos os produtos caso o ID não seja fornecido
            $dados['listarServico'] = $this->info_produtos->getTodosServicos();
        }

        $dados['conteudo'] = 'dash/info_produtos/info_produtos';

        $this->carregarViews('dash/dashboard', $dados);
    }


    public function editarI($id){
        // Verifica se o usuário está logado e tem permissão para editar
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Obtém os dados do produto para edição
        $info_produto = $this->info_produtos->getServicoPorId($id);

        if (!$info_produto) {
            // Se o produto não for encontrado, redireciona para a lista de produtos
            header('Location: ' . BASE_URL . 'produtos/home');
            exit();
        }

        // Prepara os dados para a view
        $dados = array();
        $dados['info_produto'] = $info_produto;
        $dados['titulo'] = 'Editar Produto - Ki Oficina';

        // Carrega a view de edição
        $this->carregarViews('dash/info_produtos/editarI', $dados);
    }



    public function atualizar_info(){
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_info_produtos'];

            // Verifica se uma nova imagem foi enviada
            $novoCaminhoImagem = $_POST['foto_produto_antiga']; // Caminho antigo por padrão
            if (!empty($_FILES['foto_info_produto']['name'])) {
                // Diretório de upload
                $diretorioUploads = __DIR__ . '/../../public/uploads/produto/';

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }

                // Gera um nome único para a imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_info_produto']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_info_produto']['tmp_name'], $caminhoCompleto)) {
                    // Atualiza o caminho da imagem para salvar no banco
                    $novoCaminhoImagem = 'produto/' . $nomeArquivo;
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'produtos/editarI/' . $id);
                    exit();
                }
            }

            // Atualiza os dados do produto
            $dados = [
                'nome_info_produtos' => $_POST['nome_info_produtos'],
                'descricao_info_produto' => $_POST['descricao_info_produto'],
                'preco_produto' => $_POST['preco_produto'],
                'info_alt_foto_produto' => $_POST['info_alt_foto_produto'],
                'personalizacao_info_produtos' => $_POST['personalizacao_info_produtos'],
                'forma_pagamento_info_produto' => $_POST['forma_pagamento_info_produto'],
                'entrega_info_produtos' => $_POST['entrega_info_produtos'],
                'reserva_info_produtos' => $_POST['reserva_info_produtos'],
                'foto_info_produto' => $novoCaminhoImagem
            ];

            if ($this->info_produtos->atualizar_info_Produto($id, $dados)) {
                $_SESSION['mensagem'] = " Informação do Produto atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'info_produtos/info_produtos');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o produto.";
                header('Location: ' . BASE_URL . 'produtos/editarI/' . $id);
            }
            exit();
        }
    }


    public function adicionarReserva($idProduto) {
        // Verifica se o cliente está logado
        if (!isset($_SESSION['userId'])) {
            $_SESSION['erro'] = 'Faça login para reservar.';
            header('Location: ' . BASE_URL . 'login');
            exit();
        }
    
        // Obtém o id do cliente a partir da sessão
        $id_cliente = $_SESSION['userId'];
    
        // **Zera o carrinho completamente**
        $_SESSION['carrinho'] = [];  // Garante que o carrinho esteja vazio
    
        // Cria uma instância do modelo Produto
        $produtoModel = new Produto();
    
        // Chama o método adicionar do modelo Produto para fazer a reserva
        $produtoModel->adicionar($idProduto, $id_cliente);
    
        // Redireciona o usuário para a página de reservas
        header('Location: ' . BASE_URL . 'reservas');
        exit();
    }
    
    
}
