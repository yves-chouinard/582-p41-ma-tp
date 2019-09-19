<?php

$titre = isset($data['sujet']) ? htmlspecialchars($data['sujet']->titre) : "";
$texte = isset($data['sujet']) ? htmlspecialchars($data['sujet']->texte) : "";
$erreurTitre = isset($data['erreur']['titre']) ? htmlspecialchars($data['erreur']['titre']) : "";
$erreurTexte = isset($data['erreur']['texte']) ? htmlspecialchars($data['erreur']['texte']) : "";

?>

<h1>Création d'un nouveau sujet</h1>

<form method="post">
    <input type="hidden" name="action" value="nouveau">
    
    <div class="groupe-form">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="<?= $titre ?>">
        
        <?php if ($erreurTitre) { ?>
            <span class="erreur-form"><?= $erreurTitre ?></span>
        <?php } ?>
    </div>

    <div class="groupe-form">
        <label for="texte">Texte</label>        
        <textarea name="texte" id="texte"><?= $texte ?></textarea>
        
        <?php if ($erreurTexte) { ?>
            <span class="erreur-form"><?= $erreurTexte ?></span>
        <?php } ?>
    </div>
    
    <input type="submit" value="Créer le sujet">
</form>