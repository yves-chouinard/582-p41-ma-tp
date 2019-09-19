<?php

class Modele_Reponses extends BaseDAO {
    public function getTableName() { return "p41_tp_reponse"; }
    public function getClePrimaire() { return "id"; }

    public function obtenirParId($id) {
        $resultat = $this->lire($id);
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Reponse");
        $reponse = $resultat->fetch();
        return $reponse;
    }
    
    public function obtenirParIdSujet($idSujet) {
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id_sujet=? ORDER BY date_creation";
        $donnees = array($idSujet);
        $resultat = $this->requete($sql, $donnees);
        
        $reponses = $resultat->fetchAll(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Reponse"
        );
        
        return $reponses;
    }
    
    public function sauvegarder(Reponse $reponse) {
        /* Si la réponse existe déjà (id pas zéro et présent dans la BD) */
        if ($reponse->id && $this->lire($reponse->id)->rowCount() > 0) {
            /* mettre à jour - à ajouter plus tard */
        }
        else {
            /* Insertion */
            $sql = "INSERT INTO " . $this->getTableName() . " (titre, texte, nom_usager, id_sujet) VALUES (?, ?, ?, ?)";
            
            $donnees = array(
                $reponse->titre, $reponse->texte,
                $reponse->nom_usager, $reponse->id_sujet
            );
            
            $resultat = $this->requete($sql, $donnees);
        }
        
        return $resultat;
    }
    
    public function occire(Reponse $reponse) {
        if ($reponse->id)
            $this->supprimer($reponse->id);
    }
}