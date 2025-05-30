<?php
ini_set('session.cookie_lifetime', 0);
session_start();
include("TheConnection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize and validate inputs
    $name = mysqli_real_escape_string($con, trim($_POST['userName']));
    $surname = mysqli_real_escape_string($con, trim($_POST['Surname']));
    $StudentNo = mysqli_real_escape_string($con, trim($_POST['studentNo']));
    $Contact = mysqli_real_escape_string($con, trim($_POST['contact']));
    $ModuleCode = mysqli_real_escape_string($con, trim($_POST['modulecode'])); 
    $Email = mysqli_real_escape_string($con, trim($_POST['userEmail']));
    $Password = trim($_POST['password']);
    $ConfirmPassword = trim($_POST['passConfirm']);

    // Validate password match
    if($Password !== $ConfirmPassword) {
        echo "<script>
                document.getElementById('Errorside').innerHTML = 'Passwords do not match';
                document.getElementById('Errorside').style.display = 'block';
              </script>";
    } else {
        // Store password as plain text (NOT RECOMMENDED FOR PRODUCTION)
        $plain_password = $Password;
        
        // Use prepared statement to prevent SQL injection
        $stmt = $con->prepare("UPDATE studentinfo SET 
                              name = ?,
                              surname = ?,
                              studentNumber = ?,
                              contact = ?,
                              moduleCode = ?,
                              email = ?,
                              password = ?
                              WHERE email = ?");
        
        $stmt->bind_param("ssssssss", $name, $surname, $StudentNo, $Contact, 
                         $ModuleCode, $Email, $plain_password, $_SESSION['email']);
        
        if($stmt->execute()) {
            $affected_rows = $stmt->affected_rows;
            
            if($affected_rows > 0) {
                // Update session email if email was changed
                $_SESSION['email'] = $Email;
                header("Location: index.php");
                exit();
            } else {
                echo "<script>
                        document.getElementById('Errorside').innerHTML = 'No changes were made';
                        document.getElementById('Errorside').style.display = 'block';
                      </script>";
            }
        } else {
            echo "<script>
                    document.getElementById('Errorside').innerHTML = 'Error updating record: " . addslashes($stmt->error) . "';
                    document.getElementById('Errorside').style.display = 'block';
                  </script>";
        }
        
        $stmt->close();
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
    <link rel="stylesheet" href="Registration.css">
    <title>Update Information</title>
</head>
<body>
<main>
<?php
if(isset($_SESSION['email'])) {
    $Email = $_SESSION['email'];
    
    $sql = "SELECT * FROM studentinfo WHERE email = ? LIMIT 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if($row) {
?>
        <div class="Cover-cont">
            <div class="main-container">
                <div class="Tittle-div">
                    <h1>Update Information</h1>
                    <p style="font-family:'Roboto',sans-serif; font-size: 1rem; text-align: center; color: red;">
                        If you have changed the info click update.
                    </p>
                </div>
                <div class="Register-div">
                    <form id="myform" autocomplete="off" method="POST" action="" enctype="multipart/form-data">
                        <label for="name">Name: </label>
                        <input type="text" placeholder="name" required name="userName" value="<?php echo htmlspecialchars($row["name"]); ?>"><br>
                        
                        <label for="surname">Surname: </label>
                        <input type="text" placeholder="surname" name="Surname" required value="<?php echo htmlspecialchars($row["surname"]); ?>"><br>
                        
                        <label for="studentNo">Student Number: </label>
                        <input type="text" placeholder="e.g:201938276" required name="studentNo" value="<?php echo htmlspecialchars($row["studentNumber"]); ?>"><br>
                        
                        <label for="contact">Contact: </label>
                        <input type="text" placeholder="+27:" required name="contact" maxlength="10" inputmode="numeric" value="<?php echo htmlspecialchars($row["contact"]); ?>"><br>
                        
                        <label for="modulecode">Module Code: </label>
                        <input type="text" maxlength="8" placeholder="e.g:SBIO011" required name="modulecode" value="<?php echo htmlspecialchars($row["moduleCode"]); ?>"><br>
                        
                        <label for="userEmail">Email: </label>
                        <input type="email" placeholder="example@gmail.com" required name="userEmail" value="<?php echo htmlspecialchars($row["email"]); ?>"><br>
                        
                        <label for="Password">Password: </label>
                        <input type="password" placeholder="Password" name="password" id="Password" value="<?php echo htmlspecialchars($row["password"]); ?>"><br>
                        
                        <label for="PassCon">Confirm Password: </label>
                        <input type="password" placeholder="Confirm Password" required name="passConfirm" id="ConfirmPassword"><br>
                        
                        <button class="signup-BUTTON" name="submit">Update</button>
                    </form>
                    <div class="errro" style="text-align: center; justify-content: center;">
                        <p id="Errorside" style="display: none; color: red; text-align: center; font-family: 'Roboto',sans-serif;"></p>
                    </div>

                </div>
            </div>
        </div>
<?php
    } else {
        echo "<script>alert('User not found'); window.location.href='LoginPage.php';</script>";
    }
} else {
    header("Location: LoginPage.php");
    exit();
}
?>
</main>
<script src="Register.js"></script>
</body>
</html>