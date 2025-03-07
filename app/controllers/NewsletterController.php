<?php

class NewsletterController extends Controller
{
    private $Newsletter;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->Newsletter = new Newsletter();
    }

    public function index()
    {
        $dados = array();

        $banner_contato = new Banner();
        $contato_banner = $banner_contato->getBanner_contato();

        $dados['nome'] = 'cheguei aqui';
        $dados['banner'] = $contato_banner;

        $this->carregarViews('contato', $dados);
    }

    public function enviarNewsletter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email_newsletter', FILTER_SANITIZE_EMAIL);

            if ($email) {
                $Newsletter = new Newsletter();
                $salvar = $Newsletter->salvarNewsletter($email);

                if (!$salvar) {
                    $_SESSION['mensagem'] = '⚠️ Este e-mail já está cadastrado!';
                    $_SESSION['status'] = 'erro';
                    header('Location: ' . BASE_URL);
                    exit;
                }

                require_once("vendors/phpmailer/PHPMailer.php");
                require_once("vendors/phpmailer/SMTP.php");
                require_once("vendors/phpmailer/Exception.php");

                $phpmail = new PHPMailer\PHPMailer\PHPMailer();

                try {
                    // Envio para o administrador do site
                    $phpmail->isSMTP();
                    $phpmail->SMTPDebug = 0;
                    $phpmail->Host = HOTS_EMAIL;
                    $phpmail->Port = PORT_EMAIL;
                    $phpmail->SMTPSecure = 'ssl';
                    $phpmail->SMTPAuth = true;
                    $phpmail->Username = USER_EMAIL;
                    $phpmail->Password = PASS_EMAIL;
                    $phpmail->IsHTML(true);
                    $phpmail->setFrom(USER_EMAIL, '📢 Novo Inscrito - Guloseimas do Olimpo');
                    $phpmail->addAddress(USER_EMAIL, 'Goloseimas do Olimpo - Atendimento');

                    $phpmail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    $phpmail->CharSet = 'UTF-8';
                    $phpmail->Encoding = 'base64';
                    $phpmail->Subject = '📩 Novo Inscrito na Newsletter!';
                    $phpmail->msgHTML("<p><strong>Olá, equipe!</strong></p>
                                       <p>🎉 Um novo usuário se cadastrou na newsletter:</p>
                                       <ul>
                                           <li><strong>E-mail:</strong> <a href='mailto:$email'>$email</a></li>
                                       </ul>
                                       <p>💬 Entrem em contato para dar boas-vindas ou enviar novidades!</p>
                                       <p><strong>Equipe Guloseimas do Olimpo</strong></p>");
                    $phpmail->AltBody = "Novo Inscrito na Newsletter!\n\nE-mail: $email";

                    $phpmail->send();

                    // Envio do e-mail de confirmação para o usuário
                    $phpmail->clearAddresses();
                    $phpmail->addAddress($email);
                    $phpmail->Subject = '✅ Inscrição Confirmada na Newsletter!';
                    $phpmail->msgHTML("<div style='font-family: Arial, sans-serif; padding: 20px;'>
                                       <h2 style='color: #D2691E;'>🍫 Bem-vindo à Newsletter da Guloseimas do Olimpo! 🎉</h2>
                                       <p>Olá,</p>
                                       <p>Estamos muito felizes em ter você por aqui! Agora você receberá:</p>
                                       <ul>
                                           <li>📢 Promoções exclusivas</li>
                                           <li>🎁 Novidades em primeira mão</li>
                                           <li>🍪 Receitas deliciosas e dicas</li>
                                       </ul>
                                       <p>📧 Fique de olho na sua caixa de entrada, pois em breve teremos surpresas para você!</p>
                                       <p>💛 Agradecemos por fazer parte do nosso time!</p>
                                       <p><strong>Equipe Guloseimas do Olimpo</strong></p>
                                       </div>");
                    $phpmail->AltBody = "Olá,\n\nObrigado por se inscrever na nossa Newsletter! Você receberá novidades e promoções em breve.";

                    $phpmail->send();

                   
                    $_SESSION['status'] = 'sucesso';
                    header('Location: ' . BASE_URL);
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensagem'] = '❌ Ocorreu um erro ao processar sua inscrição.';
                    $_SESSION['status'] = 'erro';
                    $_SESSION['erro'] = $phpmail->ErrorInfo;
                    error_log('Erro ao enviar o e-mail: ' . $phpmail->ErrorInfo);
                    header('Location: ' . BASE_URL);
                    exit;
                }
            } else {
                $_SESSION['mensagem'] = '⚠️ Por favor, insira um e-mail válido.';
                $_SESSION['status'] = 'erro';
                header('Location: ' . BASE_URL);
                exit;
            }
        } else {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    public function contato_Newsletter()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarEmails'] = $this->Newsletter->emails_Newsletter();
        $dados['conteudo'] = 'dash/newsletter/newsletter';

        $this->carregarViews('dash/dashboard', $dados);
    }
}
