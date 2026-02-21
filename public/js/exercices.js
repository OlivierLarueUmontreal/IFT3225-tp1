import {renderExerciceCard} from './components/exerciceCard.js'

let exercices = [];
let cardsPerPage = 6;
let activeBodyFilters = [];

async function loadExercices() {
    const url = `${baseUrl}/api/exercices`
    try {
        const response = await fetch(url);
        const raw = await response.text();
        const data = JSON.parse(raw);
        exercices = data.reverse();
        const exercicesList = document.getElementById('exercicesList');

        if (data.length === 0) {
            exercicesList.innerHTML = `
                <div class="d-flex justify-content-center align-items-center" style="min-height:200px;">
                    <p class="text-muted mb-0">No exercices added yet. Try adding one.</p>
                </div>`;
        } else {
            renderExercices(exercices, 1)
        }
    } catch (e) {
        console.error("Failed to load Exercices:", e);
    }
    
}

function renderExercices(exercicesToRender, pageNum){
    const exercicesList = document.getElementById('exercicesList');
    let startNum = (pageNum - 1) * cardsPerPage
    let pagedExercices = exercicesToRender.slice(startNum, startNum + cardsPerPage)
    exercicesList.innerHTML = pagedExercices.map(renderExerciceCard).join("");
    renderPagination(exercicesToRender, pageNum)

}

function renderPagination(exercicesToRender, pageNum){
    let n = Math.ceil(exercicesToRender.length /cardsPerPage);
    const exercicesPagination = document.getElementById("exercicesPagination");
    exercicesPagination.innerHTML = `
        <li class="page-item ${(pageNum == 1) ? "disabled" : ""}" id="exPagePrev">
            <a class="page-link" href="#" aria-label="Previous" tabindex="-1"><span aria-hidden="true">&laquo;</span></a>
        </li>
    `
    for(let i = 1; i<=n; i++){
        exercicesPagination.innerHTML += `
            <li class="page-item page-item-num ${(i == pageNum) ? "active" : ""}"><a class="page-link" href="#">${i}</a></li>
        `
    }
    exercicesPagination.innerHTML += `
        <li class="page-item ${(pageNum == n) ? "disabled" : ""}" id="exPageNext">
            <a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
        </li>
    `
    let pageItem = document.querySelectorAll('.page-item-num');
    pageItem.forEach(
        item => {
            item.addEventListener('click', () => {
                let i = parseInt(item.querySelector('a.page-link').textContent.trim());
                renderExercices(exercicesToRender, i);
            })
        }
    )

    document.getElementById("exPagePrev").addEventListener('click', () => {
        if(pageNum > 1){
            renderExercices(exercicesToRender, pageNum -1);
        }
    })
    document.getElementById("exPageNext").addEventListener('click', () => {
        if(pageNum < n){
            renderExercices(exercicesToRender, pageNum +1);
        }
    })
}

//EventListeners:
document.addEventListener('DOMContentLoaded', () => {
    loadExercices();
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('exerciceForm');

    form.addEventListener('submit', async function (event) {
        const checkboxes = form.querySelectorAll('input[name="bodyParts[]"]');
        const isChecked = Array.from(checkboxes).some(cb => cb.checked);
        const errorMsg = document.getElementById('muscle-error-msg');

        if (!isChecked) {
            event.preventDefault();
            errorMsg.style.display = 'block';
            return;
        }

        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }
        event.preventDefault();
        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                // close the modal
                $('#addExerciceModal').modal('hide');

                //refresh the list
                await loadExercices();
            } else {
                const err = await response.json();
                alert("Error: " + err.error);
            }
        } catch (e) {
            console.error("Update failed", e);
        }

    });
    
});

// Edit Button modal
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.btn-edit');
    if (!editBtn) return;

    const id = editBtn.dataset.id;
    const exercice = exercices.find(x => String(x.id) === String(id));
    if (!exercice) return;

    document.getElementById('titleInput').value = exercice.title;
    document.getElementById('descriptionTextarea').value = exercice.description;
    document.getElementById('exerciceIdInput').value = exercice.id;
    document.getElementById('creatorIdInput').value = exercice.creatorId;

    const checkboxes = document.querySelectorAll('input[name="bodyParts[]"]');
    checkboxes.forEach(cb => {
        cb.checked = exercice.bodyParts.includes(cb.value);
        cb.parentElement.classList.toggle('active', cb.checked);
    });

    const form = document.getElementById('exerciceForm');
    form.action = `${baseUrl}/exercice/update/${id}`;

    document.getElementById('addExerciceModalLabel').innerText = 'Edit exercice';
});

