<?php
require_once '../includes/database.php';

$id = $_GET['id'];

// Fetch the participant data from the database
$sql  = "SELECT * FROM participant WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to update the participant
    $fullname           = $_POST['fullname'];
    $group_belong       = $_POST['group_belong'];
    $year_level_section = $_POST['year_level_section'];

    // Update the participant in the database
    $updateSql  = "UPDATE participant SET fullname = ?, group_belong = ?, year_level_section = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([$fullname, $group_belong, $year_level_section, $id]); ?>

    <!-- Return the updated row as HTML -->
    <tr class="text-uppercase" id="participant-<?= $id ?>">
        <td width="45%"><?= $fullname ?></td>
        <td><?= $group_belong ?></td>
        <td><?= $year_level_section ?></td>
        <td>
            <button class="btn btn-secondary btn-sm" hx-get="edit-participant.php?id=<?= $id ?>&inline=1"
                hx-target="#participant-<?= $id ?>" hx-swap="outerHTML">Edit</button>
        </td>
        <td>
            <button class="btn btn-danger btn-sm" hx-delete="delete-participant.php?id=<?= $id ?>"
                hx-target="#participant-<?= $id ?>" hx-swap="outerHTML">Delete</button>
        </td>
    </tr>
    <?php exit;
} ?>

<!-- Show the inline form for editing -->
<tr class="text-uppercase" id="participant-<?= $id ?>">
    <td colspan="3">
        <form hx-post="edit-participant.php?id=<?= $id ?>" hx-target="#participant-<?= $id ?>" hx-swap="outerHTML">
            <div class="input-group">
                <input type="text" name="fullname" value="<?= $row['fullname'] ?>" class="form-control" required>
                <input type="number" name='group_belong' value="<?= $row['group_belong'] ?>" class="form-control"
                    required pattern="[0-9]*" inputmode="numeric">
                <input type="text" name='year_level_section' value="<?= $row['year_level_section'] ?>"
                    class="form-control" required>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
    </td>
</tr>