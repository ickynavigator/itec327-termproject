<form class="d-flex search-bar rounded" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="input-group search-div">
        <span class="input-group-text search-icon" id="basic-addon1">
            <i class="fas fa-search"></i>
        </span>
        <span class="input-group-text">
            <select class="form-select" name="SearchType">
                <option value="name">Name</option>
                <option value="tag">Tag</option>
                <option value="class">Class</option>
                <option value="ingredient">Ingredients</option>
            </select>
        </span>
        <input class="form-control search-text" type="text" placeholder="Search" aria-label="Search" name="Search" id="Search" required pattern=".{3,}" title="At least 3 characters">
        <button class="btn search-btn" type="submit" name="sbmtSearch">
            Search
        </button>
    </div>
</form>
<form class="d-flex search-bar rounded mt-3" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="input-group search-div">
        <span class="input-group-text search-icon" id="basic-addon1">
            <i class="fas fa-search"></i>
        </span>
        <span class="input-group-text">
            <select class="form-select" name="SearchRange">
                <option value="calories">Calories</option>
                <option value="difficulty">Difficulty</option>
                <option value="rating">Rating</option>
            </select>
        </span>
        <input class="form-control search-text" type="number" placeholder="Min Value" aria-label="Min" name="Min" id="Min">
        <input class="form-control search-text" type="number" placeholder="Max Value" aria-label="Max" name="Max" id="Max">
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