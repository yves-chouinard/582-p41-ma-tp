<?php

class Modele_Sujets extends BaseDAO {
    public function getTableName() { return "p41_tp_sujet"; }
    public function getClePrimaire() { return "id"; }

    public function obtenirTous() {
        $tableSujet = $this->getTableName();
        $tableReponse = "p41_tp_reponse";
        
        /*
            Un sujet auquel on vient de répondre se retrouve en haut de la liste. Même chose pour un nouveau sujet, d'où l'utilisation de GREATEST pour l'ordre (le dernier des deux : la date de création du sujet ou celle de sa dernière réponse).
        */
        
        $sql = "
            SELECT $tableSujet.*, COUNT($tableReponse.id) AS nombre_reponses
            FROM $tableSujet LEFT JOIN $tableReponse
            ON $tableReponse.id_sujet = $tableSujet.id
            GROUP BY $tableSujet.id
            ORDER BY GREATEST(
                $tableSujet.date_creation,
                IFNULL(MAX($tableReponse.date_creation), '0000-00-00')
            ) DESC
        ";
        
        $resultat = $this->requete($sql);
        
        $sujets = $resultat->fetchAll(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Sujet"
        );
        
        return $sujets;
    }

    public function obtenirParId($id) {
        $resultat = $this->lire($id);
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Sujet");
        $sujet = $resultat->fetch();
        return $sujet;
    }
    
    public function sauvegarder(Sujet $sujet) {
        /* Si le sujet existe déjà (id pas zéro et présent dans la BD) */
        if ($sujet->id && $this->lire($sujet->id)->rowCount() > 0) {
            /* Mettre à jour - à ajouter plus tard */
        }
        else {
            /* Insertion */
            $sql = "INSERT INTO " . $this->getTableName() . " (titre, texte, nom_usager) VALUES (?, ?, ?)";
            $donnees = array($sujet->titre, $sujet->texte, $sujet->nom_usager);
            $resultat = $this->requete($sql, $donnees);
        }
        
        return $resultat;
    }
    
    public function occire(Sujet $sujet) {
        if ($sujet->id)
            $this->supprimer($sujet->id);
    }
}