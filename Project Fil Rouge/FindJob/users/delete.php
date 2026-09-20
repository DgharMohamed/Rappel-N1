<?php
require_once __DIR__ . '/../config/database.php';

$id_user = isset($_GET['id_user']) ? (int)$_GET['id_user'] : 0;

if ($id_user <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id_user = :id");
$stmt->execute([':id' => $id_user]);

header('Location: index.php');
exit;
