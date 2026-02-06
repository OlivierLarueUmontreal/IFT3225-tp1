<?php include_once VIEWS_PATH . '/Components/Header.php'; ?>

    <h1>Create new Account</h1>

    <form method="POST" action="<?= makeUrl('accounts') ?>" class="form">
        <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Account</button>
        <a href="/accounts" class="btn btn-secondary">Cancel</a>
    </form>

<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>