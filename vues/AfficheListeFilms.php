<h1>Affichage de tous les films</h1>
<ul>
    <?php
        foreach($data["films"] as $film)
        {
            echo "<li>" . $film->titre . "</li>";
        }
    ?>
</ul>
