<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['lang'])){
    $_SESSION['lang'] = $data['lang'];

    echo json_encode([
        "success" => true,
        "lang" => $data['lang']
    ]);
} else {
    echo json_encode([
        "success" => false
    ]);
}