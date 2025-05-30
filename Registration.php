<?php
session_start();
    include("TheConnection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = mysqli_real_escape_string($con, $_POST['userName']);
        $surname = mysqli_real_escape_string($con, $_POST['Surname']);
        $StudentNo = mysqli_real_escape_string($con, $_POST['studentNo']);// Assuming this is identity number
        $Contact = mysqli_real_escape_string($con, $_POST['contact']);
        $ModuleCode = mysqli_real_escape_string($con, $_POST['modulecode']); 
        $Email = mysqli_real_escape_string($con, $_POST['userEmail']);
        $Password = mysqli_real_escape_string($con, $_POST['password']);



        if(!empty($name) && !is_numeric($name) && !empty($surname) && !empty($StudentNo) && !empty($Contact) && !empty($ModuleCode) && !empty($Email) && !empty($Password)){

            $sql = "INSERT INTO studentinfo (name,surname,studentNumber,contact,moduleCode,email,password)
            VALUES ('$name','$surname','$StudentNo','$Contact','$ModuleCode','$Email','$Password');";

            mysqli_query($con, $sql);
            echo "Succesfully registerd";
            header("Location: LoginPage.php");
            die;
        }else{
            echo "Please enter valid information";
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
    <link rel="stylesheet" href="Registration.css">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <title>Registration</title>
</head>
<body>
    <header>

    </header>
    <main>
        <div class="Cover-cont">
            <div class="main-container">
                <div class="Tittle-div">
                    <h1>
                        Register/Sign Up.
                    </h1>
                </div>
                <div class="Register-div">
                    <form id="myform" autocomplete="off" method="POST" action="" >
                        <label for="name">Name: </label>
                        <input type="text" placeholder="name" required name="userName" for="name"><br>
                        <label for="surname">Surname: </label>
                        <input type="text" placeholder="surname" name="Surname" required for="surname"><br>
                        <label for="studentNo">Student Number: </label>
                        <input type="text" placeholder="e.g:201938276" required name="studentNo" for="studentNo"><br>
                        <label for="contact">Contact: </label>
                        <input type="text" placeholder="+27:" required maxlength="10" inputmode="numeric"  name="contact" for="contact"><br>
                        <label for="modulecode">Module Code: </label>
                        <input type="text" max="8" placeholder="e.g:SBIO011" required name="modulecode" for="modulecode"><br>
                        <label for="userEmail">Email: </label>
                        <input type="email" placeholder="1ersda@gmail.com" required name="userEmail" for="userEmail"><br>
                        <!-- Password field for the user -->
                        <label for="Password">Password: </label>
                        <input type="password" placeholder="Password" name="password" for="Password" id="Password" value><br>
                        <!-- Confirm Password -->
                        <label for="PassCon">Confirm Password: </label>
                        <input type="password" placeholder="Confirm Password" required name="passConfirm" value id="ConfirmPassword" for="PassCon"><br>
                        <!-- button for the sign up -->
                        <button class="signup-BUTTON" name="submit">Sign Up</button>
                    </form>
                    </div>
                    <div class="errro" style="text-align: center; justify-content: center;">
                        <p id="Errorside" style="display: none; color: red; text-align: center; font-family: 'Roboto',sans-serif;"></p>
                    </div>
                 <div class="lower-div">
                    <p>Already registered click signin.</p>
                    <p><a href="LoginPage.php">SignIn</a></p>
                </div>
            </div>
        </div>

    </main>
    <footer>

    </footer>
 <script src="Register.js"></script>
</body>
</html>