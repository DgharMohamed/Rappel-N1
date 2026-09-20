<?php
$page_title = 'Offres d\'emploi';
$current_page = 'offres';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$offres = $pdo->query("SELECT o.*, u.nom, u.prenom FROM offres o LEFT JOIN users u ON o.id_user = u.id_user ORDER BY o.id_offre DESC")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Offres d'emploi</h1>
        <div class="header-right">
            <a href="create.php" class="btn btn-primary btn-sm">+ Ajouter une offre</a>
        </div>
    </header>

    <div class="page-content">
        <div class="content-card">
            <div class="content-card-header">
                <h2>Liste des offres (<?php echo count($offres); ?>)</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Salaire</th>
                            <th>Localisation</th>
                            <th>Publication</th>
                            <th>Expiration</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($offres) > 0): ?>
                        <?php foreach ($offres as $offre): ?>
                        <tr>
                            <td><?php echo $offre['id_offre']; ?></td>
                            <td><?php echo htmlspecialchars($offre['titre']); ?></td>
                            <td><span class="badge badge-<?php echo strtolower($offre['type_contrat']); ?>"><?php echo $offre['type_contrat']; ?></span></td>
                            <td><?php echo $offre['salaire'] ? number_format($offre['salaire'], 2, ',', ' ') . ' DH' : '-'; ?></td>
                            <td><?php echo htmlspecialchars($offre['localisation']); ?></td>
                            <td><?php echo $offre['date_publication'] ? date('d/m/Y', strtotime($offre['date_publication'])) : '-'; ?></td>
                            <td><?php echo $offre['date_expiration'] ? date('d/m/Y', strtotime($offre['date_expiration'])) : '-'; ?></td>
                            <td>
                                <span class="badge badge-<?php echo strtolower($offre['statut_offre']); ?>">
                                    <?php echo $offre['statut_offre']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="edit.php?id_offre=<?php echo $offre['id_offre']; ?>" class="btn btn-edit btn-sm">Modifier</a>
                                    <a href="delete.php?id_offre=<?php echo $offre['id_offre']; ?>" class="btn btn-delete btn-sm confirm-delete">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="icon">&#9998;</div>
                                    <p>Aucune offre trouvee.</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
