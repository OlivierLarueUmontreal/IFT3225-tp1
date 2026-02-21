<?php
include_once VIEWS_PATH . '/Components/Header.php';

// Expecting $myAccount to be provided by controller
?>

<div class="container mt-4">
    <h2>My Account</h2>
    <?php if (empty($myAccount)): ?>
    <div class="alert alert-warning">Account information not found.</div>
    <?php else: ?>
    <div class="card my-account-card" style="max-width:700px;">
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($myAccount->getUsername()) ?></h2>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($myAccount->getEmail()) ?></p>
            <p class="card-text"><strong>Created at:</strong> <?= htmlspecialchars($myAccount->getCreatedAt()) ?></p>
            <p class="card-text"><strong>Role:</strong> <?= $myAccount->isAdmin() ? 'Admin' : 'User' ?></p>

            <a href="<?= makeUrl('exercices') ?>" class="btn btn-secondary">Back to Exercices</a>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>