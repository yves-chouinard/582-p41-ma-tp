<?php

class Sujet {
    public $id;
    public $titre;
    public $texte;
    public $nom_usager;

    public function __construct(
        $id = 0, $titre = "", $texte = "", $nom_usager = ""
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->texte = $texte;
        $this->nom_usager = $nom_usager;
    }
}