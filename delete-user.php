<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div id="resPwd">
        <h2>Delete user</h2>
        <p>Please fill out this form to reset your password.</p>
        <form method="post">
            <fieldset>
            <input type="text" class="text-align center" name="user">
                <input class="text-align pas" type="password" name="pwd" placeholder="Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" title="Passwords need atleast 1 uppercase letter, 1 lowercase letter, at least 1 number, at least one symbol (!@#$%^&*_=+-) minimum 8 characters max 20">
                <span class="checkbox_label"><input type="checkbox" onclick="showPWD()"></span>
                <input type="date" name="bday" required>
            </fieldset>
            <fieldset>
                <input type="submit" class="btn" name="change" value="Delete User">
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
        $pwd = $_POST["pwd"];
        $bday = $_POST["bday"];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            if($iUser == $user){


            $query = "SELECT * FROM users where user='$user'";
            $res = $conn->query($query);
            $row = mysqli_fetch_assoc($res);
            if(password_verify($pwd, $row['pwd']))
            {
                echo "correct";
                $sql = "DELETE FROM users where user = '$user' AND bday ='$bday'";

                        $conn->query($sql);
                            # Account Deleted
                            session_destroy();
                            header("location: index.php");
                            $conn->close();
                            exit();
                }
            }
        }
    

?>