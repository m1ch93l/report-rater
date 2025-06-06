<?php

require_once '../includes/database.php';

$id = $_GET['id'];

// Delete the participant from the database
$sql  = "DELETE FROM participant WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]); ?>

<!-- Return and remove the row using HTMX after delete -->
<tr class="text-uppercase" id="participant-<?= $id ?>" hx-target="this" hx-swap="outerHTML:beforeend">
    <td colspan="4">Participant <?= $fullname ?> has been removed.</td>
</tr>
<script>
    document.querySelector("#participant-<?= $id ?>").remove();
</script>
<?php exit; ?>