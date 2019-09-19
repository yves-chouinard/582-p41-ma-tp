<h1>Fil de discussion</h1>

<?php if (isset($data['message'])) { ?>
    <p class="message-succes"><?= htmlspecialchars($data['message']) ?></p>
<?php } ?>

<div class="liste-articles">
    <?php
        afficheArticle($data['sujet']);

        foreach ($data['reponses'] as $reponse) {
            afficheArticle($reponse);
        }
    ?>
    
    <a href="index.php?reponses&action=nouvelle&id-sujet=<?= $data['sujet']->id ?>">
        <button>Répondre à ce sujet</button>
    </a>
</div>

<?php

function afficheArticle($article) {
    $class = strtolower(get_class($article));
    $titre = htmlspecialchars($article->titre);
    $nomUsager = htmlspecialchars($article->nom_usager);
    $texte = nl2br(htmlspecialchars($article->texte));
?>
    <article class="<?= $class ?>">
        <header>
            <span class="titre"><?= $titre ?></span>
            <span class="auteur">Par <?= $nomUsager ?></span>
        </header>

        <p><?= $texte ?></p>
    </article>
<?php
}

?>