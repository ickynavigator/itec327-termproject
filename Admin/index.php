<?php
include("../utils/config.php");
include("./utils/session.php");
include("../utils/func.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Admin Page";
    $pageName = "admin";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <table class="table table-hover">
        <?php
        $columns = array('id', 'name', 'calories', 'difficulty', 'rating');
        $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

        if ($res = $conn->query("SELECT * FROM `recipes` ORDER BY $column $sort_order;")) {
            $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
            $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
        ?>
            <thead>
                <tr>
                    <th><a scope="col" href="<?php echo $CURR_URL ?>?column=id&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a scope="col" href="<?php echo $CURR_URL ?>?column=name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a scope="col" href="<?php echo $CURR_URL ?>?column=calories&order=<?php echo $asc_or_desc; ?>">Calories<i class="fas fa-sort<?php echo $column == 'calories' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a scope="col" href="<?php echo $CURR_URL ?>?column=difficulty&order=<?php echo $asc_or_desc; ?>">Difficulty<i class="fas fa-sort<?php echo $column == 'difficulty' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a scope="col" href="<?php echo $CURR_URL ?>?column=rating&order=<?php echo $asc_or_desc; ?>">Rating<i class="fas fa-sort<?php echo $column == 'rating' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a scope="col"></a></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $res->fetch_assoc()) { ?>
                    <tr>
                        <td <?php echo $column == 'id' ? $add_class : ''; ?>>
                            <?php echo $row['id']; ?>
                        </td>
                        <td <?php echo $column == 'name' ? $add_class : ''; ?>>
                            <?php echo $row['name']; ?>
                        </td>
                        <td <?php echo $column == 'calories' ? $add_class : ''; ?>>
                            <?php echo $row['calories']; ?>
                        </td>
                        <td <?php echo $column == 'difficulty' ? $add_class : ''; ?>>
                            <?php echo $row['difficulty']; ?>
                        </td>
                        <td <?php echo $column == 'rating' ? $add_class : ''; ?>>
                            <?php echo $row['rating']; ?>
                        </td>
                        <td colspan="2">
                            <a href="./Admin/Recipe?id=<?php echo $row['id'] ?>" class="btn btn-primary">View</a>
                            <a href="./Admin/utils/deleteRecipe?id=<?php echo $row['id'] ?>" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>
    <?php include("../utils/footer.php"); ?>
</body>

</html>