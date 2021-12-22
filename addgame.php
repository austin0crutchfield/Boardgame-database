<?php

require "pdo_connect.php";

// get new id
$query = "SELECT MAX(id) FROM `games`";

$statement = $db->prepare($query);
$statement->execute();
$new_id = $statement->fetchColumn() + 1;


// add game
$query = "CALL addToGames(:new_id, :new_name, :new_year, :new_honors, :new_category, :new_description)";

$statement = $db->prepare($query);
$statement->bindValue(':new_id', $new_id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_name', $_POST['new_name'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_year', $_POST['new_year'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_honors', $_POST['new_honors'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_category', $_POST['new_category'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_description', $_POST['new_description'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->execute();


// add gameplay
$query = "CALL addToGameplay(:new_id, :new_minplayers, :new_maxplayers, :new_minplaytime, :new_maxplaytime, :new_minage)";

$statement = $db->prepare($query);
$statement->bindValue(':new_id', $new_id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_minplayers', $_POST['new_minplayers'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_maxplayers', $_POST['new_maxplayers'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_minplaytime', $_POST['new_minplaytime'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_maxplaytime', $_POST['new_maxplaytime'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_minage', $_POST['new_minage'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->execute();


// add creator
$query = "CALL addToCreators(:new_id, :new_designer, :new_artist, :new_publisher)";

$statement = $db->prepare($query);
$statement->bindValue(':new_id', $new_id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_designer', $_POST['new_designer'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_artist', $_POST['new_artist'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_publisher', $_POST['new_publisher'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->execute();


// add rating
$query = "CALL addToRatings(:new_id, :new_usersrated, :new_avgrating, :new_avgdifficulty)";

$statement = $db->prepare($query);
$statement->bindValue(':new_id', $new_id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_usersrated', $_POST['new_usersrated'], PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_avgrating', $_POST['new_avgrating'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->bindValue(':new_avgdifficulty', $_POST['new_avgdifficulty'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
$statement->execute();

$statement->closeCursor();

?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Add game</title>

    <style>
        body,
        html {
            background-color: white;
        }

        h2 {
            margin: 0;
            padding: 10px;
        }

        p {
            margin: 0;
            padding: 0 10px;
            font-size: 18px;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <h2>Added successfully</h2>
    <?php
    echo "<p>";
    echo "Name: " . $_POST['new_name'] . "<br>";
    echo "Year: " . $_POST['new_year'] . "<br>";
    echo "Honors: " . $_POST['new_honors'] . "<br>";
    echo "Category: " . $_POST['new_category'] . "<br>";
    echo "Description: " . $_POST['new_description'] . "<br>";
    echo "Min players: " . $_POST['new_minplayers'] . "<br>";
    echo "Max players: " . $_POST['new_maxplayers'] . "<br>";
    echo "Min playtime: " . $_POST['new_minplaytime'] . "<br>";
    echo "Max playtime: " . $_POST['new_maxplaytime'] . "<br>";
    echo "Min age: " . $_POST['new_minage'] . "<br>";
    echo "Designer: " . $_POST['new_designer'] . "<br>";
    echo "Artist: " . $_POST['new_artist'] . "<br>";
    echo "Publisher: " . $_POST['new_publisher'] . "<br>";
    echo "Users rated: " . $_POST['new_usersrated'] . "<br>";
    echo "Avg rating: " . $_POST['new_avgrating'] . "<br>";
    echo "Avg difficulty: " . $_POST['new_avgdifficulty'] . "<br>";
    echo "Id: " . $new_id;
    echo "</p>";
    ?>
</body>

</html>