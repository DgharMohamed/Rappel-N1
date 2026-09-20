<?php
$page_title = 'Offres d\'emploi';
$base = '.';

require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query("SELECT titre, description, salaire, type_contrat, localisation, date_publication
	FROM offres
	WHERE statut_offre IN ('Publiee', 'Publiée')
	  AND (date_publication IS NULL OR date_publication <= NOW())
	  AND (date_expiration IS NULL OR date_expiration >= NOW())
	ORDER BY COALESCE(date_publication, date_creation) DESC, id_offre DESC");
$offres = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<div class="public-page">
	<header class="public-header">
		<a href="index.php" class="public-logo">Find<span>Job</span></a>
		<a href="login.php" class="btn btn-primary btn-sm">Espace administration</a>
	</header>

	<main class="public-main">
		<section class="public-intro">
			<p class="public-kicker">Les opportunités du moment</p>
			<h1>Trouvez votre prochain emploi</h1>
			<p>Découvrez les offres publiées par les entreprises et trouvez le poste qui vous correspond.</p>
		</section>

		<section class="public-offers" aria-labelledby="offers-title">
			<div class="public-section-heading">
				<h2 id="offers-title">Offres disponibles</h2>
				<span><?php echo count($offres); ?> offre<?php echo count($offres) === 1 ? '' : 's'; ?></span>
			</div>

			<?php if (empty($offres)): ?>
				<div class="public-empty">
					<h3>Aucune offre disponible</h3>
					<p>De nouvelles opportunités seront bientôt publiées.</p>
				</div>
			<?php else: ?>
				<div class="offer-grid">
					<?php foreach ($offres as $offre): ?>
						<article class="offer-card">
							<div class="offer-card-top">
								<span class="badge badge-<?php echo strtolower($offre['type_contrat']); ?>"><?php echo htmlspecialchars($offre['type_contrat']); ?></span>
								<?php if ($offre['date_publication']): ?>
									<time datetime="<?php echo htmlspecialchars($offre['date_publication']); ?>"><?php echo date('d/m/Y', strtotime($offre['date_publication'])); ?></time>
								<?php endif; ?>
							</div>
							<h3><?php echo htmlspecialchars($offre['titre']); ?></h3>
							<p class="offer-description"><?php echo htmlspecialchars($offre['description']); ?></p>
							<div class="offer-details">
								<span>&#128205; <?php echo htmlspecialchars($offre['localisation']); ?></span>
								<span><?php echo $offre['salaire'] !== null ? number_format($offre['salaire'], 2, ',', ' ') . ' DH' : 'Salaire à négocier'; ?></span>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</section>
	</main>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
