<?php

require_once '../includes/database.php';

$sql  = "SELECT participant.id as id, participant.fullname as fullname, rating.content as content, rating.organization as organization, rating.presentation as presentation, rating.delivery as delivery, `groups`.group_no as groupno FROM rating JOIN participant ON rating.participant_id = participant.id JOIN `groups` ON participant.group_belong = `groups`.id ORDER BY `groups`.group_no, participant.fullname";
$stmt = $conn->prepare($sql);
$stmt->execute();

$prev_groupno = null;
foreach ($stmt as $row) {
    if ($prev_groupno !== $row['groupno']) {
        if ($prev_groupno !== null)
            echo '</div>';
        echo '<div class="row mt-3"><h3 class="">Group ' . $row['groupno'] . '</h3></div><div class="row">';
        $prev_groupno = $row['groupno'];
    }
    ?>
    <div class="col-md-2 col-sm-12">
        <div class="card shadow mb-2">
            <div class="card-header text-capitalize"><?= $row['fullname'] ?></div>
            <div class="card-body">

                <!-- e-click para sa lumabas ang modal -->
                <button type="button" class="btn btn-success btn-sm" hx-get="data-modal.php?id=<?= $row['id'] ?>"
                    hx-target="#modalBody" hx-trigger="click" hx-swap="innerHTML" data-bs-toggle="modal"
                    data-bs-target="#showEachCard">
                    <span><i class="bi bi-eye"></i></span>
                </button>
                <!-- e-click para e-delete ang user -->
                <button class="btn btn-danger btn-sm" hx-delete="delete-user.php?id=<?= $row['id'] ?>" hx-confirm="Are you sure?">
                    <span><i class="bi bi-trash3"></i></span>
                </button>

            </div>
        </div>
    </div>
<?php } ?>
<?php if ($prev_groupno !== null)
    echo '</div>'; ?>