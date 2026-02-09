<?php include_once VIEWS_PATH . '/Components/Header.php'; ?>

<div class = "content-wrapper view-login">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Connexion</h3>
                    <form method="post" action="<?= makeUrl('login') ?>">
                        <?php if (function_exists('set_csrf')) { set_csrf(); } ?>
                        <div class="form-group">
                            <label for="identifier">Email or Username</label>
                            <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Email or username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="<?= makeUrl('register') ?>" class="btn btn-link">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>