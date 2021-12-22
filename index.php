<?php

require "pdo_connect.php";
require "query_manager.php";

?>


<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Boardgame Database</title>
    <link rel="stylesheet" href="style_index.css" media="screen">

    <script src="script_index.js"></script>
</head>

<body>

    <div id="main-container">

        <aside class="sidebar">

            <!-- logo -->
            <a href="index.php" id="logo">
                <h1>Boardgame Database</h1>
            </a>

            <!-- add game form -->
            <div id="addgame-wrapper"><button type="button" id="addgame-button">Add game</button></div>
            <form id="newgame-form" action="addgame.php" method="post" target="game-iframe">
                New game<br>
                <label for="new_name">Name:</label>
                <input type="text" name="new_name" required>
                <br>
                <label for="new_year">Year:</label>
                <input type="number" name="new_year" required>
                <br>
                <label for="new_honors">Honors:</label>
                <input type="text" name="new_honors" required>
                <br>
                <label for="new_category">Category:</label>
                <input type="text" name="new_category" required>
                <br>
                <label for="new_description">Description:</label>
                <input type="text" name="new_description" required>
                <br>
                <label for="new_minplayers">Min players:</label>
                <input type="number" name="new_minplayers" required>
                <br>
                <label for="new_maxplayers">Max players:</label>
                <input type="number" name="new_maxplayers" required>
                <br>
                <label for="new_minplaytime">Min playtime:</label>
                <input type="number" name="new_minplaytime" required>
                <br>
                <label for="new_maxplaytime">Max playtime:</label>
                <input type="number" name="new_maxplaytime" required>
                <br>
                <label for="new_minage">Min age:</label>
                <input type="number" name="new_minage" required>
                <br>
                <label for="new_designer">Designer:</label>
                <input type="text" name="new_designer" required>
                <br>
                <label for="new_artist">Artist:</label>
                <input type="text" name="new_artist" required>
                <br>
                <label for="new_publisher">Publisher:</label>
                <input type="text" name="new_publisher" required>
                <br>
                <label for="new_usersrated">Users rated:</label>
                <input type="number" name="new_usersrated" required>
                <br>
                <label for="new_avgrating">Avg rating:</label>
                <input type="number" name="new_avgrating" step="any" required>
                <br>
                <label for="new_avgdifficulty">Avg difficulty:</label>
                <input type="number" name="new_avgdifficulty" step="any" required>
                <br>
                <input type="submit" value="Submit">
            </form>
            <br>

            <!-- search game form -->
            <form action="searchgame.php" method="get" target="game-iframe" id="search-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <br>
                <input type="submit" value="Search">
            </form>
            <br>

            <!-- filter form -->
            <form action="" method="get">
                <input type="hidden" name="page" value="1">

                <!-- rating -->
                <?php
                echo '';
                if (isset($_GET['rating'])) {
                    echo '<label for="rating" id="rating-label">Rating: ' . $_GET['rating'] . '+</label>';
                    echo '&nbsp<input type="range" id="rating-slider" name="rating" min="0" max="9" step="1" value="' . $_GET['rating'] . '">';
                } else {
                    echo '<label for="rating" id="rating-label">Rating: 0+</label>';
                    echo '&nbsp<input type="range" id="rating-slider" name="rating" min="0" max="9" step="1" value="0">';
                } ?>
                <br>

                <!-- difficulty -->
                <?php
                echo '';
                if (isset($_GET['avgdifficulty'])) {
                    echo '<label for="avgdifficulty" id="avgdifficulty-label">Difficulty: ' . $_GET['avgdifficulty'] . '+</label>';
                    echo '&nbsp<input type="range" id="avgdifficulty-slider" name="avgdifficulty" min="0" max="4" step="1" value="' . $_GET['avgdifficulty'] . '">';
                } else {
                    echo '<label for="avgdifficulty" id="avgdifficulty-label">Difficulty: 0+</label>';
                    echo '&nbsp<input type="range" id="avgdifficulty-slider" name="avgdifficulty" min="0" max="4" step="1" value="0">';
                } ?>
                <br>
                <br>

                <!-- min/max players -->
                Players:
                <br>
                <label for="minplayers">min:</label>
                <?php
                echo '<input type="number" class="small-text-input" id="minplayers-input" name="minplayers" min="0" value=';
                if (isset($_GET['minplayers'])) {
                    echo '"' . $_GET['minplayers'] . '">';
                } else {
                    echo '"">';
                }
                ?>

                <label for="maxplayers">&nbsp max:</label>
                <?php
                echo '<input type="number" class="small-text-input" id="maxplayers-input" name="maxplayers" min="0" value=';
                if (isset($_GET['maxplayers'])) {
                    echo '"' . $_GET['maxplayers'] . '">';
                } else {
                    echo '"">';
                }
                ?>
                <br>
                <br>

                <!-- min/max playtime -->
                Playtime:
                <br>
                <label for="minplaytime">min:</label>
                <?php
                echo '<input type="number" class="small-text-input" id="minplaytime-input" name="minplaytime" min="0" value=';
                if (isset($_GET['minplaytime'])) {
                    echo '"' . $_GET['minplaytime'] . '">';
                } else {
                    echo '"">';
                }
                ?>

                <label for="maxplaytime">&nbsp max:</label>
                <?php
                echo '<input type="number" class="small-text-input" id="maxplaytime-input" name="maxplaytime" min="0" value=';
                if (isset($_GET['maxplaytime'])) {
                    echo '"' . $_GET['maxplaytime'] . '">';
                } else {
                    echo '"">';
                }
                ?>
                <br>
                <br>

                <!-- min age -->
                <label for="minage">Age:</label>
                <?php
                echo '<input type="number" class="small-text-input" id="minage-input" name="minage" min="0" value=';
                if (isset($_GET['minage'])) {
                    echo '"' . $_GET['minage'] . '">';
                } else {
                    echo '"">';
                }
                ?>
                <span> +</span>
                <br>


                <!-- honors -->
                <?php

                echo '<input type="checkbox" class="checkbox" id="honors-checkbox" name="honors" value="true" ';
                if (isset($_GET['honors'])) {
                    echo "checked>";
                } else {
                    echo ">";
                }
                ?>
                <label for="honors">Honors</label>
                <br>
                <br>
                <input type="submit" value="Apply">
                <input type="button" id="clear-button" value="Clear">
            </form>
        </aside>

        <div id="section-container">


            <section class="grid-container">
                <?php

                while ($row = $statement->fetch()) {

                    echo "<div class=\"grid-item\">";


                    echo "<a href=\"displaygame.php?id=" . $row['id'] . "\" target=\"game-iframe\" class=\"iframe-link\"><span>";

                    $name = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
                    }, $row['name']);
                    echo html_entity_decode($name);
                    echo "</span></a>";
                    echo "<p>";
                    echo "rating: " . round(floatval($row['avgrating']), 1) . "<br>";
                    if ($row['minplayers'] == $row['maxplayers']) {
                        echo "players: " . $row['minplayers'];
                    } else {
                        echo "players: " . $row['minplayers'] . " - " . $row['maxplayers'];
                    }
                    //echo "players: " . $row['minplayers'] . " max: " . $row['maxplayers'] . "<br>";
                    echo "<br>age: " . $row['minage'] . "+<br>";
                    //echo "<br>" . $row['id'] . "<br>";
                    echo "</p>";

                    echo "</div>";
                }

                $statement->closeCursor();

                ?>
            </section>



            <div id="page-buttons">

                <?php

                echo ($page > 1) ? " <a href=\"index.php?page=1" . $url_params . "\">first</a> " : "";
                echo ($page > 1) ? "<a href=\"index.php?page=" . ($page - 1) . $url_params . "\">prev</a>" : "";
                echo " " . $page . " / " . $total_pages;
                echo ($page < $total_pages) ? " <a href=\"index.php?page=" . ($page + 1) . $url_params . "\">next</a>" : "";
                echo ($page < $total_pages) ? " <a href=\"index.php?page=" . $total_pages . $url_params . "\">last</a>" : "";

                ?>
            </div>
        </div>

        <iframe src="" id="game-iframe" name="game-iframe" title="Game iframe">
        </iframe>
        <div id="close-iframe">Close</div>
        <div id="black-wall"></div>


    </div>
</body>

</html>