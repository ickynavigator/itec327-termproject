<?php
include("../utils/config.php");
include("../utils/func.php");
$uri = parse_url($_SERVER['REQUEST_URI']);
parse_str($uri['query'], $params);

$res = recipeQuery($params['id']);
if ($res !== "error") {
    $CurrRecipe = (recipesArray([$params['id']]))[0];
} else {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = $CurrRecipe->getName();
    $pageName = "recipe";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <div class="container">
        <div class="row row-cols-sm-1 row-cols-md-2 d-flex justify-content-center align-items-center">
            <?php $CurrRecipe->infoPrint(); ?>
        </div>
    </div>

    <div class="container py-3">
        <div class="row row-sm-1 row-lg-12">
            <div class="col-sm-3 mt-3">
                <?php $CurrRecipe->ingredientPrint(); ?>
                <?php $CurrRecipe->tagPrint(); ?>
            </div>
            <div class="col-sm-9 mt-3">
                <?php $CurrRecipe->stepPrint(); ?>
            </div>
        </div>
        <a href="./Admin/utils/deleteRecipe?id=<?php echo $params['id'] ?>" class="btn btn-primary">Delete Recipe</a>
    </div>

    <?php include("../utils/footer.php"); ?>
</body>

</html>