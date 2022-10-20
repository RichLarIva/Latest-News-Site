<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div id="resPwd">
    <a href="index.php">Home</a>

        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form method="post">
            <fieldset>
            <input type="text" class="text-align center" name="user">
            <input class="text-align pas" type="password" name="oldpwd" placeholder="Old Password"required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <input class="text-align pas" type="password" name="pwd" placeholder="New Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <span class="checkbox_label"><input type="checkbox" onclick="showPWD()"></span>
                <input type="date" name="bday" required>
            </fieldset>
            <fieldset>
                <input type="submit" class="btn" name="change" value="Change Password">
                <a class="btn btn-secondary ml-2" href="main.php">Cancel</a>
            </fieldset>
        </form>
    </div>
    <div id="tiles"></div>
    <script src="scripts/password.js"></script>
    <script src="scripts/wrapping.js"></script>
</body>
</html>
<?php
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
    }

    require_once "connect.php";

    if(isset($_POST["change"])){
        $user = htmlspecialchars($_SESSION["username"]);
        $iUser = htmlspecialchars($_POST["user"]);
        $newPwd = $_POST["pwd"];
        $oldPwd = $_POST["oldpwd"];
        $bday = $_POST["bday"];
        $hashedPwd = password_hash($oldPwd, PASSWORD_DEFAULT);
            if($iUser == $user){


            $query = "SELECT * FROM users where user='$user'";
            $res = $conn->query($query);
            $row = mysqli_fetch_assoc($res);
            if(password_verify($oldPwd, $row['pwd']))
            {
                echo "correct";
                $sql = "UPDATE users SET pwd = ? where user = '$user' AND bday ='$bday'";
                
                if($stmt = $conn->prepare($sql)){
                    $stmt->bind_param("s", $paramPWD);
                    if($newPwd != $oldPwd){
                        $paramPWD = password_hash($newPwd, PASSWORD_DEFAULT);
                        if($stmt->execute()){
                            # Password updated successfully. Destroy the session, and redirect to login page
                            session_destroy();
                            header("location: index.php");
                            exit();
                        }
                        $stmt->close();
                    }
                }
                $conn->close();
            }
        }
    }

?>