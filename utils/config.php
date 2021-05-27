<?php
function console_log($data)
{
    echo '<script>console.log(' . json_encode($data) . ')</script>';
}

if (getenv('build') === "production") {
    $db_host = getenv('db_host');
    $db_user = getenv('db_user');
    $db_password = getenv('db_password');
    $db_db = getenv('db_db');
    $db_port = getenv('db_port');
} else {
    $db_host = 'localhost';
    $db_user = 'mamp';
    $db_password = 'password';
    $db_db = 'ITEC327_TermProject';
    $db_port = 8889;
}

$conn = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($conn->connect_error) {
    echo 'Errno: ' . $conn->connect_errno;
    echo '<br>';
    echo 'Error: ' . $conn->connect_error;
    exit();
}

function idQuery($query)
{
    $res = $GLOBALS["conn"]->query($query);
    if ($res->num_rows > 0) {
        $arr = [];
        while ($row = $res->fetch_assoc()) {
            array_push($arr, $row["id"]);
        }
    } else {
        $arr = "error";
    }
    return $arr;
}

function searchQuery($column, $search)
{
    $query = <<<EOD
        SELECT  `id`
        FROM    `recipes`
        WHERE   lower(`$column`) LIKE lower('%$search%');
    EOD;
    return idQuery($query);
}

function searchQueryJSON($column, $search, $sub = "")
{
    $add =  ($sub === "") ? "" : ".$sub";
    $query = <<<EOD
        SELECT  `id`
        FROM    `recipes`
        WHERE   JSON_SEARCH(`$column`, 'all', '%$search%', NULL, '$[*]$add') IS NOT NULL
    EOD;
    return idQuery($query);
}

function searchQueryRange($column, $Min = 0, $Max = 0)
{
    $minVal = ($Min > 0) ? $Min : 0;
    $maxVal = ($Max > 0) ? $Max : "MAX(`$column`)";
    $query = <<<EOD
        SELECT  `id`
        FROM    `recipes`
        WHERE   `$column` BETWEEN $minVal AND $maxVal;
    EOD;
    return idQuery($query);
}

function recipeQuery($id)
{
    $arr = [];
    $query = <<<EOD
        SELECT * 
        FROM `recipes` 
        WHERE `id`="$id"
    EOD;
    $result = $GLOBALS["conn"]->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arr["id"] = $row["id"];
        $arr["name"] = $row["name"];
        $arr["description"] = $row["description"];
        $arr["calories"] = intval($row["calories"]);
        $arr["difficulty"] = intval($row["difficulty"]);
        $arr["rating"] = $row["rating"];
        $arr["timeToPrep"] = intval($row["timeToPrep"]);
        $arr["timeToCook"] = intval($row["timeToCook"]);
        $arr["tag"] = json_decode($row["tag"], true);
        $arr["class"] = json_decode($row["class"], true);
        $arr["image"] = json_decode($row["image"], true);
        $arr["ingredient"] = json_decode($row["ingredient"], true);
        $arr["steps"] = json_decode($row["steps"], true);
    } else {
        return "error";
    }
    return $arr;
}

function randomRecipeIds($amount = 0)
{
    $query = <<<EOD
        SELECT `id`
        FROM `recipes`;
    EOD;
    $idArr = idQuery($query);
    return array_map(function ($key) use ($idArr) {
        return $idArr[$key];
    }, array_rand($idArr, $amount));
}

function recipesArray($idArr = [])
{
    return array_map(
        function ($ID) {
            $res = recipeQuery($ID);
            $curr = new Recipe(
                $res["id"],
                $res["name"],
                $res["description"],
                $res["calories"],
                $res["difficulty"],
                $res["rating"],
                $res["timeToPrep"],
                $res["timeToCook"],
                $res["tag"],
                $res["class"],
                $res["image"],
                $res["ingredient"],
                $res["steps"]
            );
            return $curr;
        },
        $idArr
    );
}

function newContactMessage($name = "", $email = "", $message = "")
{
    $query = <<<EOD
        INSERT INTO `contact`(
                `name`,
                `email`,
                `message`
            ) VALUES (
                "$name",
                "$email",
                "$message"
            )
    EOD;
    return $GLOBALS["conn"]->query($query);
}

function newNewsletter($email = "")
{
    $query = <<<EOD
        INSERT INTO `newsletter`(
                `email`
            ) VALUES (
                "$email"
            )
    EOD;
    return $GLOBALS["conn"]->query($query);
}

$successTXT = <<<EOD
    Success: A proper connection to MySQL was made.
    </br>
    Host information: $conn->host_info
    </br>
    Protocol version: $conn->protocol_version
EOD;

// $conn->close();
