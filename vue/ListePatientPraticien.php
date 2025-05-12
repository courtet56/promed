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


                <?php foreach ($data as $unPatient): ?>
                    <tr>
                        <td><?= htmlspecialchars($unPatient['nomPatient']); ?></td>
                        <td><?= htmlspecialchars($unPatient['prenomPatient']); ?></td>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- JS Bootstrap -->


</body>