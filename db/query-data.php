<?php
    $students = [];
    if ($result = mysqli_query($conn, 'SELECT * FROM students')) {
        while($row = $result->fetch_assoc()) {
            array_push($students, $row);
        }
    }

    $scores = [];
    if ($result = mysqli_query($conn, 'SELECT * FROM scores')) {
        while($row = $result->fetch_assoc()) {
            array_push($scores, $row);
        }
    }

    $score_onlines = [];
    if ($result = mysqli_query($conn, 'SELECT * FROM score_onlines')) {
        while($row = $result->fetch_assoc()) {
            array_push($score_onlines, $row);
        }
    }
?>