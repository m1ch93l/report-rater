<?php
require_once '../includes/database.php';

$sql  = "SELECT * FROM participant";
$stmt = $conn->prepare($sql);
$stmt->execute();

foreach ($stmt as $row) { ?>
    <tr class="text-uppercase" id="participant-<?= $row['id'] ?>">
        <td width="45%" hx-get="edit-participant.php?id=<?= $row['id'] ?>" hx-target="#participant-<?= $row['id'] ?>"
            hx-swap="outerHTML">
            <span class="participant-name"><?= htmlspecialchars($row['fullname']) ?></span>
        </td>
        <td hx-get="edit-participant.php?id=<?= $row['id'] ?>" hx-target="#participant-<?= $row['id'] ?>"
            hx-swap="outerHTML">
            <span class="participant-group"><?= htmlspecialchars($row['group_belong']) ?></span>
        </td>
        <td hx-get="edit-participant.php?id=<?= $row['id'] ?>" hx-target="#participant-<?= $row['id'] ?>" hx-swap="outerHTML">
            <span class="participant-group"><?= htmlspecialchars($row['year_level_section']) ?></span>
        </td>
        <td>
            <button class="btn btn-secondary btn-sm" hx-get="edit-participant.php?id=<?= $row['id'] ?>&inline=1"
                hx-target="#participant-<?= $row['id'] ?>" hx-swap="outerHTML">Edit</button>
        </td>
    </tr>
<?php } ?>