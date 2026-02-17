export function renderExerciceCard(exercice) {
    // card reference: https://getbootstrap.com/docs/4.0/components/card/
    return `
        <div class="col-sm-6 col-md-4 mb-4">
            <div class="card text-center exercice-card h-100" data-id="${exercice.id}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">${exercice.title}</h5>
                    <div class="mb-2">
                        ${exercice.bodyParts.map(bp => `<span class="mx-1 p-2 badge badge-pill badge-dark">${bp}</span>`).join("")}
                    </div>

                    <p class="card-text flex-grow-1">${exercice.description}</p>
                    <div class="mt-2">
                            <button 
                                class="btn btn-warning btn-edit mr-2" 
                                data-id="${exercice.id}" 
                                data-toggle="modal" 
                                data-target="#addExerciceModal">
                                Edit
                            </button>
                            <button id="btn-delete-exercice" class="btn btn-danger btn-delete" data-id="${exercice.id}">Delete</button>
                    </div>
                </div>
            </div>
        </div>`;
}