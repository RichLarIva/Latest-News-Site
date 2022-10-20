<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bondscript Forum</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body class="overflowHide">
    <header>
        <img src="images/logo.svg" class="logo" alt="logo">
        <div id="userInfo">
        <?php
        $user = $_SESSION["username"];
        echo "<p><a href='profile.php?user=".$user."'>".$user."</a></p><span>Logged in as $user </span> <p> Not you? <a href='logout.php' class='btn'>Log Out. </a></p>";
        ?>
    </div>
    </header>

    <div id="articles">
        <?php
            require "pub_funcs.php";
            require "connect.php";
            $user = $_SESSION["username"];
            $sql = "SELECT * FROM users WHERE user = '$user'";
            $res = $conn->query($sql);
            $categories = mysqli_fetch_assoc($res);
            $cat = $categories["cats"];
            getNews($cat);
            $conn->close();
        ?>
    </div>

</body>
</html>