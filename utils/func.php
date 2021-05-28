<?php
class Recipe
{
    private $id = 0;
    private $name = "";
    private $description = "";
    private $calories = 0;
    private $difficulty = 0;
    private $rating = 0;
    private $timeToPrep = 0;
    private $timeToCook = 0;
    private $tag = [""];
    private $class = [""];
    private $image = [""];
    private $ingredient = [[0, "", ""]];
    private $steps = [["", ""]];

    public function __construct(
        $id,
        $name,
        $description,
        $calories,
        $difficulty,
        $rating,
        $timeToPrep,
        $timeToCook,
        $tag,
        $class,
        $image,
        $ingredient,
        $steps
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->calories = $calories;
        $this->difficulty = $difficulty;
        $this->rating = $rating;
        $this->timeToPrep = $timeToPrep;
        $this->timeToCook = $timeToCook;
        $this->tag = $tag;
        $this->class = $class;
        $this->image = $image;
        $this->ingredient = $ingredient;
        $this->steps = $steps;
    }

    public function CardBox()
    {
        $id = $this->id;
        $nm = $this->name;
        $pic = $this->image[0];
        $stars = $this->StarRank();

        return <<<EOD
        <a href="./recipe?id=$id" class="card recipe-card h-100 text-decoration-none link-dark" id="recipe-$id">
            <img src="./images/$pic" class="card-img-top w-100" alt="$nm">
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
                range(0, 4),
                range(0, 4)
            )
        ) . "</div>";
    }
    public function DifficultyRank()
    {
        $difficulty = $this->difficulty;
        $level = "easy";
        $level = ($difficulty <= 3) ? "Easy" : (($difficulty <= 7) ? "Normal" : "Challenging");
        return "<div class='row rounded'>"
            . implode(
                "",
                array_map(
                    function ($val, $keys) use ($difficulty) {
                        $cls =
                            ($difficulty >= $keys + 1 && $keys <= 3 - 1) ?
                            'bg-success' : //green bar
                            (($difficulty >= $keys + 1 && $keys >= 3 - 1  && 8 - 1 <= $keys) ?
                                "bg-danger" : // 
                                (($difficulty >= $keys + 1) ? "bg-warning" : 'bg-light'));
                        return  "<div class='border col $cls border-dark' style='height: 1rem'></div>";
                    },
                    range(0, 9),
                    range(0, 9)
                )
            )
            . "</div>"
            . "<h4 class='text-muted'>Difficulty = $level</h4>";
    }

    // printers
    public function ImagePrint()
    {
        $img = $this->image;

        $imgtxt = implode("", array_map(function ($currImg, $ind) {
            $isActive = ($ind === 0) ? "active" : "";
            return <<<EOD
            <div class="carousel-item $isActive">
                <img src="./images/$currImg" class="d-block w-100" alt="">
            </div>
            EOD;
        }, $img, array_keys($img)));

        $imgButtons = implode("", array_map(function ($ind) {
            $isActive = ($ind === 0) ? 'class="active" aria-current="true"' : "";
            $slidenum = $ind + 1;
            return <<<EOD
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="$ind" aria-label="Slide $slidenum" $isActive></button>
            EOD;
        }, array_keys($img)));

        return <<<EOD
            <div class="col-auto rounded justify-content-center align-items-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        $imgButtons
                    </div>
                    <div class="carousel-inner">
                        $imgtxt
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        EOD;
    }
    public function ingredientPrint()
    {
        $ing = $this->ingredient;
        $ingCnt = sizeof($ing);

        $ingTxt = implode("", array_map(function ($foo) {
            $amount = $foo['amount'];
            $unit = $foo['unit'];
            $name = $foo['name'];
            return <<<EOD
                <div class="form-check form-check-inline w-100">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    <span>$amount $unit $name</span>
                    </label>
                </div>
                <hr class='w-auto'>
            EOD;
        }, $ing));

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
        $tag = $this->tag;
        $class = $this->class;

        $tagTxt = implode("\n", array_map(function ($foo) {
            return '<a class="btn btn-primary my-2 recipe-tag rounded-pill border-0" href="./?tag=' . $foo . '" role="button">' . $foo . '</a>';
        }, $tag));

        $classTxt = implode("\n", array_map(function ($foo) {
            return '<a class="btn btn-success my-2 recipe-class rounded-pill border-0" href="./?class=' . $foo . '" role="button">' . $foo . '</a>';
        }, $class));

        echo <<<EOD
            <div>
                <h3>Classes & Tags</h3>
                <div>
                    $tagTxt
                    $classTxt
                </div>
            </div>
        EOD;
    }
    public function infoPrint()
    {
        $img = $this->ImagePrint();
        $nm = $this->name;
        $desc = $this->description;
        $details = [$this->timeToCook . " mins", ($this->timeToCook + $this->timeToPrep) . " mins", $this->calories . " kj"];
        $stars = $this->StarRank();
        $difficulty = $this->DifficultyRank();

        $detailsTxt = implode("", array_map(function ($foo, $bar) {
            return <<<EOD
                <div class="col-4">
                    <i class="$bar[0]"></i>
                    <h4>$bar[1]</h4>
                    <h6 class="text-muted">$foo</h6>
                </div>
            EOD;
        }, $details, [["far fa-clock", "Active Time"], ["fas fa-history", "Total Time"], ["far fa-heart", "Calories"]]));

        echo <<<EOD
            $img
            <div class="col-auto pt-3 d-flex justify-content-center align-items-center text-center">
                <div>
                    <h1>$nm</h1>
                    <p>$desc</p>
                    $stars
                    <hr class="w-100">
                    <div class="row w-100 text-center">
                    $detailsTxt
                    </div>
                    <hr class="w-100">
                    $difficulty
                </div>
            </div>
        EOD;
    }
    public function stepPrint()
    {
        $stepsArr = $this->steps;
        $stepsArrTxt = implode(
            "\n",
            array_map(function ($foo, $bar) {
                $i = $bar + 1;
                $desc = $foo['description'];
                $imageurl = $foo['stepPicture'];
                return <<<EOD
                    <div class="form-check form-check-inline w-100">
                        <input class="form-check-input" type="checkbox" id="chkStep$i">
                        <label class="form-check-label" for="chkStep$i">STEP $i</label>
                        <div class="row">
                            <div class="col">
                                <p>$desc</p>
                            </div>
                            <div class="col-sm-none col-md-3">
                                <img src="./images/$imageurl" class="d-block w-100" alt="">
                            </div>
                        </div>
                    </div>
                    <hr class="w-auto">
                EOD;
            }, $stepsArr, array_keys($stepsArr))
        );

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
        return $this->name;
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
