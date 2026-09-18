<?php
require_once  'db.php';
$stmt =  $pdo->query("SELECT * FROM offres ORDER BY date_creation DESC");
$rows = $stmt->fetchAll();
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
    <h1>All Offres</h1>
    <a href="create_offre.php">Create new offre </a>
    <div class = "container">
        <?php foreach($rows as $r): ?>
            <div class="offre">
                <h2><?=htmlspecialchars($r['titre'])?></h2>
                <span><?= htmlspecialchars($r['type_contrat'])?></span>
                <p><?= htmlspecialchars($r['description'])?></p>
                <div class="offre-container">
                    <?php if($r['salaire']):?>
                        <span><?=htmlspecialchars($r['salaire'])?></span>
                    <?php endif;?>
                    <span><?=htmlspecialchars($r['date_expiration'])?></span>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</body>
</html>