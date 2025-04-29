<?php



?>


<body>



        <h1>Dates de rendez-vous</h1>

    <table>


        <thead>

            <tr>
                <th>

                    Dates enregistrées

                </th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($rendezVous as $unRendezVous): ?>
                <tr>
                    <td><?= htmlspecialchars($unRendezVous['dateRdv']); ?> à
                        <?= htmlspecialchars($unRendezVous['heureRdv']); ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    

    <div>

        <label for="choix">Choisissez une option :</label>
        <select id="choix" name="choix">
        <?php foreach ($prestations as $unePrestation): ?>
    
            <option value="option1">Consultation</option>
        <?php endforeach;?>
          
        </select>


    </div>



    <div>

        <button> Ajouter</button>
        <button> Modifier</button>
        <button> Supprimer</button>
        <button> Supprimer</button>

    </div>
</body>