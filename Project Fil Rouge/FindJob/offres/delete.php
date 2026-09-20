<?php
require_once __DIR__ . '/../config/database.php';

$id_offre = isset($_GET['id_offre']) ? (int)$_GET['id_offre'] : 0;

if ($id_offre <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM offres WHERE id_offre = :id");
$stmt->execute([':id' => $id_offre]);

header('Location: index.php');
exit;
