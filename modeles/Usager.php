<?php

class Usager {
    public $nom_usager;
    public $mot_passe;
    public $est_admin;
    public $est_banni;

    public function __construct(
        $nom_usager = "", $mot_passe = "", $est_admin = false, $est_banni = false
    ) {
        $this->nom_usager = $nom_usager;
        $this->mot_passe = $mot_passe;
        $this->est_admin = $est_admin;
        $this->est_banni = $est_banni;
    }
}