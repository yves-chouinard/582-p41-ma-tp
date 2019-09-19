<?php

class Controleur_Reponses extends BaseControleur {
    public function traite(array $params) {
        /* Toutes les actions demandent d'être logué. */
        if (!isset($_SESSION['usager'])) {
            header("Location: index.php");
            die();
        }

        $action = isset($params['action']) ? $params['action'] : '';
        
        switch ($action) {
            case 'nouvelle':
                $this->nouvelle($params);
                break;

            case 'supprime':
                $this->supprime($params);
                break;

            default:
                $this->afficheErreur("Action non valide");
        }
    }
    
    /* Création d'un nouvelle réponse à un sujet donné */
    public function nouvelle($params) {
        $idSujet = isset($params['id-sujet']) ? $params['id-sujet'] : null;
        
        if (!is_numeric($idSujet) || $idSujet <= 0)
            return $this->afficheErreur("Identificateur de sujet non valide");

        $modele = $this->getDAO('Sujets');
        $data['sujet'] = $modele->obtenirParId($idSujet);
        
        if (!$data['sujet'])
            return $this->afficheErreur("Sujet inexistant");

        if (isset($params['titre'], $params['texte'])) {
            /* Traitement du formulaire */
            $reponse = new Reponse(
                0, trim($params['titre']), trim($params['texte']),
                $_SESSION['usager']->nom_usager, $idSujet
            );
            
            if (!$reponse->titre)
                $data['erreur']['titre'] = "Le titre ne doit pas être vide.";
            
            if (!$reponse->texte)
                $data['erreur']['texte'] = "Le texte ne doit pas être vide.";
            
            if (isset($data['erreur'])) {
                /* Retour au formulaire avec messages d'erreur */
                $data['reponse'] = $reponse;
                $this->affichePage('FormReponse', $data);
            }
            else {
                /* Création du nouveau sujet dans la base de données */
                $modele = $this->getDAO('Reponses');
                $modele->sauvegarder($reponse);
                $this->retourPagePrec("Votre réponse est enregistrée.");
            }
        }
        else {
            /* Affichage du formulaire vierge */
            $this->affichePage('FormReponse', $data);
        }
    }
    
    /* Suppression d'une réponse d'après son identifiant */
    public function supprime($params) {
        /* Action réservée aux administrateurs */
        if (!$_SESSION['usager']->est_admin) {
            return $this->afficheErreur("Action non disponible");
        }

        $id = isset($params['id']) ? $params['id'] : null;
        
        if (!is_numeric($id) || $id <= 0)
            return $this->afficheErreur("Identificateur de réponse non valide");

        $modele = $this->getDAO('Reponses');
        $reponse = $modele->obtenirParId($id);
        
        if (!$reponse)
            return $this->afficheErreur("Réponse inexistante");

        $resultat = $modele->occire($reponse);
        $this->retourPageCour("La réponse a été supprimée.");
    }
}