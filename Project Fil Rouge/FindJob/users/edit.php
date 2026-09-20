<?php
$page_title = 'Modifier un utilisateur';
$current_page = 'users';
$base = '..';

require_once __DIR__ . '/../config/database.php';

$id_user = isset($_GET['id_user']) ? (int)$_GET['id_user'] : 0;

if ($id_user <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
$stmt->execute([':id' => $id_user]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: index.php');
    exit;
}

$errors = [];

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
        $stmt = $pdo->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, role = :role WHERE id_user = :id");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id_user
        ]);
        header('Location: index.php');
        exit;
    }

    $user['nom'] = $nom;
    $user['prenom'] = $prenom;
    $user['email'] = $email;
    $user['role'] = $role;
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-header">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <h1>Modifier l'utilisateur</h1>
    </header>

    <div class="page-content">
        <div class="form-card">
            <h2>Modifier #<?php echo $user['id_user']; ?> - <?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?></h2>

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
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
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
