<?php

header("Content-Type: application/json");

$file = "data.txt";

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["message" => "ID required"]);
    exit;
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$remainingUsers = [];

foreach ($lines as $line) {

    $user = json_decode($line, true);

    if ($user["id"] != $id) {
        $remainingUsers[] = json_encode($user);
    }
}

file_put_contents($file, implode(PHP_EOL, $remainingUsers) . PHP_EOL);

echo json_encode(["message" => "User deleted successfully"]);