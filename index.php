<?php
include("./utils/config.php");
include("./utils/func.php");

function AccordionConst($arr)
{
    echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
    foreach ($arr as $num => $val) {
        $str = implode("\n", array_map(function ($foo) {
            return '<li class="accordion-link"><a href="#">' . $foo . '</a></li>';
        }, $val[1]));
        $str2 = ($num == 0) ? "show" : "";
        echo <<<EOD
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading$num">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse$num" aria-expanded="false" aria-controls="flush-collapse$num">
                    $val[0]
                </button>
            </h2>
            <div id="flush-collapse$num" class="accordion-collapse collapse $str2" aria-labelledby="flush-heading$num" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                $str
                </div>
            </div>
        </div>
        EOD;
    }
    echo '</div>';
}
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
                        AccordionConst($recipeCategory);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 rightDiv mb-3">
                <form class="d-flex search-bar">
                    <div class="input-group search-div">
                        <span class="input-group-text search-icon" id="basic-addon1">
                            <i class="fas fa-search"></i>
                        </span>
                        <input class="form-control me-2 search-text" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn search-btn" type="submit">
                            Search
                        </button>
                    </div>
                </form>
                <div class="row row-cols-3 g-2 g-lg-3 mt-1 section">
                    <br>
                    <?php
                    for ($i = 1; $i <= 24; $i++) {
                        echo "<div class='col'>";
                        $sampleRecipe->Cardbox();
                        echo "</div>";
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