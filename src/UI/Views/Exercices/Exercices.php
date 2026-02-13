<div class="content-wrapper">
    <?php
    include_once VIEWS_PATH . '/Components/Header.php';

    if (empty($_SESSION['username'])) {
        header('Location: ' . makeUrl('login'));
        return;
    }

    ?>
    <!--    source: https://getbootstrap.com/docs/5.0/components/navbar/-->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <h1 class="navbar-brand">Exercices</h1>
            <div class="d-flex">
                <form class="d-flex mr-2">
                    <input class="form-control mr-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <button type="button" class="btn btn-primary ml-3 btn-square" data-bs-toggle="modal"
                        data-bs-target="#addExerciceModal" title="Add Exercice">
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
    async function loadExercices() {
        const url = '<?= makeUrl('api/exercices'); ?>'

        try {
            const response = await fetch(url);
            console.log("Response: " + response.status);
            if (!response.ok) {
                throw new Error(`Http Error retrieving Exercices, Status: ${response.status}`);
            }
            const data = await response.json();
            console.log(data);
            const exercicesList = document.getElementById('exercicesList');
            if (!exercicesList) {
                throw new Error("Could not find exercice list container")
            }

            if (data.length === 0) {
                //display empty error message
                exercicesList.innerHTML = `
                    <div class="alert alert-info" role="alert">
                        There are no exercices added to the system. Try adding one !
                    </div>
                `
            } else {
                // card reference: https://getbootstrap.com/docs/5.0/components/card/
                exercicesList.innerHTML = data.map(exercice => `
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${exercice.title}</h5>
                            <div class="mb-2">
                                ${exercice.bodyParts.map(bp => `<span class="mx-1 p-2 badge badge-pill badge-dark">${bp}</span>`).join("")}
                            </div>

                            <p class="card-text">${exercice.description}</p>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                `).join("");
            }
        } catch (e) {
            console.error("Failed to load Exercices:", e);
        }

    }

    // on page load or on button click ? TODO
    document.addEventListener('DOMContentLoaded', loadExercices);
</script>
