<?php

class LoginController extends Controller
{
    public function index()
    {
        // Variável para armazenar os dados que serão passados para as views
        $dados = array();
        $banner_login = new Banner();
        $login_banner = $banner_login->getBanner_login();

        $dados['banner'] =  $login_banner;

        // Carrega a view de login
        $this->carregarViews('login', $dados);
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
                    // Se o email for encontrado como funcionário, armazena as informações na sessão
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Funcionario';
                    $_SESSION['user_id'] = $funcionario['id_funcionario']; // Corrigido para 'id_funcionario'
                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }
    
                // Se não encontrar no modelo de Funcionário, verifica no modelo de Cliente
                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);
    
                if ($cliente) {
                    // Se o email for encontrado como cliente, armazena as informações na sessão
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['user_id'] = $cliente['id_cliente']; // Corrigido para 'id_cliente'
                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }
    
                // Se o email não for encontrado em nenhum dos modelos, redireciona para criar conta
                // $_SESSION['login-erro'] = 'Email não encontrado. Crie sua conta!';
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

    public function sair(){
        // Destrói a sessão para logout
        session_unset();
        session_destroy();

        // Redireciona para a página inicial após o logout
        header('Location: ' . BASE_URL);
        exit;
    }
}
