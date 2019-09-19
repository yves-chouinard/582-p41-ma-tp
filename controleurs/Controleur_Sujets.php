<?php

class Controleur_Sujets extends BaseControleur {
    public function traite(array $params) {
        /* Toutes les actions demandent d'être logué. */
        if (!isset($_SESSION['usager'])) {
            header("Location: index.php");
            die();
        }

        $action = isset($params['action']) ? $params['action'] : 'afficheListe';
        
        switch ($action) {
            case 'afficheListe':
                $this->afficheListe();
                break;

            case 'affiche':
                $this->affiche($params);
                break;

            case 'nouveau':
                $this->nouveau($params);
                break;

            case 'supprime':
                $this->supprime($params);
                break;

            default:
                $this->afficheErreur("Action non valide");
        }
    }
    
    /* Affichage de la liste des sujets */
    public function afficheListe() {
        $modele = $this->getDAO('Sujets');
        $data['sujets'] = $modele->obtenirTous();
        $this->affichePage('AfficheListeSujets', $data);
    }
    
    /* Affichage d'un seul sujet (id en paramètre) */
    public function affiche(array $params) {
        $id = isset($params['id']) ? $params['id'] : null;
        
        if (!is_numeric($id) || $id <= 0)
            return $this->afficheErreur("Identificateur de sujet non valide");

        $modele = $this->getDAO('Sujets');
        $data['sujet'] = $modele->obtenirParId($id);
        
        if (!$data['sujet'])
            return $this->afficheErreur("Sujet inexistant");

        $modele = $this->getDAO('Reponses');
        $data['reponses'] = $modele->obtenirParIdSujet($id);
        
        $this->affichePage('AfficheSujet', $data);           
    }
    
    /* Création d'un nouveau sujet */
    public function nouveau($params) {
        if (isset($params['titre'], $params['texte'])) {
            /* Traitement du formulaire */
            $sujet = new Sujet(
                0, trim($params['titre']), trim($params['texte']),
                $_SESSION['usager']->nom_usager
            );
            
            if (!$sujet->titre)
                $data['erreur']['titre'] = "Le titre ne doit pas être vide.";
            
            if (!$sujet->texte)
                $data['erreur']['texte'] = "Le texte ne doit pas être vide.";
            
            if (isset($data['erreur'])) {
                /* Retour au formulaire avec messages d'erreur */
                $data['sujet'] = $sujet;
                $this->affichePage('FormNouveauSujet', $data);
            }
            else {
                /* Création du nouveau sujet dans la base de données */
                $modele = $this->getDAO('Sujets');
                $modele->sauvegarder($sujet);
                $this->retourPagePrec("Le nouveau sujet est enregistré.");
            }
        }
        else {
            /* Affichage du formulaire vierge */
            $this->affichePage('FormNouveauSujet');
        }
    }
    
    /* Suppression d'un sujet d'après son identifiant */
    public function supprime($params) {
        /* Action réservée aux administrateurs */
        if (!$_SESSION['usager']->est_admin) {
            return $this->afficheErreur("Action non disponible");
        }

        $id = isset($params['id']) ? $params['id'] : null;
        
        if (!is_numeric($id) || $id <= 0)
            return $this->afficheErreur("Identificateur de sujet non valide");

        $modele = $this->getDAO('Sujets');
        $sujet = $modele->obtenirParId($id);
        
        if (!$sujet)
            return $this->afficheErreur("Sujet inexistant");

        $resultat = $modele->occire($sujet);
        $this->retourPageCour("Le fil de conversation a été supprimé.");
    }
}