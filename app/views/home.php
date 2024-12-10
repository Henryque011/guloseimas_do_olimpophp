<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guloseimas Do Olimpo</title>
    <meta name="author" content="©SenaCria">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Compatibilidade com o EDGE -->
    <link rel="shortcut icon" href="public/assets/img/logo_header.svg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="public/vendors/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="public/vendors/slick/slick-theme.css" />

    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/reset.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CB1WZZ9KRY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-CB1WZZ9KRY');
    </script>

</head>

<body>

    <?php require_once('template/vlibras.php'); ?>

    <?php require_once('template/header.php'); ?>

    <?php require_once('template/ben_vindo.php'); ?>

    <?php require_once('template/destaques.php'); ?>

    <?php require_once('template/qualidade_especial.php'); ?>

    <?php require_once('template/sobre_pessoa.php'); ?>

    <?php require_once('template/banner_chocolate.php'); ?>

    <?php require_once('template/footer.php'); ?>

    <!-- Vlibras - acessibilidade - script -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <script src="https://kit.fontawesome.com/a327b26a99.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="public/vendors/slick/slick.min.js"></script>
    <script type="text/javascript" src="public/assets/js/animacao.js"></script>
    <script src="public/assets/js/mobile-navbar.js"></script>
</body>
</html>