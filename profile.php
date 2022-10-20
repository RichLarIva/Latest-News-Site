<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $name = $_GET['user'];
    echo "<title> $name </title>";

    ?>
    <link rel="stylesheet" href="style/index.css">
</head>

<body class="overflowHide">
    <header>
        <div id="userInfo">
            <?php
            require("connect.php");
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                $user = $_SESSION["username"];
                echo "<span> Logged in as $user </span> <p> Not you? <a href='logout.php' class='btn btn-red'>Log Out. </a></p>";
            } else
                echo "<p>You are not signed in <button id='tist' class='btn btn-primary'>Sign in</button> </p>";
            ?>
        </div>
        <br>
        <br>
        <h1><img src="images/logo.svg" alt="logo" class="logo">Bondscript forum</h1>
        <br>
    </header>
    <div id="tiles">
    </div>
        <div id="user">
            <?php
            $user = $_GET["user"];
            require_once "connect.php";
            $sql = "SELECT user FROM users WHERE user='$user'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if (($row['user']) == null) {
                echo "<h1> Error user not found</h1>";
            } 
            else {
                echo "<br><h1>" . $row["user"] . "</h1>";
                echo "<br><img src='images/logo.svg' class='profileImg'>";
                $usrn = $_SESSION["username"];
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $usrn == $row["user"])
                    echo "<a href='reset-password.php' class='btn btn-warning'>Reset Your Password</a>
            <a href='logout.php' class='btn btn-red ml-3'>Sign Out of Your Account</a> <a href='delete-user.php' class='btn btn-red ml-3'> DELETE YOURSELF</a>";
                $conn->close();
            }
            ?>
            </div>

        <script src="scripts/wrapping.js"></script>
</body>

</html>