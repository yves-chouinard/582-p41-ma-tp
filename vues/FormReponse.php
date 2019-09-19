<?php

$titre = isset($data['reponse']) ? htmlspecialchars($data['reponse']->titre) : "";
$texte = isset($data['reponse']) ? htmlspecialchars($data['reponse']->texte) : "";
$erreurTitre = isset($data['erreur']['titre']) ? htmlspecialchars($data['erreur']['titre']) : "";
$erreurTexte = isset($data['erreur']['texte']) ? htmlspecialchars($data['erreur']['texte']) : "";

?>

<h1>Enregistrement d'une réponse</h1>

<form method="post">
    <input type="hidden" name="action" value="nouvelle">
    
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
    
    <input type="hidden" name="id-sujet" value="<?= $data['sujet']->id ?>">
    <input type="submit" value="Enregistrer la réponse">
</form>