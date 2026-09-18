<?php 
require_once 'db.php';
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titre = $_POST['titre'] ?? '';
    $localisation = $_POST['localisation'] ?? '';
    $description = $_POST['description'] ?? '';
    $status = $_POST['status'] ?? '' ; 
    $date_expiration = !empty($_POST['date_expiration']) ? $_POST['date_expiration'] : null;
    $salaire = !empty($_POST['salaire']) ? $_POST['salaire'] : null;
    $contrat = $_POST['contrat'] ?? '';

    if(!empty($titre) && !empty($description) && !empty($contrat) && !empty($localisation)){
        try{
            $stmt = $pdo->prepare("INSERT INTO offres (titre, description, salaire, type_contrat, localisation, statut_offre, date_expiration) values(?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                    $titre,
                    $description,
                    $salaire,
                    $contrat,
                    $localisation,
                    $status,
                    $date_expiration
            ]);
            $message = "offre ajouter avec succé";
        }catch(PDOException $e){
            $message = "ERROR : " .$e->getMessage();
        }
    }else{
        $message = "les champs est obligatoire ";
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

    <h1>Create Offres : </h1>
    <?php if($message): ?>
        <p><?= htmlspecialchars($message)?></p>
    <?php endif?>
    <form method="POST">
        <label for="titre">Titre de offre : </label>
        <input type="text" name="titre" id="titre" required>
        <br><br>
        <label for="localisation">Localisation : </label>
        <input type="text" name="localisation" id="localisation">
        <br><br>
        <label for="salaire">Salaire : </label>
        <input type="number" name="salaire" >
        <br><br>
        <label for="status">Status : </label>
        <select name="status" id="Status">
            <option value="Publiée">Publiée</option>
            <option value="Brouillon">Brouillon</option>
            <option value="Fermé">Fermé</option>
        </select>

        <br><br>
        <label for="contrat">Type De Contrat : </label>
        <select name="contrat" id="contrat">
            <option value="CDI">CDI</option>
            <option value="CDD">CDD</option>
            <option value="ANAPEC">ANAPEC</option>
        </select>

        <br><br>
        <label for="date_expiration">Date de L'expiration : </label>
        <input type="date" name="date_expiration">
        <br><br>
        <label for="description">Descrition : </label>
        <textarea name="description" id="description"></textarea>
        <button type="submit">Ajouter l'offre</button>
    </form>
    <a href="liste_offre.php">Show All Offres </a>
</body>
</html>