<?php
// Connexion à la base de données MySQL 
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

// Requête SQL pour sélectionner toutes les lignes de la table "professeur" dans la base de données, triées par début d'absence
$absences = $bdd->query('SELECT * FROM professeur ORDER BY debut_absence');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Liste des absences</title>
    <link rel="stylesheet" type="text/css" href="CSS/validation_absences.css">
  </head>
  <body>
    <div class="button-container">
      <a href="absences.php" class="absences-button">Aller à Absences</a>
    </div>
    <form action="delete_absences.php" method="post">
      <table>
        <caption>Liste des absences des professeurs</caption>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th><input type="submit" value="Supprimer"></th>
          </tr>
        </thead>
        <?php
        if($absences->rowCount() > 0){ // Vérifie si le nombre de lignes dans $absences est supérieur à 0
          while ($absence = $absences->fetch()) { // Boucle while pour parcourir chaque ligne dans $absences
            ?>
            <tr> 
              <td><?php echo $absence['nom_professeur'];?></td> <!-- contenu de la colonne 'nom_professeur' -->
              <td><?php echo $absence['prenom_professeur'];?></td> <!-- contenu de la colonne 'prenom_professeur' -->
              <td><?php echo date("d/m/Y H:i", strtotime($absence['debut_absence']));?></td> <!-- contenu de la colonne 'debut_absence' -->
              <td><?php echo date("d/m/Y H:i", strtotime($absence['fin_absence']));?></td> <!-- le contenu de la colonne 'fin_absence' -->
              <td><input type="checkbox" name="delete[]" value="<?php echo $absence['id'];?>"></td> <!-- case à cocher avec l'ID de l'absence -->
            </tr> 
      <?php
      }
      ?>
      
      <?php
    }else{ // Si le nombre de lignes dans $absences est égal à 0
      ?>
      <tr>
        <td colspan="6">
          <p>Aucune absence enregistrée</p>
        </td>
      </tr>
      <?php
    }
    ?>
    </table>
    </form>
  </body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  
