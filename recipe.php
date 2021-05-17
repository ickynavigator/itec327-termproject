<?php
include("./utils/config.php");
include("./utils/func.php");
$uri = parse_url($_SERVER['REQUEST_URI']);
parse_str($uri['query'], $params);

$res = recQuery($params['id']);
console_log($res);
$CurrRecipe = new Recipe(
    $res["id"],
    $res["recipe_name"],
    $res["keywords"],
    $res["rating"],
    $res["description"],
    $res["pictures"],
    $res["ingredients"],
    $res["steps"],
    $res["timeToPrep"],
    $res["timeToCook"],
    $res["serving"]
);
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
    </div>

    <div class="container-fluid py-5 h-25 w-100">
        <h3>Other Recipes You May Like</h3>
        <div class="row row-cols-2 row-cols-md-4 g-2 g-lg-3 section">
            <?php
            for ($i = 1; $i <= 8; $i++) {
                echo "<div class='col'>";
                $sampleRecipe->Cardbox();
                echo "</div>";
            }
            ?>
        </div>
    </div>


    <?php include("./utils/footer.php"); ?>
</body>

</html>