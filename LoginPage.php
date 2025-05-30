<?php
session_start();
include("TheConnection.php");
include("functions.php");
// checking if logged
$_SESSION['email'] = true;



if($_SERVER['REQUEST_METHOD'] == "POST"){

    $Email = mysqli_real_escape_string($con, $_POST['email']);
    $Password = mysqli_real_escape_string($con, $_POST['password']);



    if(!empty($Email) && !empty($Password)){
        // read into the database
        $sql = "SELECT * from studentinfo where email = '$Email' limit 1";

        $result = mysqli_query($con, $sql);
        // check results
        if($result){
            
            if($result && mysqli_num_rows($result) > 0){

                $user_data = mysqli_fetch_assoc($result);
    
                if ($user_data['password'] === $Password){
    
                    $_SESSION['email'] = $user_data['email']; //the problem here was the 3 times === 
                    
                    header("Location: index.php");
                    die;
                }
                else{
                    echo "not successful";
                }
            }
        }



    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=upload_2" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <header>

    </header>
    <main>
        <div class="card-div">
            <div class="main-div">
                <div class="Log-name">
                    <h1>Login</h1>
                </div>
                <div class="Userform-div">
                    <form id="myform" autocomplete="off" method="POST" action="">
    
                        <label for="email">Email: </label>
                        <input type="text"  name="email" required placeholder="1ersda@gmail.com" for="email"><br>
    
                        <label id="Er1" for="password">Password: </label>
                        <input id="Password" type="password" required name="password" placeholder="Password" for="password" value><br>
                        
                        <label id="Er2" for="passconfirm">Confirm Password: </label>
                        <input id="ConfirmPassword" required type="password" name="passconfirm" placeholder="Confirm Password" for="passconfirm" value><br>
    
                        <!-- button for the login  -->
                        <input type="submit" class="submit-btn" name="submit" value="Login">
                    </form>
                </div>
                <div id="Errorside2" class="Errorside2">
                    <p id="Errorside" class="ErrorPage" style="display: none;">Incorrect password please make sure your password do match.</p>
                </div>
                <div class="ref-div">
                    <p>If you haven't signup.</p>
                    <p><a href="Registration.php">Sign Up</a></p>
                </div>
            </div>
    
        </div>

    </main>
    <footer>

    </footer>
    <script src="Login.js">
    </script>
</body>
</html>