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
            $idArray = randomRecipeIds(20);
            shuffle($idArray);

            if (isset($_POST['sbmtSearch'])) {
                $type = filter_input(INPUT_POST, 'SearchType');
                $search = filter_input(INPUT_POST, 'Search');
                if ($type === "name" || $type === "tag" || $type === "class") {
                    $idArray = searchQuery($type, $search);
                } else {
                    $idArray = searchQueryJSON($type, $search, "name");
                }
            }

            if (isset($_POST['sbmtRange'])) {
                $type = filter_input(INPUT_POST, 'SearchRange');
                $Min = filter_input(INPUT_POST, 'Min', FILTER_VALIDATE_INT);
                $Max = filter_input(INPUT_POST, 'Max', FILTER_VALIDATE_INT);
                $Val1 = ($Min) ? $Min : 0;
                $Val2 = ($Max) ? $Max : 0;
                $idArray = searchQueryRange($type, $Val1, $Val2);
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