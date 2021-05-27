<form class="d-flex search-bar" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
        <input class="form-control me-2 search-text" type="search" placeholder="Search" aria-label="Search" name="Search" id="Search">
        <button class="btn search-btn" type="submit" name="sbmt">
            Search
        </button>
    </div>
</form>