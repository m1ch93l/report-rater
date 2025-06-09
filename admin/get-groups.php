<?php
session_start();
require_once '../includes/database.php';

// get all groups
$stmt = $conn->prepare('SELECT * FROM `groups` ORDER BY `id` ASC');
$stmt->execute();
$groups = $stmt->fetchAll();

echo '<select class="form-select form-select-sm text-capitalize" name="active_group" hx-post="update-active-group.php"
    hx-trigger="change" hx-target="#message" hx-swap="innerHTML">';

    foreach ($groups as $group) {
    $selected = ($group['status'] == 1) ? 'selected' : '';
    echo "<option value=\"{$group['id']}\" $selected>Group-" . htmlspecialchars(ucfirst($group['group_no'])) . "</option>";
    }

    echo '</select>';