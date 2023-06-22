<?php
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');

    $newTask = $_POST;
    $dataStr = file_get_contents("data.json");
    $data = json_decode($dataStr);
    $data[] = $newTask;

    $encData = json_encode($data);

    file_put_contents("data.json", $encData);

    echo $encData;
?>
