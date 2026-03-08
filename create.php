<?php

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"]) || !isset($data["email"])) {
    echo json_encode(["message" => "Invalid input"]);
    exit;
}

$file = "data.txt";

$existingUsers = [];

if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $existingUsers[] = json_decode($line, true);
    }
}

foreach ($existingUsers as $user) {
    if ($user["email"] === $data["email"]) {
        echo json_encode(["message" => "Email already exists"]);
        exit;
    }
}

$id = time();

$newUser = [
    "id" => $id,
    "name" => $data["name"],
    "email" => $data["email"]
];

$line = json_encode($newUser) . PHP_EOL;

file_put_contents($file, $line, FILE_APPEND);

echo json_encode(["message" => "User created successfully"]);