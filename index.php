<?php
include("./utils/config.php");
include("./utils/func.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Home";
    $pageName = "home";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <div class="banner">
        <div class="banner-text">
            <h1>
                <strong>
                    Choose from thousands of recipes
                </strong>
            </h1>
            <span>
                Appropriately integrate technically sound value with scalable infomediaries negotiate sustainable strategic theme areas
            </span>
            </br>
            </br>
            <a href="./addRecipe.php">Add a recipe today <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sticky-md-top">
                <div class="sticky-md-top">
                    <div>
                        <h1>Recipes</h1>
                        <h4>Classification</h4>
                        <?php
                        include("./utils/ClassAccordion.php");
                        AccordionConst($recipeCategory);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 rightDiv mb-3">
                <div class="row row-cols-2 row-cols-md-4 g-1 g-md-3 mt-1">
                    <?php
                    $uri = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($uri['query'], $params);
                    if (!empty($params)) {
                        $idArr = searchQuery("class", $params["class"]);
                        foreach (recipesArray($idArr) as $val) {
                            echo "<div class='col d-inline'>" . $val->CardBox() . "</div>";
                        }
                    } else {
                        $idArr = randomRecipeIds(20);
                        shuffle($idArr);
                        foreach (recipesArray($idArr) as $val) {
                            echo "<div class='col d-inline'>" . $val->CardBox() . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="newsBox container d-flex flex-column">
            <h2 class="newsText">
                Be the first to know about the latest deals, receive new trending recipes & more!
            </h2>
            <form class="container-fluid row newsInput">
                <div class="col-lg-9 py-3">
                    <label for="inputEmail" class="visually-hidden">Email</label>
                    <input type="email" class="form-control rounded-pill" id="inputEmail" placeholder="Email">
                </div>
                <div class="col-md-3 py-3">
                    <input type="submit" value="Subscribe" class="btn rounded-pill">
                </div>
            </form>
        </div>
    </div>
    <?php
    include("./utils/footer.php");
    ?>
</body>

</html>