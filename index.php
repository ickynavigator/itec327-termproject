<?php include("./utils/config.php"); ?>
<?php include("./utils/func.php"); ?>
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
            <a href="#">Sign up today <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sticky-md-top">
                <div class="sticky-md-top">
                    <div>
                        <h1>Recipes</h1>
                        <?php
                        AccordionConst($recipeCategory);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 rightDiv">
                <form class="d-flex search-bar">
                    <div class="input-group mb-3 search-div">
                        <span class="input-group-text search-icon" id="basic-addon1">
                            <i class="fas fa-search"></i>
                        </span>
                        <input class="form-control me-2 search-text" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn search-btn" type="submit">
                            Search
                        </button>
                    </div>
                </form>
                <div class="row row-cols-3 g-2 g-lg-3 section">
                    <br>
                    <?php
                    for ($i = 1; $i <= 15; $i++) {
                        echo "<div class='col'>";
                        $rec1->Cardbox();
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