<?php
require_once "db.php";
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titre = $_POST['titre'] ?? '';
    $localisation = $_POST['localisation'] ?? '';
    $salaire = !empty($_POST['salaire']) ? $_POST['salaire'] : null;
    $status = $_POST['status']?? '';
    $contrat = $_POST['contrat']?? '';
    $date_expiration = !empty($_POST['date_expiration']) ? $_POST['date_expiration'] :  null;
    $description = $_POST['description']?? '';


    if(!empty($titre) && !empty($description) && !empty($contrat) && !empty($localisation)){
        try{
            $stmt = $pdo->prepare("INSERT INTO offres (titre, description, salaire, type_contrat, localisation, statut_offre, date_expiration) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(
                [
                    $titre,
                    $description,
                    $salaire,
                    $contrat,
                    $localisation,
                    $status,
                    $date_expiration
                ]
            );
            $message  = "offre ajoutée avec succés";
        }catch(PDOException $e){
            $message = "ERROR : " . $e->getMessage();
        }
    }else{
        $message = "Les Champs est Obligatoire";
    }

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Créer une offre</h1>
    <?php if($message): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>
    <a href="liste_offre.php">Voir les offres</a>
    <br><br>
    <form method="post">
        <label for="titre"> titre : </label>
        <input type="text" name="titre" id="titre" required>
        <br><br>

        <label for="localisation"> Localisation : </label>
        <input type="text" name="localisation" id="localisation" required>
        <br><br>

        <label for="salaire"> Salaire : </label>
        <input type="number" name="salaire" id="salaire" step="0.01">
        <br><br>

        <label for="status"> Status : </label>
        <select name="status" id="status" required>
            <option value="Publiée">Publiée</option>
            <option value="Brouillon">Brouillon</option>
            <option value="Fermée">Fermée</option>
        </select>
        <br><br>

        <label for="contrat"> Contrat : </label>
        <select name="contrat" id="contrat" required>
            <option value="CDI">CDI</option>
            <option value="CDD">CDD</option>
            <option value="Anapec">Anapec</option>
        </select>
        <br><br>

        <label for="date_expiration"> Date D'expiration : </label>
        <input type="date" name="date_expiration" id="date_expiration">
        <br><br>
        <label for="description">Description : </label>
        <textarea type="text" name="description" id="description" required></textarea>

        <br><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>