<?php

header("Content-Type: application/json");

$file = "data.txt";

$id = $_GET["id"] ?? null;

$data = json_decode(file_get_contents("php://input"), true);

if (!$id) {
    echo json_encode(["message" => "ID required"]);
    exit;
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$updatedUsers = [];

foreach ($lines as $line) {

    $user = json_decode($line, true);

    if ($user["id"] == $id) {
        $user["name"] = $data["name"];
        $user["email"] = $data["email"];
    }

    $updatedUsers[] = json_encode($user);
}

file_put_contents($file, implode(PHP_EOL, $updatedUsers) . PHP_EOL);

echo json_encode(["message" => "User updated successfully"]);