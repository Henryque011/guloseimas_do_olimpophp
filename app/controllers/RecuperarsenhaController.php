<?php
require_once("vendors/phpmailer/PHPMailer.php");
require_once("vendors/phpmailer/SMTP.php");
require_once("vendors/phpmailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecuperarsenhaController extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Cliente();
    }

    public function index()
    {
        $dados = array();
        $banner_recuperar_senha = new Banner();
        $banner_senha_recuperar = $banner_recuperar_senha->getBanner_recuperar_senha();

        $dados['banner'] = $banner_senha_recuperar;

        $this->carregarViews('recuperar_senha', $dados);
    }

    public function enviarEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            // Verifica se o e-mail é válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mensagem = "⚠️ Oops! Parece que o e-mail informado não é válido. Dá uma conferida e tente novamente! 📧";
            } else {
                $usuario = $this->usuarioModel->buscarPorEmail($email);

                if ($usuario) {
                    // Gera uma nova senha temporária
                    $novaSenha = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

                    // Atualiza a senha no banco sem criptografia (NÃO RECOMENDADO!)
                    if ($this->usuarioModel->atualizarSenha($email, $novaSenha)) {
                        // Usando PHPMailer para enviar o e-mail com a nova senha
                        $mail = new PHPMailer(true);
                        try {
                            // Configurações do servidor SMTP
                        
                            $mail->isSMTP();
                            $mail->Host = HOTS_EMAIL;  // Defina o host do servidor SMTP
                            $mail->SMTPAuth = true;
                            $mail->Username = USER_EMAIL; // Defina o seu email
                            $mail->Password = PASS_EMAIL; // Defina a sua senha de app ou senha do email
                            $mail->Port = 587;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                            // Desativar a verificação de certificados SSL
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,           // Desativa a verificação do certificado
                                    'verify_peer_name' => false,      // Desativa a verificação do nome do certificado
                                    'allow_self_signed' => true       // Permite certificados autoassinados
                                )
                            );

                            // Remetente e destinatário
                            $mail->setFrom(USER_EMAIL, 'Suporte Guloseimas do Olimpo 🍬');
                            $mail->addAddress($email);

                            // Conteúdo do e-mail
                            $mail->isHTML(true);
                            $mail->CharSet = 'UTF-8'; // Garante que caracteres especiais e emojis sejam exibidos corretamente
                            $mail->Subject = '🔑 Acesso - Guloseimas do Olimpo';
                            $mail->Body    = "
                                <p>Olá, tudo bem? 😊</p>
                                <p>Recebemos sua solicitação de recuperação de senha! Aqui está sua nova senha temporária:</p>
                                <p style='font-size: 18px; font-weight: bold; color: #d35400;'>🔒 $novaSenha </p>
                                <p>Recomendamos que você altere sua senha assim que possível para garantir a segurança da sua conta. 🔐</p>
                                <p>Se precisar de ajuda, estamos à disposição! Entre em contato com nosso suporte. 📞</p>
                                <br>
                                <p>Atenciosamente,</p>
                                <p><strong>Equipe Guloseimas do Olimpo 🍭</strong></p>
                            ";

                            // Envia o e-mail
                            $mail->send();
                            $mensagem = "🎉 Tudo certo! Acabamos de enviar um e-mail com sua nova senha. Se não encontrar na caixa de entrada, dá uma olhadinha no spam! 📩";
                        } catch (Exception $e) {
                            $mensagem = "🚨 Ops! Algo deu errado ao enviar o e-mail. Tente novamente mais tarde ou entre em contato com o nosso suporte. 🤝";
                        }
                    } else {
                        $mensagem = "😕 Houve um probleminha ao atualizar sua senha. Por favor, tente novamente mais tarde ou entre em contato conosco!";
                    }
                } else {
                    $mensagem = "🔍 E-mail não encontrado! Dá uma conferida se digitou corretamente ou aproveite para criar uma nova conta. 😉";
                }
            }
            header("Location: " . BASE_URL . "entrar");
            exit;
            

            // Retorna a mensagem para a view
            $dados = ['mensagem' => $mensagem];
            $this->carregarViews('recuperar_senha', $dados);
        }
    }
}
