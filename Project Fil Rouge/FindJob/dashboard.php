<?php
$page_title = 'Dashboard';
$current_page = 'dashboard';
$base = '.';

require_once __DIR__ . '/config/database.php';

$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_offres = $pdo->query("SELECT COUNT(*) FROM offres")->fetchColumn();
$publiees = $pdo->query("SELECT COUNT(*) FROM offres WHERE statut_offre = 'Publiée'")->fetchColumn();
$brouillons = $pdo->query("SELECT COUNT(*) FROM offres WHERE statut_offre = 'Brouillon'")->fetchColumn();
$fermees = $pdo->query("SELECT COUNT(*) FROM offres WHERE statut_offre = 'Fermée'")->fetchColumn();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Dashboard</h1>
        <div class="header-right">
            <span class="admin-name">Admin FindJob</span>
        </div>
    </header>

    <div class="page-content">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">&#9787;</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $total_users; ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon navy">&#9998;</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $total_offres; ?></div>
                    <div class="stat-label">Total Offres</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">&#10003;</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $publiees; ?></div>
                    <div class="stat-label">Publiees</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">&#9998;</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $brouillons; ?></div>
                    <div class="stat-label">Brouillons</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">&#10007;</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $fermees; ?></div>
                    <div class="stat-label">Fermees</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="content-card-header">
                <h2>Offres recentes</h2>
                <a href="offres/create.php" class="btn btn-primary btn-sm">+ Ajouter une offre</a>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Localisation</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM offres ORDER BY date_creation DESC LIMIT 5");
                        $offres = $stmt->fetchAll();
                        if (count($offres) > 0):
                            foreach ($offres as $offre):
                                $badge_class = 'badge-publiee';
                                if ($offre['statut_offre'] === 'Brouillon') $badge_class = 'badge-brouillon';
                                if ($offre['statut_offre'] === 'Fermee') $badge_class = 'badge-fermee';
                        ?>
                        <tr>
                            <td><?php echo $offre['id_offre']; ?></td>
                            <td><?php echo htmlspecialchars($offre['titre']); ?></td>
                            <td><span class="badge badge-<?php echo strtolower($offre['type_contrat']); ?>"><?php echo $offre['type_contrat']; ?></span></td>
                            <td><?php echo htmlspecialchars($offre['localisation']); ?></td>
                            <td><span class="badge <?php echo $badge_class; ?>"><?php echo $offre['statut_offre']; ?></span></td>
                        </tr>
                        <?php
                            endforeach;
                        else:
                        ?>
                        <tr>
                            <td colspan="5" class="empty-state"><p>Aucune offre pour le moment.</p></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
