export function renderExerciceCard(exercice) {
    return `
        <div class="col-sm-6 col-md-4 mb-4">
            <div class="card text-center exercice-card h-100 shadow-sm p-2">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold text-white mb-1">${exercice.title}</h5>
                    <p class="mb-3" style="color: #aaa;">
                        by <span class="text-info">${exercice.creatorUsername}</span> 
                        <span class="mx-1">•</span> ${exercice.createdAt.split(' ')[0]}
                    </p>
                    <div class="mb-3">
                        ${exercice.bodyParts.map(bp => `
                            <span class="badge badge-pill border px-2 py-1 mx-1 my-1" >
                                ${bp}
                            </span>
                        `).join("")}
                    </div>
                    <p class="card-text flex-grow-1" style="color: #ccc;">
                        ${exercice.description}
                    </p>
                    ${((typeof currentUserId !== 'undefined' && currentUserId !== null && String(exercice.creatorId) === String(currentUserId)) || (typeof isAdmin !== 'undefined' && isAdmin)) ? `
                    <div class="mt-auto pt-3 border-top" style="border-color: #333 !important;">
                        <button class="btn btn-sm btn-outline-warning mr-2 btn-edit" id="edit-exercice-btn"
                                data-id="${exercice.id}" data-toggle="modal" data-target="#addExerciceModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${exercice.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    ` : ''}
                </div>
            </div>
        </div>`;
}