<?php
/*
 * This file basically just reads the GET parameters and
 * constructs a query based on them for filtering, then
 * executes the query and puts $limit rows in $statement.
 * It also has the variables for managing the pagination.
 * 
 * Make sure it's included in index.php
*/

// number of items per page
$limit = 20;

// store parameters for use in url
$url_params = "";

// set base query
$base_query = "SELECT `name`, `games`.`id`, `avgrating`, `minplayers`, `maxplayers`, `minage`
               FROM `games`, `ratings`, `gameplay`, `creators`
               WHERE `games`.`id`=`ratings`.`id`
               AND `ratings`.`id`=`gameplay`.`id`
               AND `gameplay`.`id`=`creators`.`id`";

// add filters
$query_filter = "";

// if rating filter
if (isset($_GET['rating'])) {
    if (is_numeric($_GET['rating']) && $_GET['rating'] >= 0 && $_GET['rating'] <= 10) {
        $query_filter .= " AND `avgrating`>=" . $_GET['rating'];
        $url_params .= "&rating=" . $_GET['rating'];
    } else {
        $query_filter .= "AND `avgrating`>=0";
    }
}

// if avgdifficulty filter
if (isset($_GET['avgdifficulty'])) {
    if (is_numeric($_GET['avgdifficulty']) && $_GET['avgdifficulty'] >= 0) {
        $query_filter .= " AND `avgdifficulty`>=" . $_GET['avgdifficulty'];
        $url_params .= "&avgdifficulty=" . $_GET['avgdifficulty'];
    }
}

// if minplayers filter
if (isset($_GET['minplayers'])) {
    if (is_numeric($_GET['minplayers']) && $_GET['minplayers'] >= 0) {
        $query_filter .= " AND `minplayers`=" . $_GET['minplayers'];
        $url_params .= "&minplayers=" . $_GET['minplayers'];
    }
}

// if maxplayers filter
if (isset($_GET['maxplayers'])) {
    if (is_numeric($_GET['maxplayers']) && $_GET['maxplayers'] >= 0) {
        $query_filter .= " AND `maxplayers`=" . $_GET['maxplayers'];
        $url_params .= "&maxplayers=" . $_GET['maxplayers'];
    }
}

// if minplaytime filter
if (isset($_GET['minplaytime'])) {
    if (is_numeric($_GET['minplaytime']) && $_GET['minplaytime'] >= 0) {
        $query_filter .= " AND `minplaytime`=" . $_GET['minplaytime'];
        $url_params .= "&minplaytime=" . $_GET['minplaytime'];
    }
}

// if maxplaytime filter
if (isset($_GET['maxplaytime'])) {
    if (is_numeric($_GET['maxplaytime']) && $_GET['maxplaytime'] >= 0) {
        $query_filter .= " AND `maxplaytime`=" . $_GET['maxplaytime'];
        $url_params .= "&maxplaytime=" . $_GET['maxplaytime'];
    }
}

// if minage filter
if (isset($_GET['minage'])) {
    if (is_numeric($_GET['minage']) && $_GET['minage'] >= 0) {
        $query_filter .= " AND `minage`=" . $_GET['minage'];
        $url_params .= "&minage=" . $_GET['minage'];
    }
}

// if honors filter
if (isset($_GET['honors']) && $_GET['honors'] == "true") {
    $query_filter .= " AND `honors`!=\"['None']\"";
    $url_params .= "&honors=" . $_GET['honors'];
}

$query = $base_query . $query_filter . " ORDER BY `id` ASC LIMIT :start, :limit";

// get number of rows and pages
$count_query = "SELECT count(*) FROM `games`, `ratings`, `gameplay`, `creators`
                WHERE `games`.`id`=`ratings`.`id` AND `ratings`.`id`=`gameplay`.`id`
                AND `gameplay`.`id`=`creators`.`id`" . $query_filter;

//$count_query = "SELECT count(*) FROM `games`";
$count_statement = $db->prepare($count_query);
$count_statement->execute();
$total_results = $count_statement->fetchColumn();
$total_pages = ceil($total_results / $limit);

// set page number
if (
    isset($_GET['page']) && is_numeric($_GET['page']) &&
    $_GET['page'] > 0 && $_GET['page'] <= $total_pages
) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// put $limit rows into $statement
$start = ($page - 1) * $limit;

$statement = $db->prepare($query);
$statement->bindValue(':start', $start, PDO::PARAM_INT);
$statement->bindValue(':limit', $limit, PDO::PARAM_INT);
$statement->execute();
