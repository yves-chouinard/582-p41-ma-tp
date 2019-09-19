<?php

class Controleur_Usagers extends BaseControleur {
    public function traite(array $params) {       
        $action = isset($params['action']) ? $params['action'] : 'formIdentification';
        
        switch ($action) {
            case 'formIdentification':
                $this->formIdentification();
                break;

            case 'ouvreSession':
                $this->ouvreSession($params);
                break;

            case 'fermeSession':
                $this->fermeSession($params);
                break;

            case 'admin':
                $this->admin();
                break;

            case 'bannis':
                $this->bannis($params);
                break;

            case 'reinstaure':
                $this->reinstaure($params);
                break;

            default:
                $this->afficheErreur("Action non valide");
        }
    }
    
    /*
        Formulaire d'ouverture de session 
    */
    
    public function formIdentification() {
        $this->affichePage('FormIdentification');
    }
    
    /*
        Ouvre une session d'après les paramètres nom-usager et mot-passe. Va a la liste des sujets si l'opération est réussie; retourne au formulaire d'ouverture de session si l'authentification a échoué ou si l'usager est banni.
    */
    
    public function ouvreSession(array $params) {
        $nomUsager = isset($params['nom-usager']) ? $params['nom-usager'] : null;
        $motPasse = isset($params['mot-passe']) ? $params['mot-passe'] : null;
        
        if (!$nomUsager || !$motPasse)
            return $this->afficheErreur("Paramètres d'ouverture de session non valides");

        $modele = $this->getDAO('Usagers');
        $usager = $modele->authentifier($nomUsager, $motPasse);
        
        if ($usager) {
            if ($usager->est_banni) {
                /* L'usager est banni - retour au formulaire */
                $data['message'] = "Vous n'avez plus accès au site. Pour ravoir l'accès, veuillez communiquer avec l’administrateur.";
                $this->affichePage('FormIdentification', $data);
            }
            else {
                /* Authentification réussie - ouverture de session */
                $_SESSION['usager'] = $usager;
                header("Location: index.php?sujets");
                die();                
            }
        }
        else {
            /* Échec d'authentification - retour au formulaire */
            $data['message'] = "Erreur d'authentification";            
            $this->affichePage('FormIdentification', $data);
        }
    }
    
    /*
        Ferme la session courante et retourne à la page d'ouverture de session.
    */
    
    public function fermeSession(array $params) {
        unset($_SESSION['usager']);
        $this->affichePage('FormIdentification');
    }
    
    /*
        Page d'administration permettant de bannir ou réinstaurer des usagers
    */
    
    public function admin() {
        $modele = $this->getDAO('Usagers');
        $data['usagers'] = $modele->obtenirNonAdmins();
        $this->affichePage('AdminUsagers', $data);
    }
    
    /*
        Bannit un usager selon le paramétre nom-usager.
    */
    
    public function bannis($params) {
        $nomUsager = isset($params['nom-usager']) ? $params['nom-usager'] : null;
        
        if (!$nomUsager)
            return $this->afficheErreur("Nom d'usager manquant");

        $modele = $this->getDAO('Usagers');
        $estBanni = $modele->bannir($nomUsager);
        
        if (!$estBanni)
            return $this->afficheErreur("Usager inexistant");
        
        $this->retourPageCour("L'usager a été banni.");
    }
    
    /*
        Réinstaure un usager selon le paramétre nom-usager.
    */
    
    public function reinstaure($params) {
        $nomUsager = isset($params['nom-usager']) ? $params['nom-usager'] : null;
        
        if (!$nomUsager)
            return $this->afficheErreur("Nom d'usager manquant");

        $modele = $this->getDAO('Usagers');
        $estReinstaure = $modele->reinstaurer($nomUsager);
        
        if (!$estReinstaure)
            return $this->afficheErreur("Usager inexistant");
        
        $this->retourPageCour("L'usager a été réinstauré.");
    }
}