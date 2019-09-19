<?php
    define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/582-P41-MA/tp-pwd3-gr16628/");
//    define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/tp-pwd3-gr16628/");

    //définition des constantes de connexion à la base de données
    define("DBTYPE", "mysql");
    define("DBNAME", "e1795915");
    define("HOST", "localhost");
    define("USER", "e1795915");
    define("PWD", "nj4dgHxaI5xpuQevK2pI");
//    define("DBTYPE", "mysql");
//    define("DBNAME", "forum");
//    define("HOST", "localhost");
//    define("USER", "root");
//    define("PWD", "root");
   
    //définition de ma fonction d'autoload
    function my_autoloader($classe)
    {
        $repertoires = array(RACINE . "controleurs/",
                             RACINE . "modeles/",
                             RACINE . "vues/"
                            );
            
        foreach($repertoires as $rep)
        {
            if(file_exists($rep . $classe . ".php"))
            {
                require_once($rep . $classe . ".php");
                return;
            }
        }
    }

    spl_autoload_register('my_autoloader');    
?>