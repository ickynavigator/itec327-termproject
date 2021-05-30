<form class="d-block d-md-flex search-bar rounded" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select class="form-select SearchType" name="SearchType">
        <option value="name">Name</option>
        <option value="tag">Tag</option>
        <option value="class">Class</option>
        <option value="ingredient">Ingredients</option>
    </select>
    <div class="input-group search-div">
        <span class="input-group-text search-icon" id="basic-addon1">
            <i class="fas fa-search"></i>
        </span>
        <input class="form-control search-text" type="text" placeholder="Search" aria-label="Search" name="Search" id="Search" required pattern=".{3,}" title="At least 3 characters">
        <button class="btn search-btn" type="submit" name="sbmtSearch">
            Search
        </button>
    </div>
</form>
<form class="d-block d-md-flex search-bar rounded mt-3" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select class="form-select SearchRange" name="SearchRange" id="SearchRange">
        <option value="calories">Calories </option>
        <option value="difficulty">Difficulty</option>
        <option value="rating">Rating</option>
    </select>
    <div class="input-group search-div">
        <input class="form-control search-text" type="number" placeholder="Min Value" aria-label="Min" name="Min" id="MinINP" min=0 value=0 required title="Minimum Value">
        <input class="form-control search-text" type="number" placeholder="Max Value" aria-label="Max" name="Max" id="MaxINP" min=0 value=0 required title="Maximum Value">
        <button class="btn search-btn" type="submit" name="sbmtRange">
            Search
        </button>
    </div>
</form>
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

<script>
    const minInp = document.getElementById("MinINP")
    const maxInp = document.getElementById("MaxINP")
    const SearchRange = document.getElementById("SearchRange")
    minInp.addEventListener(
        "input",
        function(e) {
            const num = Number(e.target.value) + 1;
            maxInp.min = num;
            maxInp.value = num;
        }
    )
    SearchRange.addEventListener(
        "change",
        function(e) {
            switch (e.target.value) {
                case "calories":
                    maxInp.removeAttribute("max")
                    break;
                case "rating":
                    maxInp.max = 5
                    break;
                case "difficulty":
                    maxInp.max = 10
                    break;
                default:
                    break;
            }
        }
    )
</script>