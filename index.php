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
    <div class="banner d-flex p-3 mt-md-0 my-md-auto">
        <div class="banner-text text-light p-sm-3 p-md-0 my-md-auto mx-md-0">
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
            <a href="./addRecipe" class="text-light">Add a recipe today <i class="fas fa-arrow-right"></i></a>
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
                <div class="row row-cols-2 row-cols-md-4 g-1 g-md-3 mt-1 h-100">
                    <?php
                    parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $params);
                    if (!empty($params)) {
                        $key = array_keys($params)[0];
                        $pgNo = array_keys($params)['pageNo'];
                        $idArr = searchQuery($key, $params[$key], $pgNo)[0];
                        if ($idArr !== "error") {
                            foreach (recipesArray($idArr) as $val) {
                                echo "<div class='col d-inline'>" . $val->CardBox() . "</div>";
                            }
                        } else {
                            echo "<div class='h-100 w-100 d-flex align-items-center'><h1>No Recipes meet the specified criteria</h1></div>";
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
        <div class="newsBox container d-flex flex-column text-center justify-content-center align-items-center">
            <h2 class="newsText text-light py-3 px-0">
                Be the first to know about the latest deals, receive new trending recipes & more!
            </h2>
            <form class="container-fluid row newsInput" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="col-lg-9 py-3">
                    <label for="inputEmail" class="visually-hidden">Email</label>
                    <input type="email" class="form-control rounded-pill" id="inputEmail" name="inputEmail" placeholder="Email">
                </div>
                <div class="col-md-3 py-3">
                    <input type="submit" name="sbmt" value="Subscribe" class="btn rounded-pill bg-light">
                </div>
            </form>
            <?php
            if (isset($_REQUEST['sbmt'])) {
                $email = filter_input(INPUT_POST, 'inputEmail', FILTER_VALIDATE_EMAIL);

                if ($email) {
                    echo "<h1 class='text-center text-light'>";
                    if (newNewsletter($email)) {
                        echo "Email added";
                    } else {
                        echo "Email not added";
                    }
                    echo "</h1>";
                    // $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
                    // header("Location: $url");
                }
            }
            ?>
        </div>
    </div>
    <?php
    include("./utils/footer.php");
    ?>
</body>

</html>