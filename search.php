<?php include("./utils/func.php"); ?>
<?php include("./utils/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Search";
    $pageName = "search";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <div class="container main-div">
        <?php include("./utils/searchbar.php"); ?>
        <div class="row row-cols-sm-2 row-cols-md-4 mt-1 g-2 g-lg-3">
            <?php
            $uri = parse_url($_SERVER['REQUEST_URI']);
            parse_str($uri['query'], $params);
            if (!empty($params)) {
                if ($params["SearchType"] === "name" || $params["SearchType"] === "tag" || $params["SearchType"] === "class") {
                    $idArray = searchQuery($params["SearchType"], $params["Search"]);
                } else {
                    $idArray = searchQueryJSON($params["SearchType"], $params["Search"], "name");
                }
            } else {
                $idArray = randomRecipeIds(20);
                shuffle($idArray);
            }
            if ($idArray === "error") {
                echo "<div class='h-100 w-100 d-flex align-items-center'><h1>No Recipes meet the specified criteria</h1></div>";
            } else {
                foreach (recipesArray($idArray) as $val) {
                    echo "<div class='col d-inline'>" . $val->CardBox() . "</div>";
                }
            }
            ?>
        </div>
    </div>
    <?php include("./utils/footer.php"); ?>
</body>

</html>