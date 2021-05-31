<?php
include("../utils/config.php");
include("../utils/func.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Search";
    $pageName = "search";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <div class="container main-div">
        <?php include("../utils/searchbar.php"); ?>
        <div class="row row-cols-sm-2 row-cols-md-4 mt-1 g-2 g-lg-3">
            <?php
            $query = <<<EOD
            SELECT  *
            FROM    `recipes`
            EOD;
            if (isset($_POST['sbmtSearch'])) {
                $type = filter_input(INPUT_POST, 'SearchType');
                $search = filter_input(INPUT_POST, 'Search');
                if ($type === "name" || $type === "tag" || $type === "class") {
                    $query = <<<EOD
                    SELECT  *
                    FROM    `recipes`
                    WHERE   lower(`$type`) LIKE lower('%$search%')
                    EOD;
                } else {
                    $query = <<<EOD
                    SELECT  *
                    FROM    `recipes`
                    WHERE   JSON_SEARCH(`$type`, 'all', '%$search%', NULL, '$[*].$name') IS NOT NULL
                    EOD;
                }
            }

            if (isset($_POST['sbmtRange'])) {
                $type = filter_input(INPUT_POST, 'SearchRange');
                $Min = filter_input(INPUT_POST, 'Min', FILTER_VALIDATE_INT);
                $Max = filter_input(INPUT_POST, 'Max', FILTER_VALIDATE_INT);
                $Val1 = ($Min) ? $Min : 0;
                $Val2 = ($Max) ? $Max : 0;

                $minVal = ($Val1 > 0) ? $Val1 : "(SELECT MIN(`$type`))";
                $maxVal = ($Val2 > 0) ? $Val2 : "(SELECT MAX(`$type`))";

                $query = <<<EOD
                    SELECT  *
                    FROM    `recipes`
                    WHERE   `$type` BETWEEN $minVal AND $maxVal
                EOD;
            }
            ?>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Calories</th>
                    <th>Difficulty</th>
                    <th>Rating</th>
                    <th><a scope="col"></a></th>
                </tr>
            </thead>
            <?php if ($res = $conn->query($query)) { ?>
                <tbody>
                    <?php while ($row = $res->fetch_assoc()) { ?>
                        <tr>
                            <th scope="col"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['calories']; ?></td>
                            <td><?php echo $row['difficulty']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td colspan="2">
                                <a href="./Admin/Recipe?id=<?php echo $row['id'] ?>" class="btn btn-primary">View</a>
                                <a href="./Admin/deleteRecipe?id=<?php echo $row['id'] ?>" class="btn btn-primary">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else { ?>
                <div class='h-100 w-100 d-flex align-items-center'>
                    <h1>No Recipes meet the specified criteria</h1>
                </div>
            <?php } ?>
        </table>
    </div>
    <?php include("../utils/footer.php"); ?>
</body>

</html>