// reset modal to add modal
$('#addExerciceModal').on('show.bs.modal', function (e) {
    if (e.relatedTarget && e.relatedTarget.classList.contains('btn-edit')) return;

    const form = document.getElementById('exerciceForm');
    form.reset();
    form.action = `${baseUrl}/exercice/add`;

    document.getElementById('addExerciceModalLabel').innerText = 'Add an exercice';

    document.querySelectorAll('input[name="bodyParts[]"]').forEach(cb => {
        cb.parentElement.classList.remove('active');
    });
});


//Delete button
document.addEventListener('click', async function (e) {
    const deleteBtn = e.target.closest('.btn-delete');
    if (!deleteBtn) return;

    const id = deleteBtn.dataset.id;
    const exercice = exercices.find(x => String(x.id) === String(id));
    if (!exercice) return;

    if (!confirm("Are you sure you want to delete this exercise?")) return;

    try {
        const response = await fetch(`${baseUrl}/exercice/delete/${id}`, {method: 'DELETE'});
        if (response.ok) {
            await loadExercices();
        } else {
            const err = await response.json();
            alert("Error: " + err.error)
        }
    } catch (e) {
        console.log(e);
    }

});

const searchInput = document.getElementById('searchInput');
const searchButton = document.getElementById('searchButton');

searchButton.addEventListener('click', function () {

    // If exercices not loaded yet, load then apply filter
    if (!exercices || exercices.length === 0) {
        loadExercices().then(() => applyFilter(q));
        return;
    }
    applyFilter();
    }
);

document.getElementById('clearSearchButton').addEventListener('click', () => {
    renderExercices(exercices, 1);
    searchInput.value = "";
})

function applyFilter() {
    const exercicesList = document.getElementById('exercicesList');
    const inputValue = searchInput.value.trim().toLowerCase();

    let filtered = exercices.filter(ex => {
        const title = (ex.title || '').toLowerCase();
        const desc = (ex.description || '').toLowerCase();
        const body = (ex.bodyParts || []).join(' ').toLowerCase();
        return title.includes(inputValue) || desc.includes(inputValue) || body.includes(inputValue);
    });

    if (activeBodyFilters && activeBodyFilters.length > 0) {
        filtered = filtered.filter(ex => {
            const parts = ex.bodyParts || [];
            return parts.some(p => activeBodyFilters.includes(p));
        });
    }

    if (filtered.length === 0) {
        exercicesList.innerHTML = `\
            <div class="d-flex justify-content-center align-items-center" style="min-height:200px;">\
                <p class="text-muted mb-0" style = "">No exercices found.</p>\
            </div>`;
    } else {
        renderExercices(filtered, 1);
    }
}


// Body filter buttons: collect selected values and emit an event for other code to handle
document.addEventListener('DOMContentLoaded', () => {
    const applyBtn = document.getElementById('applyBodyFilter');
    const clearBtn = document.getElementById('clearBodyFilter');

    function collectSelectedFilters() {
        const checked = document.querySelectorAll('#bodyFilterForm input[name="filterBodyParts[]"]:checked');
        return Array.from(checked).map(cb => cb.value);
    }

    if (applyBtn) {
        applyBtn.addEventListener('click', (ev) => {
            ev.preventDefault();
            activeBodyFilters = collectSelectedFilters();
            // notify listeners — user code can listen for this event
            document.dispatchEvent(new CustomEvent('bodyFiltersChanged'));
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', (ev) => {
            ev.preventDefault();
            const boxes = document.querySelectorAll('#bodyFilterForm input[name="filterBodyParts[]"]');
            boxes.forEach(cb => cb.checked = false);
            activeBodyFilters = [];
            document.dispatchEvent(new CustomEvent('bodyFiltersChanged'));
        });
    }
});

document.addEventListener('bodyFiltersChanged', () => {
    applyFilter();
})
