<?php
function navPrint($currPage, $navArr, $dropArr)
{
    // pageName
    // [...["page Name", "Page Title", "url"]] : navArr
    // [...["DropDown Title", "url"]] : dropArr
    foreach ($navArr as $val) {
        $activeStr = ($currPage == $val[0]) ? ' active" aria-current="page' : '';
        echo <<<EOD
            <li class="nav-item">
                <a class="nav-link ${activeStr}" href="$val[2]">$val[1]</a>
            </li>
        EOD;
    }

    // echo <<<EOD
    //     <li class="nav-item dropdown">
    //         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown link</a>
    //         <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    // EOD;
    // foreach ($dropArr as $val) {
    //     echo "<li><a class='dropdown-item' href='$val[1]'>$val[0]</a></li>";
    // }
    // echo <<<EOD
    //         </ul>
    //     </li>
    // EOD;
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-body">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src="./images/fox.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Fox Recipe's
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php
                navPrint(
                    $pageName,
                    [
                        ["home", "Home",  "./index.php"],
                        ["search", "Search",  "./search.php"],
                        ["contact", "Contact Us",  "./contact.php"]
                    ],
                    [
                        ["Action", "#"],
                        ["Another action", "#"],
                        ["Something else here", "#"]
                    ]
                );
                ?>
            </ul>
        </div>

    </div>
</nav>
<div class="main-div container-fluid py-3">