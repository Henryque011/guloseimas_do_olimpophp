<?php
// CARREGA MINHAS CONFIGURAÇÕES INICIAS 
 require_once('../config/config.php');
   require_once('../core/Core.php'); // Inclui a classe Core
//    echo "Core.php carregado com sucesso!<br>";
// NUCLEO DA APLICÃO

$nucleo = new Core();
$nucleo->executar();