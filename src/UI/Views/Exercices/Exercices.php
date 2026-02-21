<?php
include_once VIEWS_PATH . '/Components/Header.php';

if (empty($_SESSION['username'])) {
    header('Location: ' . makeUrl('login'));
    return;
}

?>
<div class="content-wrapper">
    <!--    source: https://getbootstrap.com/docs/4.0/components/navbar/-->
    <nav class="navbar tool-navbar mb-5 pl-3 pr-3 pt-3 pb-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <h1 class="navbar-brand mb-0">Exercices</h1>
                <button type="button" class="btn btn-primary ml-3 btn-square" data-toggle="modal"
                    data-target="#addExerciceModal" title="Add Exercice">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="d-flex">
                <form id="searchForm" class="d-flex mr-2">
                    <input id="searchInput" class="form-control mr-1" type="search" placeholder="Search"
                        aria-label="Search">
                    <button id="searchButton" class="btn btn-outline-success" type="button" aria-label="Search"><i
                            class="fas fa-search"></i></button>

                </form>

                <!-- Body parts filter dropdown -->
                <div class="dropdown mr-2">
                    <button class="btn btn-outline-info dropdown-toggle" type="button" id="bodyFilterDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <div class="dropdown-menu p-3 exercices-filter-menu" style="min-width:220px;">
                        <form id="bodyFilterForm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Chest" id="filterChest"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterChest">Chest</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Back" id="filterBack"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterBack">Back</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Quadriceps" id="filterQuadriceps"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterQuadriceps">Quadriceps</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Hamstrings" id="filterHamstrings"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterHamstrings">Hamstrings</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Glutes" id="filterGlutes"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterGlutes">Glutes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Calves" id="filterCalves"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterCalves">Calves</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Shoulders" id="filterShoulders"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterShoulders">Shoulders</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Biceps" id="filterBiceps"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterBiceps">Biceps</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Triceps" id="filterTriceps"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterTriceps">Triceps</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Abdominal" id="filterAbdominal"
                                    name="filterBodyParts[]">
                                <label class="form-check-label" for="filterAbdominal">Abdominal</label>
                            </div>
                            <div class="mt-2 text-right">
                                <button type="button" id="clearBodyFilter" class="btn btn-sm btn-secondary ml-2">Clear
                                </button>
                                <button type="button" id="applyBodyFilter" class="btn btn-sm btn-primary">Apply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <button id="clearSearchButton" type="button" class="btn btn-outline-primary ml-2 btn-square"
                    aria-label="Clear search">
                    Reset
                </button>

                <?php include_once VIEWS_PATH . '/Components/addExerciceModal.php'; ?>
            </div>
        </div>
    </nav>
    <div id="exercicesList" class="row"></div>

    <!-- Pagination controls (JS will populate page items) -->
    <nav aria-label="Exercices pagination" class="mt-3">
        <ul class="pagination justify-content-center" id="exercicesPagination">
        </ul>
    </nav>


</div>

<script>
const currentUserId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
const isAdmin = <?= json_encode($_SESSION['is_admin'] ?? null) ?>;
const baseUrl = `<?= BASE_URL?>`;
</script>
<script type="module" src="<?= makeUrl('public/js/exercices.js') ?>"></script>
<?php include_once VIEWS_PATH . '/Components/Footer.php'; ?>