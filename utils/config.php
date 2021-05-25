<?php
function console_log($data)
{
    echo '<script>console.log(' . json_encode($data) . ')</script>';
}

if ($_SERVER['build'] === "heroku") {
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

function multiQuery($item, $query)
{
    $arr = [];
    $res = $GLOBALS["conn"]->query($query);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if (sizeof($item) < 2)
                array_push($arr, $row[$item[0]]);
            else
                array_push($arr, [$row[$item[0]], $row[$item[1]]]);
        }
        return $arr;
    } else {
        return false;
    }
}

function recQuery($id)
{
    $arr = [];

    $query1 = "SELECT * FROM recipe_table WHERE id=" . $id;
    $query2 = "SELECT * FROM steps_table WHERE recipe_id=" . $id;
    $query3 = "SELECT * FROM tags_table WHERE recipe_id=" . $id;
    $query4 = "SELECT * FROM picture_table WHERE recipe_id=" . $id;
    $query5 = "SELECT * FROM recipe_ingredients_list i JOIN ingredient_table r ON i.ingredient_id = r.id WHERE i.recipe_id =" . $id;

    $result = $GLOBALS["conn"]->query($query1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arr["id"] = $row["id"];
        $arr["recipe_name"] = $row["recipe_name"];
        $arr["rating"] = intval($row["rating"]);
        $arr["description"] = $row["description"];
        $arr["timeToPrep"] = $row["timeToPrep"];
        $arr["timeToCook"] = $row["timeToCook"];
        $arr["serving"] = $row["serving"];
    } else {
        return "error";
    }
    $arr["steps"] = multiQuery(["stepTxt"], $query2);
    $arr["keywords"] = multiQuery(["tag"], $query3);
    $arr["pictures"] = multiQuery(["file"], $query4);
    $arr["ingredients"] = multiQuery(["amount", "ingredient_name"], $query5);

    return $arr;
}
// echo 'Success: A proper connection to MySQL was made.';
// echo '<br>';
// echo 'Host information: ' . $conn->host_info;
// echo '<br>';
// echo 'Protocol version: ' . $conn->protocol_version;

// $conn->close();
