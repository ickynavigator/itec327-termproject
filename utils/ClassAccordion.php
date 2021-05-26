<?php
$recipeCategory = [
    ["Dish Type", ["Appetizers", "Snacks", "Bread", "Cake", "Candy", "Fudge", "Casserole", "Cookies", "Cocktail", "Pasta", "Pie", "Sandwiches"]],
    ["Protein Type", ["Beef", "Poultry", "Pork", "Seafood", "Vegetarian", "Other"]],
    ["Meal Type", ["Breakfast", "Brunch", "Desserts", "Dinners", "Lunch"]],
    ["Diet and Health", ["Diabetic", "GlutenFree", "Fibrous", "LowCal"]],
    ["World Cuisine", ["Chinese", "Indian", "Italian", "Mexican"]],
    ["Seasonal", ["Baby", "Birthday", "Christmas", "Halloween"]]
];
function AccordionConst($arr)
{
    $currPage = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
    foreach ($arr as $num => $val) {
        $str = implode("\n", array_map(function ($foo) use ($currPage) {
            $link = "$currPage?class=$foo";
            return '<li class="accordion-link"><a href="' . $link . '">' . $foo . '</a></li>';
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

// Breakfast
// Lunch
// Beverages
// Appetizers
// Soups
// Salads
// Main dishes: Beef
// Main dishes: Poultry
// Main dishes: Pork
// Main dishes: Seafood
// Main dishes: Vegetarian
// Side dishes: Vegetables
// Side dishes: Other
// Desserts
// Canning / Freezing
// Breads
// Holidays
// Entertaining
