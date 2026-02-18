<?php

?>
<!-- source: https://getbootstrap.com/docs/4.0/components/modal/-->
<div class="modal fade " id="addExerciceModal" tabindex="-1" role="dialog" aria-labelledby="addExerciceModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content dark-modal shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="addExerciceModalLabel">Add an exercice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form-->
                <form class="needs-validation" id="exerciceForm" method="POST" novalidate action="<?= makeUrl('exercice/add') ?>">
                    <div class="form-group">
                        <label for="titleInput">Title</label>
                        <input name="title" type="text" class="form-control dark-input" id="titleInput"
                               placeholder="ex: Chest Press" required>
                        <div class="invalid-feedback">Please choose a title.</div>
                    </div>
                    <div class="form-group">
                        <label for="descriptionTextarea">Description</label>
                        <textarea name="description" rows="3" class="form-control dark-input" id="descriptionTextarea" placeholder="Provide a description"
                                  required></textarea>
                        <div class="invalid-feedback">Please provide a description.</div>
                    </div>
                    <div class="form-group">
                        <label for="bodyPartsSelect">Body Parts</label>
                        <div class="btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Chest"> Chest
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Back"> Back
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Quadriceps"> Quadriceps
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Hamstrings"> Hamstrings
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Glutes"> Glutes
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Calves"> Calves
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Shoulders"> Shoulders
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Biceps"> Biceps
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Triceps"> Triceps
                            </label>

                            <label class="btn btn-outline-primary m-1">
                                <input type="checkbox" name="bodyParts[]" value="Abdominal"> Abdominal
                            </label>
                        </div>
                        <div id="muscle-error-msg" class="invalid-feedback muscle-error text-danger"
                             style="display: none;">Please provide at least one muscle group.
                        </div>
                        <input type="hidden" name="id" id="exerciceIdInput">
                        <input type="hidden" name="creatorId" id="creatorIdInput">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="exerciceForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>