<?php
include_once VIEWS_PATH . '/Components/Header.php';
?>

<h1>Accounts</h1>

<a href="<?= makeUrl('register') ?>" class="btn btn-primary">Create New Account</a>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($accounts)): ?>
        <tr>
            <td colspan="5">No accounts found</td>
        </tr>
    <?php else: ?>
        <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?= htmlspecialchars((string)$account->getId()) ?></td>
                <td><?= htmlspecialchars($account->getUsername()) ?></td>
                <td><?= htmlspecialchars($account->getEmail()) ?></td>
                <td><?= htmlspecialchars($account->getCreatedAt()) ?></td>
                <td>
                    <a href="<?= makeUrl("account/{$account->getId()}") ?>">detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>
