<?php
    require './db/connect.php';
    $type = $_GET['type'];
    $id = $_POST['id'];
    $score = $_POST['score'];

    switch ($type) {
        case 'score':
            $query = "UPDATE `scores` SET `score` = $score WHERE `id` = $id";
            mysqli_query($conn, $query);
            break;
        case 'score_online':
            $query = "UPDATE `score_onlines` SET `score` = $score WHERE `id` = $id";
            mysqli_query($conn, $query);
            break;
    }
    echo $score;
?>