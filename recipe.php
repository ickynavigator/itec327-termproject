<?php include("./utils/func.php"); ?>
<?php include("./utils/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $recipeName = "Food";
    $title = $recipeName;
    $pageName = "recipe";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>

    <div class="container">
        <div class="row row-cols-sm-1 row-cols-md-2 d-flex justify-content-center align-items-center">
            <div class="col-auto d-flex justify-content-center align-items-center">
                <div class="test-image"></div>
                <!-- <img src="" alt=""> -->
            </div>
            <div class="col-auto pt-3 d-flex justify-content-center align-items-center text-center">
                <div>
                    <h1>White calzones with marinara sauce</h1>
                    <p>
                        Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.
                    </p>
                    <hr class="w-100">
                    <div class="row w-100 text-center">
                        <div class="col-4">
                            <i class="far fa-clock"></i>
                            <h4>Active Time</h4>
                            <h6 class="text-muted">20 mins</h6>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-history"></i>
                            <h4>Total Time</h4>
                            <h6 class="text-muted">50 mins</h6>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-user-friends"></i>
                            <h4>Active Time</h4>
                            <h6 class="text-muted">Serves 4</h6>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <div class="row row-sm-1 row-lg-12">
            <div class="col-sm-3 mt-3">
                <div class="ingredientDiv">
                    <h3>Ingredients</h3>
                    <div class="pt-3">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1 pound fresh prepared pizza dough
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    6 ounces shredded mozzarella cheese
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    3/4 cup of ricotta cheese
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1 large egg yolk
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1/2 teaspoon lemon zest
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    2 finely grated garlic cloves
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1/2 teaspoon kosher salt
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1/4 teaspoon black pepper
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1 large egg
                                </span>
                            </label>
                        </div>
                        <hr class="w-auto">
                        <div class="form-check form-check-inline w-100">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span>
                                    1 teaspoon dried Italian seasoning
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <h3>Tags</h3>
                    <a class="btn btn-primary my-2" href="#" role="button">Dinner</a>
                    <a class="btn btn-primary my-2" href="#" role="button">Casserole</a>
                    <a class="btn btn-primary my-2" href="#" role="button">Party</a>
                    <a class="btn btn-primary my-2" href="#" role="button">Meat</a>
                </div>
            </div>

            <div class="col-sm-9 mt-3">
                <h3>How to Make It</h3>
                <div class="stepCard-container">
                    <hr class="w-auto">
                    <div class="form-check form-check-inline w-100">
                        <input class="form-check-input" type="checkbox" id="chkStep1">
                        <label class="form-check-label" for="chkStep1">1. STEP</label>
                        <p>
                            Labour, of evaluated would he the a the our what is in the arduous sides behavioural is which the have didn't kicked records the it framework by the for traveler sure the can most well her. Entered have break himself cheek, and activity, for bit of text.
                        </p>
                    </div>
                    <hr class="w-auto">
                    <div class="form-check form-check-inline w-100">
                        <input class="form-check-input" type="checkbox" id="chkStep2">
                        <label class="form-check-label" for="chkStep2">2. STEP</label>
                        <p>
                            Labour, of evaluated would he the a the our what is in the arduous sides behavioural is which the have didn't kicked records the it framework by the for traveler sure the can most well her. Entered have break himself cheek, and activity, for bit of text.
                        </p>
                    </div>
                    <hr class="w-auto">
                    <div class="form-check form-check-inline w-100">
                        <input class="form-check-input" type="checkbox" id="chkStep3">
                        <label class="form-check-label" for="chkStep3">3. STEP</label>
                        <p>
                            Labour, of evaluated would he the a the our what is in the arduous sides behavioural is which the have didn't kicked records the it framework by the for traveler sure the can most well her. Entered have break himself cheek, and activity, for bit of text.
                        </p>
                    </div>
                    <hr class="w-auto">
                    <div class="form-check form-check-inline w-100">
                        <input class="form-check-input" type="checkbox" id="chkStep4">
                        <label class="form-check-label" for="chkStep4">4. STEP</label>
                        <p>
                            Labour, of evaluated would he the a the our what is in the arduous sides behavioural is which the have didn't kicked records the it framework by the for traveler sure the can most well her. Entered have break himself cheek, and activity, for bit of text.
                        </p>
                    </div>
                    <hr class="w-auto">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 h-25 w-100">
        <h3>Other Recipes You May Like</h3>
        <div class="row row-cols-2 row-cols-md-4 g-2 g-lg-3 section">
            <?php
            for ($i = 1; $i <= 8; $i++) {
                echo "<div class='col'>";
                $rec1->Cardbox();
                echo "</div>";
            }
            ?>
        </div>
    </div>


    <?php include("./utils/footer.php"); ?>
</body>

</html>