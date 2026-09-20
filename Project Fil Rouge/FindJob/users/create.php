<?php
$page_title = 'Ajouter un utilisateur';
$current_page = 'add-user';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'user';

    if ($nom === '') $errors[] = 'Le nom est obligatoire.';
    if ($prenom === '') $errors[] = 'Le prenom est obligatoire.';
    if ($email === '') $errors[] = 'L\'email est obligatoire.';
    if (!in_array($role, ['admin', 'user'])) $errors[] = 'Role invalide.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, role) VALUES (:nom, :prenom, :email, :role)");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':role' => $role
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
        <h1>Ajouter un utilisateur</h1>
    </header>

    <div class="page-content">
        <div class="form-card">
            <h2>Nouvel utilisateur</h2>

            <?php if (!empty($errors)): ?>
            <div style="background:#fee2e2;color:#dc2626;padding:12px 16px;border-radius:var(--radius);margin-bottom:20px;">
                <?php foreach ($errors as $err): ?>
                    <div><?php echo htmlspecialchars($err); ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="user" <?php echo ($role ?? '') === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($role ?? '') === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Creer l'utilisateur</button>
                    <a href="index.php" class="btn btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
