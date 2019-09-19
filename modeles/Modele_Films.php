<?php
    class Modele_Films extends BaseDAO
    {       
        public function getTableName()
        {
            return "films";
        }
        
        public function getClePrimaire()
        {
            return "id";
        }
        public function obtenir_par_id($id)
        {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Film");
            $leFilm = $resultat->fetch();
            return $leFilm;
        }
        public function obtenir_tous()
        {
            $resultat = $this->lireTous();
            $lesFilms = $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Film");
            return $lesFilms;
        }
        
        public function sauvegarde(Film $leFilm)
        {
            //si le film existe déjà (id pas zéro ET présent dans la BD)
			if($leFilm->id && $this->lire($leFilm->id)->rowCount() > 0)
			{
				//mettre à jour - à ajouter plus tard
				
			}
			else
			{
				//insérer
				$query = "INSERT INTO " . $this->getTableName() . " (titre, description, idRealisateur) VALUES (?, ?, ?)";
				$donnees = array($leFilm->titre, $leFilm->description, $leFilm->idRealisateur);
				return $this->requete($query, $donnees);
			}
        }
    }

?>