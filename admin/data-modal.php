<?php
// Ito nag hangga sa data galing sa button ng modal

// Retrieve the ID from the query string
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Sample dynamic content based on the ID
if ($id) {
    echo "<p>Loading content for item with ID: $id</p>";
    // You can add more logic here to fetch data based on the ID
} else {
    echo "<p>No ID provided.</p>";
}