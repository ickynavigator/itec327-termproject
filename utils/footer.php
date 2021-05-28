<?php
function IconPrint($arr)
{
    // [...["icon Name", "icon class", "icon link"]] : arr
    foreach ($arr as $val) {
        echo <<<EOD
        <div class="col smicon smicon-$val[0] rounded-pill d-inline-flex mx-1 justify-content-center align-items-center">
            <a href="$val[2]" class="d-inline-flex text-center text-decoration-none">
                <i class="$val[1]"></i>
            </a>
        </div>
        EOD;
    }
}
?>
</div>
<footer class="container-fluid py-3">
    <div class="row">
        <div class="col-md-9">
            <a class="navbar-brand" href="./index.php">
                <img src="./images/fox.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Fox Recipe's
            </a>
        </div>
        <div class="col-auto row ms-lg-auto">
            <div class="row-4 float-end">
                <?php
                IconPrint([
                    ["fa", "fab fa-facebook", "#"],
                    ["ig", "fab fa-instagram", "#"],
                    ["tw", "fab fa-twitter", "#"],
                    ["gh", "fab fa-github", "#"]
                ])
                ?>
            </div>
        </div>
    </div>

    <div class="text-muted">
        <p>
            Name: <strong>Obi Fortune</strong> |
            Student Number: <strong>
                <a href="mailto:18701118@emu.edu.tr">18701118</a>
            </strong>
        </p>
    </div>

</footer>

<!-- bootstrap script  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>

<!-- My scripts  -->
<!-- <script src="./js/index.js"></script> -->