<?php

function fileExists($filePath) {
    return file_exists($filePath);
}

if (isset($_GET['filePaths'])) {
    $filePaths = $_GET['filePaths'];
    $filePaths = explode(',', $filePaths);

    $response = array();

    foreach ($filePaths as $filePath) {
        $exists = fileExists($filePath);
        $response[$filePath] = $exists;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
