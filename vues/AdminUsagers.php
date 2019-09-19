<h1>Administration des usagers</h1>

<?php if (isset($data['message'])) { ?>
    <p class="message-succes"><?= htmlspecialchars($data['message']) ?></p>
<?php } ?>

<table class="usagers">
    <thead>
        <tr><th>Nom d'usager</th><th>Statut</th></tr>
    </thead>
    
    <tbody>
        <?php
            foreach ($data['usagers'] as $usager) {
                $nomUsager = htmlspecialchars($usager->nom_usager);
                
                if ($usager->est_banni) {
                    $texteStatut = "BANNI";
                    $classeStatut = "statut-banni";
                    $texteBouton = "Réinstaurer";
                    $hrefBouton = "index.php?usagers&action=reinstaure&nom-usager=" . $usager->nom_usager;
                }
                else {
                    $texteStatut = "Actif";
                    $classeStatut = "statut-actif";
                    $texteBouton = "Bannir";
                    $hrefBouton = "index.php?usagers&action=bannis&nom-usager=" . $usager->nom_usager;                    
                }
        ?>
                <tr>
                    <td class="nom-usager"><?= $nomUsager ?></td>
                    <td class="<?= $classeStatut ?>"><?= $texteStatut ?></td>
                    <td class="bouton"><a href="<?= $hrefBouton ?>"><button><?= $texteBouton ?></button></a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>