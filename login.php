<?php include("./utils/config.php"); ?>
<?php include("./utils/func.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Login";
    $pageName = "login";
    include("./utils/headtag.php");
    ?>
</head>

<body>
    <div class="main-div container py-3 h-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col leftDiv px-5">
                    <form class="text-center px-5">
                        <a class="navbar-brand" href="./index.php">
                            <img src="./images/fox.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            Fox Recipe's
                        </a>
                        <h3 class="my-5">Sign In</h3>
                        <div class="my-5">
                            <label for="mailInp" class="form-label">Email</label>
                            <input type="email" class="form-control rounded-pill text-center" id="mailInp" placeholder="Enter Email">
                        </div>
                        <div class="my-5">
                            <label for="passInp" class="form-label">Password</label>
                            <input type="password" class="form-control rounded-pill text-center" id="passInp" placeholder="Enter Password">
                        </div>
                        <div class="my-5">
                            <input type="submit" class="btn btn-primary py-2 px-5 rounded-pill" value="Login">
                        </div>
                    </form>
                </div>
                <div class="col rightDiv d-none d-lg-flex justify-content-center align-items-center">
                    <div class="p-4">
                        <div class="my-5 text-center">
                            <h3>Hello There, Join Us</h3>
                        </div>
                        <div class="my-5 px-5 text-center">
                            <p>Enter your personal details and join the cooking community</p>
                        </div>
                        <div class="my-5 text-center">
                            <a href="./signup.php">
                                <button type="button" class="btn rounded-pill px-4 py-2">
                                    Sign Up
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>