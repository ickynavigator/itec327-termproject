<?php
include("../../utils/config.php");
include("./utils/session.php");

function deleteRecipe($id)
{
    $query = "DELETE FROM `recipes` WHERE `id` = $id;";
    $GLOBALS["conn"]->query($query);
    header('Location: ../index.php');
}

deleteRecipe($_GET["id"]);
