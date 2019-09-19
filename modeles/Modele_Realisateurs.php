<?php
    class Modele_Realisateurs extends BaseDAO
    {       
        public function getTableName()
        {
            return "realisateurs";
        }
        
        public function getClePrimaire()
        {
            return "id";
        }
        public function obtenir_par_id($id)
        {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Realisateur");
            $leRealisateur = $resultat->fetch();
            return $leRealisateur;
        }
        public function obtenir_tous()
        {
            $resultat = $this->lireTous();
            $lesRealisateurs = $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Realisateur");
            return $lesRealisateurs;
        }
        
    }

?>