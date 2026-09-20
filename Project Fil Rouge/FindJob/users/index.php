<?php
$page_title = 'Utilisateurs';
$current_page = 'users';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$users = $pdo->query("SELECT * FROM users ORDER BY id_user DESC")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Utilisateurs</h1>
        <div class="header-right">
            <a href="create.php" class="btn btn-primary btn-sm">+ Ajouter un utilisateur</a>
        </div>
    </header>

    <div class="page-content">
        <div class="content-card">
            <div class="content-card-header">
                <h2>Liste des utilisateurs (<?php echo count($users); ?>)</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id_user']; ?></td>
                            <td><?php echo htmlspecialchars($user['nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span class="badge badge-<?php echo $user['role']; ?>">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($user['date_creation'])); ?></td>
                            <td>
                                <div class="actions-cell">
                                    <a href="edit.php?id_user=<?php echo $user['id_user']; ?>" class="btn btn-edit btn-sm">Modifier</a>
                                    <a href="delete.php?id_user=<?php echo $user['id_user']; ?>" class="btn btn-delete btn-sm confirm-delete">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="icon">&#9787;</div>
                                    <p>Aucun utilisateur trouvé.</p>
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
