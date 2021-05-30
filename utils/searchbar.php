<form class="d-block d-md-flex search-bar rounded" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
<form class="d-block d-md-flex search-bar rounded mt-3" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
    $url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $pgNo = ($params['pageno']) ? $params['pageno'] : 1;

    if (!isset($_GET['sbmtSearch']) || !isset($_GET['sbmtRange'])) {
        $idArray = [randomRecipeIds(20)];
        shuffle($idArray[0]);
    }

    if (isset($_GET['sbmtSearch'])) {
        $type = filter_input(INPUT_GET, 'SearchType');
        $search = filter_input(INPUT_GET, 'Search');
        if ($type === "name" || $type === "tag" || $type === "class") {
            $idArray = searchQuery($type, $search, $pgNo);
        } else {
            $idArray = searchQueryJSON($type, $search, $pgNo, "name");
        }
    }

    if (isset($_GET['sbmtRange'])) {
        $type = filter_input(INPUT_GET, 'SearchRange');
        $Min = filter_input(INPUT_GET, 'Min', FILTER_VALIDATE_INT);
        $Max = filter_input(INPUT_GET, 'Max', FILTER_VALIDATE_INT);
        $Val1 = ($Min) ? $Min : 0;
        $Val2 = ($Max) ? $Max : 0;
        $idArray = searchQueryRange($type, $pgNo, $Val1, $Val2);
    }

    if ($idArray[0] === "error") {
        echo "<div class='h-100 w-100 d-flex align-items-center'>
                <h1>No Recipes meet the specified criteria</h1>
            </div>";
    } else {
        foreach (recipesArray($idArray[0]) as $val) {
            echo "<div class='col d-inline'>" . $val->CardBox() . "</div>";
        }
        echo "<h1>" . $pgNo . $idArray[1] . "</h1>";
        echo "<div class='h-100 w-100 d-flex align-items-center'>" .
            paginate($pgNo, $idArray[1])
            . "</div>";
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