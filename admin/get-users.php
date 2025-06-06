<?php
require_once '../includes/database.php';

$sql  = "SELECT * FROM participant";
$stmt = $conn->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['fullname']) ?></option>
<?php } ?>