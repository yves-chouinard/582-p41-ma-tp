<?php
    class Film
    {
        public $id;
        public $titre;
        public $description;
        public $idRealisateur;
        
        public function __construct($id = 0, $t = "", $d = "", $idR = 0)
        {
            $this->id = $id;
            $this->titre = $t;
            $this->description = $d;
            $this->idRealisateur = $idR;
        }
    }
?>