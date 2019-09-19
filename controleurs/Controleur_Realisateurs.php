<?php

    class Controleur_Realisateurs extends BaseControleur
    {
        public function traite(array $params)
        {
            echo "Nous sommes dans le controleur Realisateurs!";
            if(isset($params["action"]))
                echo "L'action est " . $params["action"];
        }
    }
?>