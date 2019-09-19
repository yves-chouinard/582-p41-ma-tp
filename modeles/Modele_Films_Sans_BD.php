<?php
    class Modele_Films
    {
        private $films = array(
            "1" => array("titre" => "Jaws", "description" => "Film de requins."),
            "2" => array("titre" => "Titanic", "description" => "Film de bateau qui coule."),
            "3" => array("titre" => "Halloween", "description" => "Film de tueur.")
        );
        
        public function obtenir_par_id($id)
        {
            return $this->films[$id];
        }
        public function obtenir_tous()
        {
            return $this->films;
        }
    }

?>