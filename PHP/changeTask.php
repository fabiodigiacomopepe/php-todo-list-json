
<?php
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');

    $indice = $_POST['indice'];
    
    $dataStr = file_get_contents("data.json");
    $data = json_decode($dataStr);
    
    $task = $data[$indice];

    if ($task -> done == 'true') {
        $task -> done = 'false';
    } else {
        $task -> done = 'true';
    }

    $encData = json_encode($data);

    file_put_contents("data.json", $encData);

    echo $encData;
?>