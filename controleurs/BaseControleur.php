<?php

abstract class BaseControleur
{
    //la fonction qui sera appelée par le routeur
    public abstract function traite(array $params);

    protected function afficheVue($nomVue, $data = null)
    {
        $cheminVue = RACINE . "vues/" . $nomVue . ".php";

        if(file_exists($cheminVue))
        {
            include_once($cheminVue);
        }
        else
        {
            trigger_error("Erreur 404! La vue $nomVue n'existe pas.");
        }
    }

    protected function getDAO($nomModele)
    {
        $classe = "Modele_" . $nomModele;

        if(class_exists($classe))
        {
            //on fait une connexion à la BD
            $connexion = DBFactory::getDB(DBTYPE, DBNAME, HOST, USER, PWD);

            //on crée une instance de la classe Modele_$classe
            $objetModele = new $classe($connexion);


            if($objetModele instanceof BaseDAO)
            {
                return $objetModele;
            }
            else
                trigger_error("Modèle invalide.");
        }
    }
        
    public function affichePage($vue, $data = null)
    {
        /* Pour retour arrière */
        if
        (
            isset($_SESSION['PAGE_COUR']) &&
            $_SESSION['PAGE_COUR'] != $_SERVER['REQUEST_URI']
        )
        {
            $_SESSION['PAGE_PREC'] = $_SESSION['PAGE_COUR'];
        }
        
        $_SESSION['PAGE_COUR'] = $_SERVER['REQUEST_URI'];
        
        /* Affichage du message si on vient de faire un retour arrière */
        if (isset($_SESSION['MESSAGE']))
        {
            $data['message'] = $_SESSION['MESSAGE'];
            unset($_SESSION['MESSAGE']);
        }
        
        $this->afficheVue('Header');        
        $this->afficheVue($vue, $data);
        $this->afficheVue('Footer');
    }
    
    protected function afficheErreur($message)
    {
        http_response_code(500);
        $data['message'] = $message;
        $this->affichePage('Erreur', $data);
    }
    
    protected function retourPagePrec($message = null) {
        $_SESSION['MESSAGE'] = $message;
        header("Location: " . $_SESSION['PAGE_PREC']);
        die();
    }
    
    protected function retourPageCour($message = null) {
        $_SESSION['MESSAGE'] = $message;
        header("Location: " . $_SESSION['PAGE_COUR']);
        die();
    }
}