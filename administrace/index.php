<?php
ini_set('session.gc_maxlifetime', 604800);
session_set_cookie_params(604800, "/");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Title, Favicon -->
    <title>Revival Lucie | Administrace</title>
    <link rel="shortcut icon" href="/img/favicon.png" />

    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <meta name="author" content="Revival Lucie Morava, Adam Čech">
    <meta name="first_release" content="17.10.2020">

    <meta name="keywords" content="revivallucie, lucie revival, revival, lucie, morava, kozlovice, myslik, frydek-mistek, ostrava, rock, pop"/>
    <meta name="ROBOTS" content="index, follow">
    <meta name="description" content="Naše kapela vznikla ve Frýdku Místku a hrajeme pro Vás od roku 2012. Chcete si užít hity Lucie? Tak neváhejte a domluvte si náš koncert. „Nejlepší revival, který znáš“.">

    <meta property="og:title" content="Revival Lucie Morava" />
    <meta property="og:url" content="https://www.revivallucie.cz/" />
    <meta property="og:image" content="https://revivallucie.cz/img/uvod_thumb.jpg" />

    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/administrace/css/style.css">

    <script type="text/javascript" src="/js/jquery.min.js"></script>

    <script type="text/javascript" src="/administrace/js/scripts.js"></script>
    <script src="/administrace/js/file_picker.js"></script>
</head>

<body>

<?php

$_SESSION["a"];

if ($_SESSION["a"] != 1) {
    ?>

    <div class="login-box">

        <div class="login-box-header">
            <img class="logo" src="/img/logo_small_dark.png" alt="Revival Lucie Morava"/>
            <h1>Administrace</h1>
        </div>

        <?php if (isset($_SESSION["login_err"])) { ?>
            <div class="login-box-err">Špatný login nebo heslo!</div>
        <?php
            unset($_SESSION["login_err"]);
        } ?>

        <form method="POST" action="/administrace/executables/login.php">
            <div class="table">

                <div class="tr">
                    <div class="td">
                        <label for="l">
                            Login:
                        </label>
                    </div>
                    <div class="td">
                        <input name="l" type="text"/>
                    </div>
                </div>

                <div class="tr">
                    <div class="td">
                        <label for="p">
                            Heslo:
                        </label>
                    </div>
                    <div class="td">
                        <input name="p" type="password"/>
                    </div>
                </div>
            </div>
            <input value="Přihlásit se" type="submit"/>
        </form>
    </div>

    <?php
} else {
    include $_SERVER['DOCUMENT_ROOT'] . "/administrace/indexLogged.php";
}
?>

</body>

</html>