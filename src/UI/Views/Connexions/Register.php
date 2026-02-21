<?php include_once VIEWS_PATH . '/Components/Header.php'; ?>
    <div class="row justify-content-center align-items-center shadow-lg" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="font-weight-bold text-white">Create Account</h2>
                    </div>

                    <form method="POST" action="<?= makeUrl('accounts') ?>" class="form">
                        <div class="form-group mb-3">
                            <label for="username" class="text-light small font-weight-bold">USERNAME</label>
                            <input type="text" id="username" name="username" class="form-control dark-input"
                                   placeholder="Enter your name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="text-light small font-weight-bold">EMAIL ADDRESS</label>
                            <input type="email" id="email" name="email" class="form-control dark-input"
                                   placeholder="email@example.com" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="text-light small font-weight-bold">PASSWORD</label>
                            <input type="password" id="password" name="password" class="form-control dark-input"
                                   placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-sm font-weight-bold mb-3">
                            Create Account
                        </button>

                        <div class="text-center">
                            <a href="<?= makeUrl('login') ?>" class="btn btn-link btn-sm text-muted">
                                Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>