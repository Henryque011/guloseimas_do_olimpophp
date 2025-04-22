<?php

class ApiController extends Controller
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $dados = array();
        $dados['titulos'] = 'Área de Atuação - Guloseimas do Olimpo';

        $this->carregarViews('api', $dados);
    }

    private function getAuthorizationHeader()
    {
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }

        if (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            foreach ($headers as $key => $value) {
                if (strtolower($key) === 'authorization') {
                    return trim($value);
                }
            }
        }

        return null;
    }

    private function autenticarToken()
    {
        try {
            $authHeader = $this->getAuthorizationHeader();

            if (!$authHeader || !preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token não fornecido ou malformado.']);
                exit;
            }

            $token = trim($matches[1]);

            if (!$token || strpos($token, '.') === false) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou incompleto.']);
                exit;
            }

            require_once 'core/TokenHelper.php';
            $TokenHelper = new TokenHelper();

            $dados = $TokenHelper::validar($token);

            if (!$dados || !isset($dados['id'], $dados['email'])) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou expirado.']);
                exit;
            }

            $cliente = $this->clienteModel->buscarCliente($dados['email']);

            if (!$cliente || $cliente['id_cliente'] != $dados['id']) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                exit;
            }

            return $cliente;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro interno: ' . $e->getMessage()]);
            exit;
        }
    }

    public function salvarCliente()
    {
        try {
            // Recebe os dados do corpo da requisição
            $input = json_decode(file_get_contents("php://input"), true);

            // Validação básica (pode expandir se quiser)
            $camposObrigatorios = ['nome', 'email', 'cpf', 'data_nasc', 'telefone', 'endereco', 'bairro', 'cidade', 'estado', 'cep', 'senha'];
            foreach ($camposObrigatorios as $campo) {
                if (empty($input[$campo])) {
                    http_response_code(400);
                    echo json_encode(['erro' => "O campo '$campo' é obrigatório."]);
                    return;
                }
            }

            // Pega os dados
            $nome = $input['nome'];
            $email = $input['email'];
            $cpf = $input['cpf'];
            $data_nasc = $input['data_nasc'];
            $telefone = $input['telefone'];
            $endereco = $input['endereco'];
            $bairro = $input['bairro'];
            $cidade = $input['cidade'];
            $estado = $input['estado']; // sigla
            $cep = $input['cep'];
            $senha = password_hash($input['senha'], PASSWORD_DEFAULT);

            // Tenta salvar o cliente
            $sucesso = $this->clienteModel->salvarCliente($nome, $email, $cpf, $data_nasc, $telefone, $endereco, $bairro, $cidade, $estado, $cep, $senha);

            if (!$sucesso) {
                http_response_code(500);
                echo json_encode(['erro' => 'Erro ao salvar cliente.']);
                return;
            }

            // Buscar o cliente para pegar o ID
            $cliente = $this->clienteModel->buscarCliente($email);
            if (!$cliente) {
                http_response_code(500);
                echo json_encode(['erro' => 'Erro ao recuperar cliente salvo.']);
                return;
            }

            // Gerar o token
            require_once 'core/TokenHelper.php';
            $TokenHelper = new TokenHelper();
            $token = $TokenHelper::gerar([
                'id' => $cliente['id_cliente'],
                'email' => $cliente['email_cliente']
            ]);

            echo json_encode([
                'mensagem' => 'Cliente cadastrado com sucesso.',
                'token' => $token,
                'cliente' => [
                    'id' => $cliente['id_cliente'],
                    'nome' => $cliente['nome_cliente'],
                    'email' => $cliente['email_cliente']
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro interno: ' . $e->getMessage()]);
        }
    }

        public function cliente()
    {
        try {
            $clienteToken = $this->autenticarToken();
            $input = json_decode(file_get_contents("php://input"), true);

            if (empty($input['email'])) {
                http_response_code(400);
                echo json_encode(['erro' => 'Email não fornecido']);
                return;
            }

            $email = $input['email'];

            if ($clienteToken['email_cliente'] != $email) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                return;
            }

            $dados = $this->clienteModel->buscarCliente($email);

            if (!$dados) {
                http_response_code(404);
                echo json_encode(['erro' => 'Cliente não encontrado']);
                return;
            }

            echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro interno: ' . $e->getMessage()]);
        }
    }


    // public function cliente($email)
    // {
    //     var_dump($email);
    //     try {
    //         $cliente = $this->autenticarToken();

    //         // Verifica se o token está válido e pertence ao cliente requisitado
    //         if (!$cliente || !isset($cliente['email_cliente']) || $cliente['email_cliente'] != $email) {
    //             http_response_code(403);
    //             echo json_encode(['erro' => 'Acesso negado.']);
    //             return;
    //         }

    //         // Busca os dados completos do cliente no banco
    //         $dados = $this->clienteModel->buscarCliente($email);

    //         if (!$dados) {
    //             http_response_code(404);
    //             echo json_encode(['erro' => 'Cliente não encontrado']);
    //             return;
    //         }

    //         echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //     } catch (Exception $e) {
    //         http_response_code(500);
    //         echo json_encode([
    //             'erro' => 'Erro interno no servidor',
    //             'detalhe' => $e->getMessage()
    //         ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //     }
    // }
}
