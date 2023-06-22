<?php
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');

    $toDoList = [
        [
            'name' => 'compra pane',
            'done' => true
        ],
        [
            'name' => 'compra latte',
            'done' => false
        ],
    ];

    echo json_encode($toDoList);

    /* $data = $_POST;
    $encData = json_encode($data);
    echo $encData; */
?>
