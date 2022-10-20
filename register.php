<?php
    session_start();

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bondscript</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div id="tiles"></div>
    <div class="container">
        <img src="images/logo.svg" alt="Logo" class="logo">
        <div class="login">
            <form method="POST">
                <input type="text" name="fullname" placeholder="Full Name" required maxlength="35">
                <br>
                <input type="text" name="username" placeholder="Username" required minlength="3" maxlength="25">
                <br>
                <input type="password" name="pwd" placeholder="Password" required class="pas" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <br>
                <input type="password" name="cpwd" placeholder="Confirm Password" required class="pas" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <br>
                <span class="checkbox_label"><input type="checkbox" onclick="showPWD()"></span>
                <br>
                <input type="date" name="bday" required>
                <br>
                <div id="categories">
                <select name="cats[]" multiple>
                    <option>business</option>
                    <option>entertainment</option>
                    <option>environment</option>
                    <option>food</option>
                    <option>health</option>
                    <option>politics</option>
                    <option>science</option>
                    <option>sports</option>
                    <option>technology</option>
                    <option>top</option>
                    <option>world</option>
                </select>
                <p>For windows: Hold down the control <kbd>ctrl</kbd> button to select multiple options
                    <br>
                For Mac: Hold down the <kbd>command</kbd> button to select multiple options</p>
                </div>
                <br>
                <input type="submit" name="register" value="Register">
            </form>
            <?php
                if(isset($_POST["register"])){
                    require "connect.php";
                    $fullName = $_POST["fullname"];
                    $usr = $_POST["username"];
                    $pawd = $_POST["pwd"];
                    $confirmPWD = $_POST["cpwd"];
                    $bday = $_POST["bday"];
                    $cat = $_POST["cats"];
                    if($pawd == $confirmPWD)
                        {
                        if($stmt = $conn->prepare("INSERT INTO users (fullname, user, pwd, bday, cats) VALUES (?, ?, ?, ?, ?)")){
                            $stmt->bind_param("sssss", $paramNAME, $paramUSER, $paramPWD, $paramBDAY, $paramCAT);
                            $paramNAME = $fullName;
                            $paramUSER = $usr;
                            $paramBDAY = $bday;
                            $paramPWD = password_hash($pawd, PASSWORD_DEFAULT);
                            $paramCAT = implode(",", $cat);
                            if($stmt->execute()){
                                header("location: index.php");
            
                            }
                            else{
                                echo "<p class='text-error'>OOPS!!! Something went wrong. Please try again later. </p>";
                            }
                            $stmt->execute();
                            $stmt->close();
                        }
                    }
                    else{
                        echo "<div class='smaller'> <span class='danger smaller'>Make sure the password matches with eachother</span></div>";
                    }
                }
            ?>
        </div>
    </div>
    <script src="scripts/password.js"></script>
    <script src="scripts/wrapping.js"></script>
</body>
</html>