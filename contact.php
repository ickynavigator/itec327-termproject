<?php
include("./utils/config.php");
include("./utils/func.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Contact Us";
    $pageName = "contact";
    include("./utils/headtag.php"); ?>
</head>

<body>
    <?php include("./utils/navbar.php"); ?>
    <div class="row">
        <div class="col mx-3 py-2 leftDiv align-items-center row">
            <div>
                <h1>
                    Hello, what's on your mind?
                </h1>
                <br />
                <p>
                    Credibly administrate market positioning deliverables rather than clicks-and-mortar methodologies. Proactively formulate out-of-the-box technology with clicks-and-mortar testing procedures. Uniquely promote leveraged web-readiness for standards compliant value. Rapidiously pontificate cooperative mindshare via maintainable applications.
                </p>
                <br />
                <a href="tel:+905338604139">
                    <button type="button" class="btn rounded-pill px-4 py-2">
                        Schedule a call
                    </button>
                </a>
            </div>
        </div>
        <div class="col rightDiv mx-3 mt-5 mt-md-0 py-sm-3 py-md-4">
            <form class="container-fluid" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="my-3">
                    <label for="nameInp" class="form-label">Name</label>
                    <input type="text" class="form-control rounded-pill" id="nameInp" name="nameInp">
                </div>
                <div class="my-3">
                    <label for="emailInp" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-pill" id="emailInp" name="emailInp">
                </div>
                <div class="my-3">
                    <label for="messageInp" class="form-label">Message</label>
                    <textarea class="form-control" id="messageInp" name="messageInp" rows="5"></textarea>
                </div>
                <div class="my-3 text-center">
                    <input type="submit" class="rounded-pill px-4 py-2 btn" name="sbmt" value="Send Message">
                </div>
            </form>
            <?php
            if (isset($_REQUEST['sbmt'])) {
                $name = filter_input(INPUT_POST, 'nameInp');
                $email = filter_input(INPUT_POST, 'emailInp', FILTER_VALIDATE_EMAIL);
                $message = filter_input(INPUT_POST, 'messageInp');

                if ($name && $email && $message) {
                    echo "<h1 class='text-center'>";
                    if (newContactMessage($name, $email, $message)) {
                        echo "Message sent";
                    } else {
                        echo "Message not sent";
                    }
                    echo "</h1>";
                    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
                    header("Location: $url");
                }
            }
            ?>
        </div>
    </div>
    <?php include("./utils/footer.php"); ?>
</body>

</html>