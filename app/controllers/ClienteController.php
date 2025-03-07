<?php

class ClienteController extends Controller
{


    private $favoritosModel;
    private $clienteModel;

    public function __construct()
    {
        $this->favoritosModel = new Favoritos;
        $this->clienteModel = new Cliente;
    }


    public function index()
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $email = $_SESSION['userEmail']; // Pega o email do usuário logado
        $clienteModel = new Cliente();
        $cliente = $clienteModel->buscarCliente($email); // Busca no banco os dados do cliente

        if (!$cliente) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $id_cliente = $cliente['id_cliente']; // ID do cliente

        // Obtém os favoritos com os dados dos produtos diretamente
        $favoritosModel = new Favoritos();
        $favoritos = $favoritosModel->getFavoritosByCliente($id_cliente);

        // Dados a serem passados para a view
        $dados = [
            'nome' => $cliente['nome_cliente'],
            'cpf' => $cliente['cpf_cliente'],
            'email' => $cliente['email_cliente'],
            'telefone' => $cliente['telefone_cliente'],
            'senha' => $cliente['senha_cliente'], // A senha deve ser tratada com segurança
            'favoritos' => $favoritos // Passando os favoritos para a view
        ];

        // Carrega a view do painel do cliente com os dados
        $this->carregarViews('painel_cliente/painel_cliente', $dados);
    }






    public  function editar_cliente()
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $email = $_SESSION['userEmail']; // Pega o email do usuário logado
        $clienteModel = new Cliente();
        $cliente = $clienteModel->buscarCliente($email); // Busca no banco os dados do cliente


        if (!$cliente) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }


        $dados = [
            'nome' => $cliente['nome_cliente'],

            'cpf' => $cliente['cpf_cliente'],
            'email' => $cliente['email_cliente'],
            'telefone' => $cliente['telefone_cliente'],
            'senha' => $cliente['senha_cliente'], // A senha deve ser tratada com segurança
            'nascimento' => $cliente['data_nasc_cliente']
        ];


        $this->carregarViews('painel_cliente/editar_cliente', $dados);
    }


    public  function editar_senha_cliente()
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $email = $_SESSION['userEmail']; // Pega o email do usuário logado
        $clienteModel = new Cliente();
        $cliente = $clienteModel->buscarCliente($email); // Busca no banco os dados do cliente


        if (!$cliente) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }


        $dados = [
            'senha' => $cliente['senha_cliente']
        ];


        $this->carregarViews('painel_cliente/editar_senha_cliente', $dados);
    }

    public function historico_reserva()
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    
        $email = $_SESSION['userEmail']; // Pega o email do usuário logado
        $cliente = $this->clienteModel->buscarCliente($email); // Busca no banco os dados do cliente
    
        if (!$cliente) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    
        $id_cliente = $cliente['id_cliente'];
    
        // Obtém as reservas do cliente
        $reservasModel = new Reserva();
        $reservas = $reservasModel->listarReservasPorCliente($id_cliente);
    
        // Passa os dados para a view
        $dados = [
            'reservas' => $reservas
        ];
    
        // Carrega a view do histórico de reservas
        $this->carregarViews('painel_cliente/historico_reserva', $dados);
    }
    






    public function salvarEdicaoCliente()
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['userEmail']; // Email do usuário logado

            // Captura os dados do formulário
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

            // Validação básica
            if (empty($nome) || empty($cpf) || empty($telefone)) {
                $_SESSION['erro'] = 'Todos os campos são obrigatórios!';
                header('Location: ' . BASE_URL . 'editar_cliente');
                exit;
            }

            // Instancia o modelo Cliente e atualiza os dados
            $clienteModel = new Cliente();
            $atualizado = $clienteModel->atualizarCliente($email, $nome, $cpf, $telefone, $data_nascimento);

            if ($atualizado) {
                $_SESSION['sucesso'] = 'Dados atualizados com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao atualizar os dados!';
            }

            header('Location: ' . BASE_URL . 'cliente');
            exit;
        }
    }

    public function salvarEdicaoSenhaCliente()
    {
        if (!isset($_SESSION['userEmail'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $email = $_SESSION['userEmail'];
        $clienteModel = new Cliente();
        $cliente = $clienteModel->buscarCliente($email);

        if (!$cliente) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $senha_atual = $_POST['senha_atual'];
        $nova_senha = $_POST['nova_senha'];
        $confirmar_senha = $_POST['confirmar_senha'];

        // Verifica se a senha atual está correta (Comparação direta sem hash)
        if ($senha_atual !== $cliente['senha_cliente']) {
            $_SESSION['erro'] = "Senha atual incorreta!";
            echo json_encode(['sucesso' => false, 'erro' => $_SESSION['erro']]);
            exit;
        }

        // Verifica se as senhas novas coincidem
        if ($nova_senha !== $confirmar_senha) {
            $_SESSION['erro'] = "As senhas não coincidem!";
            echo json_encode(['sucesso' => false, 'erro' => $_SESSION['erro']]);
            exit;
        }

        // Atualiza a senha no banco sem hash
        if ($clienteModel->atualizarSenha($email, $nova_senha)) {
            echo json_encode(['sucesso' => true]);
        } else {
            $_SESSION['erro'] = "Erro ao atualizar a senha!";
            echo json_encode(['sucesso' => false, 'erro' => $_SESSION['erro']]);
        }

        exit;
    }







    public function login()
    {




        // Inicia a sessão
        session_start();

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Captura os dados do formulário
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            // Verifica se o email foi preenchido corretamente
            if ($email) {
                // Verifica primeiro no modelo de Funcionário
                $funcionarioModel = new Funcionario($email);
                $funcionario = $funcionarioModel->buscarFunc($email);

                if ($funcionario) {
                    // Se o email for encontrado como funcionário, redireciona para a página de "entrar"
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Funcionario';

                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }

                // Se não encontrar no modelo de Funcionário, verifica no modelo de Cliente
                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);

                if ($cliente) {
                    // Se o email for encontrado como cliente, redireciona para a página de "entrar"
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Cliente';
                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }

                // Se o email não for encontrado em nenhum dos modelos, redireciona para criar conta
                $_SESSION['login-erro'] = 'Email não encontrado. Crie sua conta!';
                header('Location: ' . BASE_URL . 'criarconta');
                exit;
            } else {
                // Caso o email não seja válido
                $_SESSION['login-erro'] = 'Digite um email válido.';
            }

            // Redireciona para a página de login em caso de erro
            header('Location: ' . BASE_URL);
            exit;
        }

        // Carrega a view de login caso não seja um POST
        $this->carregarViews('login', $dados);
    }

    public function limpar_carrinho()
    {
        // Inicia a sessão caso ainda não esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Remove os itens do carrinho completamente
        $_SESSION['carrinho'] = [];
    
        // Retorna uma resposta JSON para o JavaScript
        echo json_encode(["status" => "success", "message" => "Carrinho completamente esvaziado"]);
        exit;
    }


    public function esvaziar_carrinho()
    {
        // Inicia a sessão caso ainda não esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Remove os itens do carrinho completamente
        $_SESSION['carrinho'] = [];
    
        // Redireciona para a página de produtos
        header("Location: " . BASE_URL . "produtos"); 
        exit;
    }
    
    
    
    


    public function sair()
    {
        // Destrói a sessão para logout
        session_unset();
        session_destroy();

        // Redireciona para a página inicial após o logout
        header('Location: ' . BASE_URL);
        exit;
    }
}
