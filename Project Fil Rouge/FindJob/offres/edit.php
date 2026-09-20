<?php
$page_title = 'Modifier une offre';
$current_page = 'offres';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$id_offre = isset($_GET['id_offre']) ? (int)$_GET['id_offre'] : 0;

if ($id_offre <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM offres WHERE id_offre = :id");
$stmt->execute([':id' => $id_offre]);
$offre = $stmt->fetch();

if (!$offre) {
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $salaire = $_POST['salaire'] !== '' ? (float)$_POST['salaire'] : null;
    $type_contrat = $_POST['type_contrat'] ?? '';
    $localisation = trim($_POST['localisation'] ?? '');
    $date_publication = $_POST['date_publication'] !== '' ? $_POST['date_publication'] : null;
    $date_expiration = $_POST['date_expiration'] !== '' ? $_POST['date_expiration'] : null;
    $statut_offre = $_POST['statut_offre'] ?? 'Publiee';

    if ($titre === '') $errors[] = 'Le titre est obligatoire.';
    if ($description === '') $errors[] = 'La description est obligatoire.';
    if (!in_array($type_contrat, ['CDI', 'Anapec', 'CDD'])) $errors[] = 'Type de contrat invalide.';
    if ($localisation === '') $errors[] = 'La localisation est obligatoire.';
    if (!in_array($statut_offre, ['Brouillon', 'Publiee', 'Fermee'])) $errors[] = 'Statut invalide.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            UPDATE offres
            SET titre = :titre, description = :description, salaire = :salaire,
                type_contrat = :type_contrat, localisation = :localisation,
                date_publication = :date_publication, date_expiration = :date_expiration,
                statut_offre = :statut_offre
            WHERE id_offre = :id
        ");
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':salaire' => $salaire,
            ':type_contrat' => $type_contrat,
            ':localisation' => $localisation,
            ':date_publication' => $date_publication,
            ':date_expiration' => $date_expiration,
            ':statut_offre' => $statut_offre,
            ':id' => $id_offre
        ]);
        header('Location: index.php');
        exit;
    }

    $offre['titre'] = $titre;
    $offre['description'] = $description;
    $offre['salaire'] = $salaire;
    $offre['type_contrat'] = $type_contrat;
    $offre['localisation'] = $localisation;
    $offre['date_publication'] = $date_publication;
    $offre['date_expiration'] = $date_expiration;
    $offre['statut_offre'] = $statut_offre;
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Modifier l'offre</h1>
    </header>

    <div class="page-content">
        <div class="form-card">
            <h2>Modifier #<?php echo $offre['id_offre']; ?> - <?php echo htmlspecialchars($offre['titre']); ?></h2>

            <?php if (!empty($errors)): ?>
            <div style="background:#fee2e2;color:#dc2626;padding:12px 16px;border-radius:var(--radius);margin-bottom:20px;">
                <?php foreach ($errors as $err): ?>
                    <div><?php echo htmlspecialchars($err); ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($offre['titre']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($offre['description']); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="salaire">Salaire (DH)</label>
                        <input type="number" id="salaire" name="salaire" step="0.01" min="0" value="<?php echo htmlspecialchars($offre['salaire'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="type_contrat">Type de contrat</label>
                        <select id="type_contrat" name="type_contrat" required>
                            <option value="CDI" <?php echo $offre['type_contrat'] === 'CDI' ? 'selected' : ''; ?>>CDI</option>
                            <option value="Anapec" <?php echo $offre['type_contrat'] === 'Anapec' ? 'selected' : ''; ?>>Anapec</option>
                            <option value="CDD" <?php echo $offre['type_contrat'] === 'CDD' ? 'selected' : ''; ?>>CDD</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <input type="text" id="localisation" name="localisation" value="<?php echo htmlspecialchars($offre['localisation']); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_publication">Date de publication</label>
                        <input type="datetime-local" id="date_publication" name="date_publication" value="<?php echo htmlspecialchars($offre['date_publication'] ? date('Y-m-d\TH:i', strtotime($offre['date_publication'])) : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_expiration">Date d'expiration</label>
                        <input type="datetime-local" id="date_expiration" name="date_expiration" value="<?php echo htmlspecialchars($offre['date_expiration'] ? date('Y-m-d\TH:i', strtotime($offre['date_expiration'])) : ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="statut_offre">Statut</label>
                    <select id="statut_offre" name="statut_offre">
                        <option value="Publiee" <?php echo $offre['statut_offre'] === 'Publiee' ? 'selected' : ''; ?>>Publiee</option>
                        <option value="Brouillon" <?php echo $offre['statut_offre'] === 'Brouillon' ? 'selected' : ''; ?>>Brouillon</option>
                        <option value="Fermee" <?php echo $offre['statut_offre'] === 'Fermee' ? 'selected' : ''; ?>>Fermee</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="index.php" class="btn btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
