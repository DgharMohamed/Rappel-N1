<?php
$page_title = 'Ajouter une offre';
$current_page = 'add-offre';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $salaire = $_POST['salaire'] !== '' ? (float)$_POST['salaire'] : null;
    $type_contrat = $_POST['type_contrat'] ?? '';
    $localisation = trim($_POST['localisation'] ?? '');
    $date_publication = $_POST['date_publication'] !== '' ? $_POST['date_publication'] : null;
    $date_expiration = $_POST['date_expiration'] !== '' ? $_POST['date_expiration'] : null;
    $statut_offre = $_POST['statut_offre'] ?? 'Publiée';

    if ($titre === '') $errors[] = 'Le titre est obligatoire.';
    if ($description === '') $errors[] = 'La description est obligatoire.';
    if (!in_array($type_contrat, ['CDI', 'Anapec', 'CDD'])) $errors[] = 'Type de contrat invalide.';
    if ($localisation === '') $errors[] = 'La localisation est obligatoire.';
    if (!in_array($statut_offre, ['Brouillon', 'Publiée', 'Fermée'])) $errors[] = 'Statut invalide.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO offres (id_user, titre, description, salaire, type_contrat, localisation, date_publication, date_expiration, statut_offre)
            VALUES (1, :titre, :description, :salaire, :type_contrat, :localisation, :date_publication, :date_expiration, :statut_offre)
        ");
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':salaire' => $salaire,
            ':type_contrat' => $type_contrat,
            ':localisation' => $localisation,
            ':date_publication' => $date_publication,
            ':date_expiration' => $date_expiration,
            ':statut_offre' => $statut_offre
        ]);
        header('Location: index.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Ajouter une offre</h1>
    </header>

    <div class="page-content">
        <div class="form-card">
            <h2>Nouvelle offre d'emploi</h2>

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
                    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($titre ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="salaire">Salaire (DH)</label>
                        <input type="number" id="salaire" name="salaire" step="0.01" min="0" value="<?php echo htmlspecialchars($salaire ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="type_contrat">Type de contrat</label>
                        <select id="type_contrat" name="type_contrat" required>
                            <option value="CDI" <?php echo ($type_contrat ?? '') === 'CDI' ? 'selected' : ''; ?>>CDI</option>
                            <option value="Anapec" <?php echo ($type_contrat ?? '') === 'Anapec' ? 'selected' : ''; ?>>Anapec</option>
                            <option value="CDD" <?php echo ($type_contrat ?? '') === 'CDD' ? 'selected' : ''; ?>>CDD</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <input type="text" id="localisation" name="localisation" value="<?php echo htmlspecialchars($localisation ?? ''); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_publication">Date de publication</label>
                        <input type="datetime-local" id="date_publication" name="date_publication" value="<?php echo htmlspecialchars($date_publication ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_expiration">Date d'expiration</label>
                        <input type="datetime-local" id="date_expiration" name="date_expiration" value="<?php echo htmlspecialchars($date_expiration ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="statut_offre">Statut</label>
                    <select id="statut_offre" name="statut_offre">
                        <option value="Publiée" <?php echo ($statut_offre ?? 'Publiée') === 'Publiée' ? 'selected' : ''; ?>>Publiée</option>
                        <option value="Brouillon" <?php echo ($statut_offre ?? '') === 'Brouillon' ? 'selected' : ''; ?>>Brouillon</option>
                        <option value="Fermée" <?php echo ($statut_offre ?? '') === 'Fermée' ? 'selected' : ''; ?>>Fermée</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Creer l'offre</button>
                    <a href="index.php" class="btn btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
