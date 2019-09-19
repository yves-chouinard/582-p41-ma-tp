<?php
    class Realisateur
    {
        public $id;
        public $prenom;
        public $nom;
        public $bio;
        
        public function __construct($id = 0, $p = "", $n = "", $b = "")
        {
            $this->id = $id;
            $this->prenom = $p;
            $this->nom = $n;
            $this->bio = $b;
        }
    }
?>