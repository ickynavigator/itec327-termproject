<?php
$recipeCategory = [
    ["Dish Type", ["Appetizers & Snacks", "Bread Recipes", "Cake Recipes", "Candy and Fudge", "Casserole Recipes", "Christmas Cookies", "Cocktail Recipes", "Main Dishes", "Pasta Recipes", "Pie Recipes", "Sandwiches"]],
    ["Meal Type", ["Breakfast and Brunch", "Desserts", "Dinners", "Lunch"]],
    ["Diet and Health", ["Diabetic", "Gluten Free", "High Fiber Recipes", "Low Calorie"]],
    ["World Cuisine", ["Chinese", "Indian", "Italian", "Mexican"]],
    ["Seasonal", ["Baby Shower", "Birthday", "Christmas", "Halloween"]]
];
$dummy = "Labour, of evaluated would he the a the our what is in the arduous sides behavioural is which the have didn't kicked records the it framework by the for traveler sure the can most well her. Entered have break himself cheek, and activity, for bit of text.";


$sampleRecipe = new Recipe(
    "1",
    "White calzones with marinara sauce",
    ["Dinner", "Casserole", "Party", "Meat"],
    "Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.",
    ["./images/sample.jpeg"],
    3,
    ["1 pound fresh prepared pizza dough", "6 ounces shredded mozzarella cheese", "3/4 cup of ricotta cheese", "1 large egg yolk", "1/2 teaspoon lemon zest", "2 finely grated garlic cloves", "1/2 teaspoon kosher salt", "1/4 teaspoon black pepper", "1 large egg", "1 teaspoon dried Italian seasoning"],
    [$dummy, $dummy, $dummy, $dummy, $dummy],
    20,
    50,
    4
);
?>

<?php
class Recipe
{
    private $Recipeid = "";
    public $RecipeName = "";
    private $keywords = [""];
    private $description = "";
    private $pictures = [];
    private $rating = 0;
    private $ingredients = [];
    private $steps = [];
    private $ActiveTime = 0;
    private $TotalTime = 0;
    private $Yield = 0;

    function __construct(
        $Recipeid,
        $RecipeName,
        $keywords,
        $description,
        $pictures,
        $rating,
        $ingredients,
        $steps,
        $ActiveTime,
        $TotalTime,
        $Yield
    ) {
        $this->Recipeid = $Recipeid;
        $this->RecipeName = $RecipeName;
        $this->keywords = $keywords;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->rating = $rating;
        $this->ingredients = $ingredients;
        $this->steps = $steps;
        $this->ActiveTime = $ActiveTime;
        $this->TotalTime = $TotalTime;
        $this->Yield = $Yield;
    }

    function CardBox()
    {
        $id = $this->Recipeid;
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $stars = $this->StarRank();

        echo <<<EOD
        <a href="./recipe.php" class="card recipe-card py-3" id="recipe-$id">
            <!-- <img src="$pic" class="card-img-top" alt="$nm"> -->
            <img src="" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">$nm</h5>
                <!--$stars-->
            </div>
        </a>
        EOD;
    }
    function StarRank()
    {
        $stars = $this->rating;

        return "<div>" . implode(
            "",
            array_map(
                function ($val, $keys) use ($stars) {
                    $cls =
                        (($stars >= $keys + 1) ? 'fas fa-star' : //full star
                            (($stars >= $keys + .5) ? 'fas fa-star-half-alt' : //half star
                                'far fa-star')); //empty star
                    return  "<i class='$cls' style='color: #FFD700;'></i>";
                },
                range(1, 5),
                range(1, 5)
            )
        ) . "</div>";
    }

    // printers
    function ingredientPrint()
    {
        $ing = $this->ingredients;
        $ingCnt = sizeof($ing);

        $ingTxt = implode("", array_map(function ($foo, $i) use ($ingCnt) {
            $bar = ($i != $ingCnt - 1) ? "<hr class='w-auto'>" : "";
            return <<<EOD
                <div class="form-check form-check-inline w-100">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    <span>$foo</span>
                    </label>
                </div>
                $bar
            EOD;
        }, $ing, array_keys($ing)));

        echo <<<EOD
            <div class="pb-3">
                <h3>Ingredients</h3>
                <hr class="w-auto">
                <div>
                    $ingTxt
                </div>
            </div>
        EOD;
    }
    function tagPrint()
    {
        $tag = $this->keywords;

        $tagTxt = implode("\n", array_map(function ($foo) {
            return '<a class="btn btn-primary my-2" href="#" role="button">' . $foo . '</a>';
        }, $tag));

        echo <<<EOD
            <div>
                <h3>Tags</h3>
                <div>
                    $tagTxt
                </div>
            </div>
        EOD;
    }
    function infoPrint()
    {
        $img = $this->picture[0];
        $nm = $this->RecipeName;
        $desc = $this->description;
        $timeArr = [$this->ActiveTime . " mins", $this->TotalTime . " mins", "Serves " . $this->Yield];
        $stars = $this->StarRank();

        $timetxt = implode("", array_map(function ($foo, $bar) {
            return <<<EOD
                <div class="col-4">
                    <i class="$bar[0]"></i>
                    <h4>$bar[1]</h4>
                    <h6 class="text-muted">$foo</h6>
                </div>
            EOD;
        }, $timeArr, [["far fa-clock", "Active Time"], ["fas fa-history", "Total Time"], ["fas fa-user-friends", "Yield"]]));

        echo <<<EOD
            <div class="col-auto d-flex justify-content-center align-items-center">
                <div class="test-image"></div>
                <!-- <img src="$img" alt="$nm"> -->
            </div>
            <div class="col-auto pt-3 d-flex justify-content-center align-items-center text-center">
                <div>
                    <h1>$nm</h1>
                    <p>$desc</p>
                    $stars
                    <hr class="w-100">
                    <div class="row w-100 text-center">
                        $timetxt
                    </div>
                    <hr class="w-100">
                </div>
            </div>
        EOD;
    }
    function stepPrint()
    {
        $stepsArr = $this->steps;
        $stepsArrTxt = implode("\n", array_map(function ($foo, $bar) {
            $i = $bar + 1;
            return <<<EOD
                <div class="form-check form-check-inline w-100">
                    <input class="form-check-input" type="checkbox" id="chkStep$i">
                    <label class="form-check-label" for="chkStep$i">$i. STEP</label>
                    <p>$foo</p>
                </div>
                <hr class="w-auto">
            EOD;
        }, $stepsArr, array_keys($stepsArr)));

        echo <<<EOD
            <h3>How to Make It</h3>
            <div>
                <hr class='w-auto'>
                $stepsArrTxt
            </div>
        EOD;
    }

    // getters
    function getName()
    {
        return $this->RecipeName;
    }
}


// functions
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
function IconPrint($arr)
{
    // [...["icon Name", "icon class", "icon link"]] : arr
    foreach ($arr as $val) {
        echo <<<EOD
        <div class="col smicon smicon-$val[0] rounded-pill d-inline-flex mx-1">
            <a href="$val[2]" class="d-inline-flex">
                <i class="$val[1]"></i>
            </a>
        </div>
        EOD;
    }
}
?>
