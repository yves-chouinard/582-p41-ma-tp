<?php

class Modele_Usagers extends BaseDAO {
    public function getTableName() { return "p41_tp_usager"; }
    public function getClePrimaire() { return "nom_usager"; }

    /* Retour objet Usager si authentification réussie, false sinon. */
    public function authentifier($nomUsager, $motPasse) {
        $resultat = $this->lire($nomUsager);
        $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
        $usager = $resultat->fetch();
        
        return ($usager && password_verify($motPasse, $usager->mot_passe)) ? $usager : false;
    }

    /*
        Retourne la liste des usagers réguliers classés par ordre alphabétique.
    */
    
    public function obtenirNonAdmins() {
        $tableUsager = $this->getTableName();
        $sql = "SELECT * FROM $tableUsager WHERE est_admin = FALSE ORDER BY nom_usager";
        
        $resultat = $this->requete($sql);
        
        $usagers = $resultat->fetchAll(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager"
        );
        
        return $usagers;
    }
    
    /*
        Fonctions qui changent la valeur du champ est_banni. Retournent 1 si l'opération a réussi, 0 sinon.
    */
    
    public function changerEstBanni($nomUsager, $estBanni) {
        $tableUsager = $this->getTableName();
        $sql = "UPDATE $tableUsager SET est_banni = ? WHERE nom_usager = ?";
        $resultat = $this->requete($sql, array($estBanni, $nomUsager));
        return $resultat->rowCount();
    }
    
    public function bannir($nomUsager) {
        return $this->changerEstBanni($nomUsager, true);
    }
    
    public function reinstaurer($nomUsager) {
        return $this->changerEstBanni($nomUsager, false);
    }
}