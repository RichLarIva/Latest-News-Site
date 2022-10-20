<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: main.php");
    }

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
<body class="overflowHideY">
    <div id="tiles"></div>
    <div class="container">
        <img src="images/logo.svg" alt="Logo" class="logo">
        <div class="login">
            <form method="POST" action="#">
                <input type="text" name="username" placeholder="Username" required minlength="3" maxlength="25">
                <br>
                <input type="password" name="pwd" placeholder="Password" class="pas" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <br>
                <span class="checkbox_label"><input type="checkbox" onclick="showPWD()"></span>
                <br>
                <input type="submit" name="login" value="Sign In">
            </form>
            <br>
            <p id="regi">Don't have an account? <a href="register.php" id="linkReg">Register Here</a></p>

            <?php
                require "connect.php";
                if(isset($_POST["login"])){
                  $user = trim($_POST["username"]);
                    $pwd = $_POST["pwd"];
                    $sql = "SELECT id, user, pwd FROM users WHERE user=?";
                    if($stmt = $conn->prepare($sql)){
                      $stmt->bind_param("s", $param_user);
                      $param_user = $user;
                      if($stmt->execute()){
                        $stmt->store_result();
                        
                        if($stmt->num_rows == 1){
                          $stmt->bind_result($id, $user, $hashed_pwd);
                          if($stmt->fetch()){
                            if(password_verify($pwd, $hashed_pwd)){
                              #Password is correct, Start a new session
                              session_start();
                              $_SESSION["id"] = $id;
                              $_SESSION["username"] = $user;
                              $_SESSION["loggedin"] = true;
                              header("location:main.php");
                            }
                            else{
                              echo "<span class='text-error'> Invalid username or Password. </span>";
                            }
                          }
                        }
                      }
                      
                      #$stmt->execute();
                      
                    }
                    $stmt->close();
                    #$conn->close();
                }
            ?>
        </div>
    </div>
    <script src="scripts/password.js"></script>
    <script src="scripts/wrapping.js"></script>
</body>
</html>