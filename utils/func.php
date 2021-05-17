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
    3,
    "Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.",
    ["./images/sample.jpeg"],
    [[1, "pound fresh prepared pizza dough"], [6, "ounces shredded mozzarella cheese"], [3 / 4, "cup of ricotta cheese"], [1, "large egg yolk"], [1 / 2, "teaspoon lemon zest"], [2, "finely grated garlic cloves"], [1 / 2, "teaspoon kosher salt"], [1 / 4, "teaspoon black pepper"], [1, "large egg"], [1, "teaspoon dried Italian seasoning"]],
    [$dummy, $dummy, $dummy, $dummy, $dummy],
    20,
    30,
    4
);
?>

<?php
class Recipe
{
    private $Recipeid = "";
    private $RecipeName = "";
    private $keywords = [""];
    private $rating = 0;
    private $description = "";
    private $cookTime = 0;
    private $prepTime = 0;
    private $serving = 0;
    private $steps = [""];

    private $ingredients = [[0, ""]];
    private $pictures = [];

    public function __construct(
        $Recipeid,
        $RecipeName,
        $keywords,
        $rating,
        $description,
        $pictures,
        $ingredients,
        $steps,
        $prepTime,
        $cookTime,
        $serving
    ) {
        $this->Recipeid = $Recipeid;
        $this->RecipeName = $RecipeName;
        $this->keywords = $keywords;
        $this->rating = $rating;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->ingredients = $ingredients;
        $this->steps = $steps;
        $this->prepTime = $prepTime;
        $this->cookTime = $cookTime;
        $this->serving = $serving;
    }

    public function CardBox()
    {
        $id = $this->Recipeid;
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $stars = $this->StarRank();

        // <img src="" class="card-img-top" alt="">
        echo <<<EOD
        <a href="./recipe?id=$id" class="card recipe-card py-3" id="recipe-$id">
            <img src="$pic" class="card-img-top" alt="$nm">
            <div class="card-body">
                $stars
                <h5 class="card-title">$nm</h5>
            </div>
        </a>
        EOD;
    }
    public function StarRank()
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
    public function ingredientPrint()
    {
        $ing = $this->ingredients;
        $ingCnt = sizeof($ing);

        $ingTxt = implode("", array_map(function ($foo, $i) use ($ingCnt) {
            $bar = ($i != $ingCnt - 1) ? "<hr class='w-auto'>" : "";
            $amount = (intval($foo[0]) == $foo[0]) ? intval($foo[0]) : float2rat($foo[0]);
            $item = $foo[1];
            return <<<EOD
                <div class="form-check form-check-inline w-100">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    <span>$amount $item</span>
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
    public function tagPrint()
    {
        $tag = $this->keywords;

        $tagTxt = implode("\n", array_map(function ($foo) {
            return '<a class="btn btn-primary my-2 recipe-tag rounded-pill" href="#" role="button">' . $foo . '</a>';
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
    public function infoPrint()
    {
        $img = $this->picture[0];
        $nm = $this->RecipeName;
        $desc = $this->description;
        $timeArr = [$this->cookTime . " mins", ($this->cookTime + $this->prepTime) . " mins", "Serves " . $this->serving];
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
    public function stepPrint()
    {
        $stepsArr = $this->steps;
        $stepsArrTxt = implode("\n", array_map(function ($foo, $bar) {
            $i = $bar + 1;
            return <<<EOD
                <div class="form-check form-check-inline w-100">
                    <input class="form-check-input" type="checkbox" id="chkStep$i">
                    <label class="form-check-label" for="chkStep$i">STEP $i</label>
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
    public function getName()
    {
        return $this->RecipeName;
    }
}


// functions
function float2rat($n, $tolerance = 1.e-6)
{
    $h1 = 1;
    $h2 = 0;
    $k1 = 0;
    $k2 = 1;
    $b = 1 / $n;
    do {
        $b = 1 / $b;
        $a = floor($b);
        $aux = $h1;
        $h1 = $a * $h1 + $h2;
        $h2 = $aux;
        $aux = $k1;
        $k1 = $a * $k1 + $k2;
        $k2 = $aux;
        $b = $b - $a;
    } while (abs($n - $h1 / $k1) > $n * $tolerance);

    return "$h1/$k1";
}
?>
<!--  -->