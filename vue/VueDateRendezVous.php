<?php



?>

<p> Dates enregistrées</p>
<body>
    <h1>Liste des RendezVous</h1>
    
    <?php : ?>
        <table>
            <thead>
                <tr>
                    <?php foreach(($RendzVous) as $rendezVous): ?>
                        <th><?= htmlspecialchars($rendezVous) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
      </table>

</body>