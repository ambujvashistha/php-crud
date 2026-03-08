<?php

header("Content-Type: application/json");

$file = "data.txt";

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$users = [];

foreach ($lines as $line) {
    $users[] = json_decode($line, true);
}

echo json_encode($users);

?>