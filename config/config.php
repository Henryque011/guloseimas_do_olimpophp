<?php 

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// define("BASE_URL","http://localhost/guloseimas_do_olimpophp/public");
define("BASE_URL","http://localhost/guloseimas_do_olimpophp/guloseimas_do_olimpophp/public/");

// define("DB_HOST", "smpsistema.com.br");
// define("DB_NAME", "u283879542_henryque");
// define("DB_USER", "u283879542_henryque");
// define("DB_PASS", "Henryque@tipi02");

//configuração do Databases
define("DB_HOST", "smpsistema.com.br");
define("DB_NAME", "u283879542_henryque");
define("DB_USER", "u283879542_henryque");
define("DB_PASS", "Henryque@tipi02");

spl_autoload_register(function ($classe){
    if(file_exists('..app/controllers'. $classe . '.php')){
        require_once '../app/controllers/' . $classe . '.php';
        // var_dump('../app/controllers/'. $classe .'.php');
    }

    if(file_exists('../app/models/'. $classe . '.php')){
        require_once '../app/models/'. $classe . '.php';
    }

    if(file_exists('../core/'. $classe .'.php')){
        require_once '../core/' . $classe .'.php';
    }
});