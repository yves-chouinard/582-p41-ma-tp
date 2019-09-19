<h1>Bienvenue - Veuillez vous identifier</h1>

<?php if (isset($data['message'])) { ?>
    <p class="message-erreur"><?= htmlspecialchars($data['message']) ?></p>
<?php } ?>

<form method="post">
    <input type="hidden" name="action" value="ouvreSession">
    
    <div class="groupe-form">
        <label for="nom-usager">Nom d'usager</label>
        <input type="text" name="nom-usager" id="nom-usager" required>
    </div>

    <div class="groupe-form">
        <label for="mot-passe">Mot de passe</label>
        <input type="password" name="mot-passe" id="mot-passe" required>
    </div>
    
    <input type="submit" value="Ouvrir une session">
</form>