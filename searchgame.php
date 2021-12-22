<?php

require "pdo_connect.php";

$query = "CALL searchForGame(:sname)";

$statement = $db->prepare($query);
$statement->bindValue(':sname', $_GET['name'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->execute();

?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Display game</title>

    <style>
        body,
        html {
            background-color: white;
        }
    </style>
</head>

<body>

    <?php
    while ($row = $statement->fetch()) {

        echo "<h2>" . htmlspecialchars_decode(json_decode('"' . $row['name'] . '"')) . " (" . $row['year'] . ")</h2>";
        echo "<p>";

        // if min/max players the same
        if ($row['minplayers'] == $row['maxplayers']) {
            echo "Players: " . $row['minplayers'];
        } else {
            echo "Players: " . $row['minplayers'] . " - " . $row['maxplayers'];
        }

        // if min/max time the same
        if ($row['minplaytime'] == $row['maxplaytime']) {
            echo "<br>Play time: " . $row['minplaytime'] . " min";
        } else {
            echo "<br>Play time: " . $row['minplaytime'] . " - " . $row['maxplaytime'] . " min";
        }
        
        echo "<br>Difficulty: " . round(floatval($row['avgdifficulty']), 1);
        echo "<br>Age: " . $row['minage'] . "+<br><br>";

        // handle unicode
        $desc = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $row['description']);
        echo $desc;
        echo "<br><br><b>Category</b>: " . trim(str_replace("'", "", $row['category']), "[]");
        echo "<br><b>Honors</b>: " . trim(str_replace("'", "", $row['honors']), "[]");
        echo "<br><b>Rating</b>: " . round(floatval($row['avgrating']), 1) . " by " . $row['usersrated'] . " users";
        echo "<br><br>Designed by " . trim(str_replace('"', "", str_replace("'", "", $row['designer'])), '[]"');
        echo "<br>Art by " . trim(str_replace("'", "", $row['artist']), '[]');
        echo "<br>Published by " . trim(str_replace("'", "", $row['publisher']), '[]"');
        echo "</p>";
        echo "<hr>";

    }

    $statement->closeCursor();

    ?>

</body>

</html>