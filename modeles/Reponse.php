<?php

class Reponse {
    public $id;
    public $titre;
    public $texte;
    public $nom_usager;
    public $id_sujet;

    public function __construct(
        $id = 0, $titre = "", $texte = "", $nom_usager = "", $id_sujet = 0
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->texte = $texte;
        $this->nom_usager = $nom_usager;
        $this->id_sujet = $id_sujet;
    }
}