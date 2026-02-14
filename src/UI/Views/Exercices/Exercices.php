<div class="content-wrapper">
    <?php
    include_once VIEWS_PATH . '/Components/Header.php';

    if (empty($_SESSION['username'])) {
        header('Location: ' . makeUrl('login'));
        return;
    }

    ?>
    <!--    source: https://getbootstrap.com/docs/4.0/components/navbar/-->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <h1 class="navbar-brand">Exercices</h1>
            <div class="d-flex">
                <form class="d-flex mr-2">
                    <input class="form-control mr-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <button type="button" class="btn btn-primary ml-3 btn-square" data-toggle="modal"
                        data-target="#addExerciceModal" title="Add Exercice">
                    <i class="fas fa-plus"></i>
                </button>

                <!-- modal -->
                <?php include_once VIEWS_PATH . '/Components/addExerciceModal.php'; ?>
            </div>
        </div>
    </nav>
    <div id="exercicesList"></div>

    <?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>

</div>

<script>
    // Inject the session ID into a global JS variable
    const currentUserId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
    const isAdmin = <?= json_encode($_SESSION['is_admin'] ?? null) ?>;
</script>
<script type="module" src="<?= makeUrl('public/js/exercices.js') ?>"></script>
