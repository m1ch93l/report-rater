<?php

require_once '../model/admin.php';

// Retrieve the ID from the query string
$id = isset($_GET['id']) ? $_GET['id'] : '';
?>
<div class="modal-content" hx-get="data-modal.php?id=<?= $id ?>" hx-trigger="every 5s" hx-target="this">
    <div class="modal-header">
        <?php $fullname = new Admin;
                $fullname = $fullname->getStudentFullname($id); ?>
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $fullname['fullname'] ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <!-- mag add ng id kagaya ng "modalBody" para sa handle ng parameter -->
    <div class="modal-body" id="modalBody">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Criteria</th>
                        <th>Average</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $score  = new Admin;
                    $scores = $score->getTotalScore($id);
                    ?>
                    <tr>
                        <td>Content</td>
                        <td><?= round($scores['content'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Organization</td>
                        <td><?= round($scores['organization'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Presentation</td>
                        <td><?= round($scores['presentation'], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Delivery</td>
                        <td><?= round($scores['delivery'], 2) ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-5">Total</td>
                        <td class="fw-bold fs-5"><?= round($scores['total_score'], 2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
    </div>
</div>