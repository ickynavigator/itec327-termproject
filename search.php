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
        <form class="d-flex search-bar sticky-top">
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
        <div class="row row-cols-sm-2 row-cols-md-4 mt-1 g-2 g-lg-3 section">
            <br>
            <?php
            for ($i = 1; $i <= 15; $i++) {
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