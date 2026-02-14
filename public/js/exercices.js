// TODO changer ce path lors du deploiement sur le diro
const baseUrl = '/IFT3225-tp1'

import {renderExerciceCard} from './components/exerciceCard.js'

let exercices = [];

async function loadExercices() {
    const url = `${baseUrl}/api/exercices`
    try {
        const response = await fetch(url);
        const data = await response.json();
        exercices = data;
        const exercicesList = document.getElementById('exercicesList');

        if (data.length === 0) {
            //display empty error message
            exercicesList.innerHTML = `
                <div class="alert alert-info" role="alert">
                    There are no exercices added to the system. Try adding one !
                </div>`;
        } else {
            exercicesList.innerHTML = data.map(renderExerciceCard).join("");
        }
    } catch (e) {
        console.error("Failed to load Exercices:", e);
    }
}

//EventListeners:
// on page load or on button click ? TODO
document.addEventListener('DOMContentLoaded', loadExercices);
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
            console.error("Update failed".e);
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