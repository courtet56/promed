<?php


?>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Patients</h2>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
            </tr>
        </thead>
        <tbody>
         
          
        <?php foreach ($patient as $unPatient): ?>
                <tr>
                    <td><?= htmlspecialchars($unPatient['nom']); ?></td> 
                    <td><?= htmlspecialchars($unPatient['prénom']);?></td>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- JS Bootstrap -->


</body>