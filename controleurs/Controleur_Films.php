<?php

    class Controleur_Films extends BaseControleur
    {
        public function traite(array $params)
        {       
            //si le paramètre action existe
            if(isset($params["action"]))
            {
                switch($params["action"])
                {
                    case "afficheListe":
                        $this->afficheVue("Header");
                        $this->afficheListeFilms();
                        $this->afficheFormAjoutFilm();
                        $this->afficheVue("Footer");
                        break;
                    case "affiche":
                        if(isset($params["id"]))
                        {
                            $modeleFilms = $this->getDAO("Films");
                            $donnees["film"] = $modeleFilms->obtenir_par_id($params["id"]);
                            $vue = "AfficheFilm";
                            $this->afficheVue("Header");
                            $this->afficheVue($vue, $donnees);
                            $this->afficheVue("Footer");

                        }
                        else
                        {
                            trigger_error("Pas d'id spécifié...");
                        }
                        break;
                    case "insereFilm":
                        $message = "";
                        //valider la présence des paramètres
                        if(isset($params["titre"], $params["description"], $params["idRealisateur"]))
                        {
                            //valider que les paramètres sont valides
                            $message = $this->valideFormFilm($params["titre"], $params["description"]);
                            
                            if($message == "")
                            {
                                //insertion
                                $modeleFilms = $this->getDAO("Films");
                                $nouveauFilm = new Film(0, $params["titre"], $params["description"], $params["idRealisateur"]);
                                
                                $resultat = $modeleFilms->sauvegarde($nouveauFilm);     
                                $message = "Insertion réussie!";
                                
                            }
                            
                        }
                        else
                        {
                            $message = "Paramètres invalides.";
                        }
                        
                        $this->afficheVue("Header");
                        $this->afficheListeFilms();
                        $this->afficheFormAjoutFilm($message);
                        $this->afficheVue("Footer");
                        break;
                    default :
                        trigger_error("Action invalide.");
                }
            }
            else
            {
                //action par défaut -- j'ai choisi d'afficher la liste de films
                $this->afficheVue("Header");
                $this->afficheListeFilms();
                $this->afficheFormAjoutFilm();
                $this->afficheVue("Footer");
            }  
            
        }
        
        //sous-routines de controle
        public function afficheListeFilms()
        {
            $modeleFilms = $this->getDAO("Films");
            $donnees["films"] = $modeleFilms->obtenir_tous();
            $vue = "AfficheListeFilms";
            $this->afficheVue($vue, $donnees);
        }
        
        public function afficheFormAjoutFilm($erreurs = "")
        {
            $modeleRealisateurs = $this->getDAO("Realisateurs");
            $donnees["realisateurs"] = $modeleRealisateurs->obtenir_tous();
            $donnees["erreurs"] = $erreurs;
            $vue = "FormAjoutFilm";
            $this->afficheVue($vue, $donnees);
        }
        
        //sous-routines de validation
        public function valideFormFilm($titre, $description)
        {
            $msgErreur = "";
            
            $titre = trim($titre);
            $description = trim($description);
            
            if($titre == "")
                $msgErreur .= "Le titre ne peut être vide.<br>";
            
            if(strlen($titre) > 250)
                $msgErreur .= "Le titre ne peut dépasser 250 caractères.";
            
            if($description == "")
                $msgErreur .= "La description ne peut être vide.<br>";
            
            return $msgErreur;
        }
    }
?>