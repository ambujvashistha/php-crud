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

if (isset($_GET["id"])) {

    foreach ($users as $user) {
        if ($user["id"] == $_GET["id"]) {
            echo json_encode($user);
            exit;
        }
    }

    echo json_encode(["message" => "User not found"]);
    exit;
}

if (isset($_GET["name"])) {

    $result = [];

    foreach ($users as $user) {
        if (stripos($user["name"], $_GET["name"]) !== false) {
            $result[] = $user;
        }
    }

    echo json_encode($result);
    exit;
}

if (isset($_GET["email"])) {

    $result = [];

    foreach ($users as $user) {
        if ($user["email"] == $_GET["email"]) {
            $result[] = $user;
        }
    }

    echo json_encode($result);
    exit;
}

echo json_encode($users);