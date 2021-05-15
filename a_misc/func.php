<?php

class Recipe
{
    private $Recipeid = "";
    private $RecipeName = 0;
    private $ranking = 0;
    private $keywords = [""];
    private $description = "";
    private $pictures = [];
    function __construct($Recipeid, $RecipeName, $keywords, $description, $pictures, $ranking)
    {
        $this->Recipeid = $Recipeid;
        $this->RecipeName = $RecipeName;
        $this->keywords = $keywords;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->ranking = $ranking;
    }
    function SideBox()
    {
        $id = $this->Recipeid;
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $desc = $this->description;
        $keyWord = implode(", ", $this->keywords);

        echo <<<EOD
        <div class="sidebar-box" id="recipe-${id}">
            <h1 id="title">${nm}</h1>
            <img id="image" src="${pic}" alt="${nm}">
            <p id="description">${keyWord}</p>
            <p id="description">${desc}</p>
        </div>
        EOD;
    }
    function RecipePrintCard()
    {
        $nm = $this->RecipeName;
        $pic = $this->pictures[0];
        $ranking = $this->ranking;
        $keyWord = implode(", ", $this->keywords);
        echo <<<EOD
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <h5 class="card-header">$keyWord</h5>
                <div class="card-body">
                    <h5 class="card-title">$nm</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        EOD;
    }
}

$rec1 = new Recipe("1", "first", ["one", "first"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"]);
$rec2 = new Recipe("2", "second", ["two", "second"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"]);
$rec3 = new Recipe("3", "third", ["three", "third"], "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, corporis!", ["./images/sample.jpeg"]);
?>
<!--  -->