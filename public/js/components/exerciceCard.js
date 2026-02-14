export function renderExerciceCard(exercice) {
    // card reference: https://getbootstrap.com/docs/4.0/components/card/
    const isOwner = String(exercice.creatorId) === String(currentUserId);

    return `
        <div class="card text-center exercice-card mb-3" style="width: 18rem;" data-id="${exercice.id}">
            <div class="card-body">
                <h5 class="card-title">${exercice.title}</h5>
                <div class="mb-2">
                    ${exercice.bodyParts.map(bp => `<span class="mx-1 p-2 badge badge-pill badge-dark">${bp}</span>`).join("")}
                </div>

                <p class="card-text">${exercice.description}</p>
                ${isOwner || isAdmin ? `
                    <button 
                        class="btn btn-warning btn-edit" 
                        data-id="${exercice.id}" 
                        data-toggle="modal" 
                        data-target="#addExerciceModal">
                        Edit
                    </button>
                    <button id="btn-delete-exercice" class="btn btn-danger btn-delete" data-id="${exercice.id}">Delete</button>
                ` : ``}
            </div>
        </div>`;
}