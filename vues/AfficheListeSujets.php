<h1>Liste des sujets</h1>

<?php if (isset($data['message'])) { ?>
    <p class="message-succes"><?= htmlspecialchars($data['message']) ?></p>
<?php } ?>

<div class="liste-articles">
    <?php
        foreach ($data['sujets'] as $sujet) {
            $href = "index.php?sujets&action=affiche&id=" . $sujet->id;
            $titre = htmlspecialchars($sujet->titre);
            $nomUsager = htmlspecialchars($sujet->nom_usager);
    ?>
            <article class="sujet-resume">
                <!-- Titre et auteur du sujet -->
                <header>
                    <span class="titre"><a href="<?= $href ?>"><?= $titre ?></a></span>
                    <span class="auteur">Par <?= $nomUsager ?></span>
                </header>
                
                <!-- Bouton voir le fil de discussion -->
                <a href="<?= $href ?>"><button><?= texteBouton($sujet->nombre_reponses) ?></button></a>
                
                <?php if ($_SESSION['usager']->est_admin) { ?>
                    <!-- Bouton de suppression pour les admins -->
                    <a href="<?= "index.php?sujets&action=supprime&id=" . $sujet->id ?>"><i class="fas fa-trash-alt"></i></a>
                <?php } ?>
            </article>
    <?php
        }
    ?>
    
    <a href="index.php?sujets&action=nouveau"><button>Démarrer une nouvelle discussion</button></a>
</div>


<?php

function texteBouton($nombreReponses) {
    if ($nombreReponses > 1) {
        $chaine = "$nombreReponses réponses - Participez à la discussion";
    }
    else if ($nombreReponses == 1) {
        $chaine = "Une réponse - Participez à la discussion";
    }
    else {
        $chaine = "Soyez le premier à répondre";
    }
             
    return $chaine;
}

?>