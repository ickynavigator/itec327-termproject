<?php
class Recipe
{
    private $Recipeid = "";
    private $RecipeName = 0;
    private $rating = 0;
    private $keywords = [""];
    private $description = "";
    private $pictures = [];
    function __construct($Recipeid, $RecipeName, $keywords, $description, $pictures, $rating)
    {
        $this->Recipeid = $Recipeid;
        $this->RecipeName = $RecipeName;
        $this->keywords = $keywords;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->rating = $rating;
    }
    function SideBox()
    {
        $id = $this->Recipeid;
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $desc = $this->description;
        $keyWord = implode(", ", $this->keywords);

        // echo <<<EOD
        // <div class="sidebar-box" id="recipe-${id}">
        //     <h1 id="title">${nm}</h1>
        //     <img id="image" src="${pic}" alt="${nm}">
        //     <p id="description">${keyWord}</p>
        //     <p id="description">${desc}</p>
        // </div>
        // EOD;

        echo <<<EOD
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="${pic}" alt="${nm}" style="max-height: inherit; max-width: inherit;">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">${nm}</h5>
                    <p class="card-text">${desc}</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </p>
                </div>
                </div>
            </div>
        </div>
        EOD;
    }
    function StarRank()
    {
        // echo "\n\t<div>\n\t\t";
        // echo implode("\n\t\t", starClasses($this->rating));
        // echo "\n\t</div>\n";
        return "<div>" . implode("", starClasses($this->rating)) . "</div>";
    }
    function CardBox()
    {
        $id = $this->Recipeid;
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $desc = $this->description;
        $keyWord = implode(", ", $this->keywords);
        $stars = $this->StarRank();


        // echo <<<EOD
        // <div class="card" style="width: 18rem;" id="recipe-${id}">
        //     <img src="${pic}" class="card-img-top" alt="${nm}">
        //     <div class="card-header">${keyWord}</div>
        //     <h5 class="card-title">${nm}</h5>
        //     <div class="card-body">
        //         <p class="card-text">${desc}</p>
        //         <a href="./recipe/${id}" class="btn btn-primary">View Recipe</a>
        //     </div>
        // </div>
        // EOD;

        // <a href="#" class="btn btn-primary">Go somewhere</a>
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
}

function starClasses($foo, $full = false)
{
    return array_map(function ($val, $keys) use ($foo, $full) {
        $cls =
            (($foo >= $keys + 1) ? 'fas fa-star' : //full star
                (($foo >= $keys + .5) ? 'fas fa-star-half-alt' : //half star
                    'far fa-star')); //empty star
        return ($full != false) ? "$cls" : "<i class='$cls' style='color: #FFD700;'></i>";
    }, range(1, 5), range(1, 5));
}

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

<?php
$rec1 = new Recipe("1", "first", ["one", "first"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"], 3);
$rec2 = new Recipe("2", "second", ["two", "second"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"], 5);
$rec3 = new Recipe("3", "third", ["three", "third"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"], 2.5);
$recipeCategory = [
    ["Dish Type", ["Appetizers & Snacks", "Bread Recipes", "Cake Recipes", "Candy and Fudge", "Casserole Recipes", "Christmas Cookies", "Cocktail Recipes", "Main Dishes", "Pasta Recipes", "Pie Recipes", "Sandwiches"]],
    ["Meal Type", ["Breakfast and Brunch", "Desserts", "Dinners", "Lunch"]],
    ["Diet and Health", ["Diabetic", "Gluten Free", "High Fiber Recipes", "Low Calorie"]],
    ["World Cuisine", ["Chinese", "Indian", "Italian", "Mexican"]],
    ["Seasonal", ["Baby Shower", "Birthday", "Christmas", "Halloween"]]
];
?>
<!--  -->