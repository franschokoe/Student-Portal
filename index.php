<!-- <?php
ini_set('session.cookie_lifetime', 0);
session_start();
include("TheConnection.php");
include("functions.php");

$user_data = check_login($con);

$name = $user_data['name'];
$surname = $user_data['surname'];
$studentNumber = $user_data['studentNumber'];
$contact = $user_data['contact'];
$moduleCode = $user_data['moduleCode'];
$email = $user_data['email'];


if(isset($_POST['submit'])){
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $filename = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = array('jpg','jpeg','png','pdf');
        
        if(in_array($fileExt, $allowed)){
            $fileNameNew = uniqid('', true).'.'.$fileExt;
            $fileDestination = 'Upload/'.$fileNameNew;
            
            // Create Upload directory if it doesn't exist
            if (!file_exists('Upload')) {
                mkdir('Upload', 0755, true);
            }
            
            if (move_uploaded_file($fileTmpName, $fileDestination)){
                // Update the database with the image filename
                $sql = "UPDATE studentinfo SET userImage = '$fileNameNew' WHERE email = '$email'";
                mysqli_query($con, $sql);
                // echo "<footer><p>Uploaded Successfully</p></footer>";
            } else {
                // echo "<footer><p>Upload not Successful</p></footer>";
            }
        } else {
            // echo "<footer><p>Invalid file type</p></footer>";
        }
    } else {
        // echo "<footer><p>No file selected or upload error</p></footer>";
    }
}

// Get current image
$sql = "SELECT userImage FROM studentinfo WHERE email = '$email' LIMIT 1";
$result = mysqli_query($con, $sql);
$image_data = mysqli_fetch_assoc($result);
$current_image = isset($image_data['userImage']) ? $image_data['userImage'] : null;
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="ProfilePage.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=upload_2" />
    <title>Profile Page</title>
    <style>
                *{
        box-sizing: border-box;
        margin: 0%;
        padding: 0%;
        }
        :root{
            --forbackround:#237db481;
            --Header:#2772A0;
            --forBorder:rgb(143, 205, 253);
        }

        .main-div{
            display: flex;
            flex-direction: row; /*use column direction in mobile response*/
            justify-content:center;
            align-items: center;
            flex-wrap: wrap;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 2%;
            gap: 10%;
        }
        .image-div{
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            flex-grow: -1;
            justify-content: center;
            align-items: center;
            gap:5px;
            /* background-color: violet; */
            /* padding: 5px; */

        }
        .userProfilePhoto img {
            aspect-ratio: 1/1;
            border: 2.5px;
            border-style:solid;
            border-color: var(--forBorder);/*change color at a point*/
            border-radius: 50%;
            object-fit: cover;
            width: 320px;
            height: 320px;
            overflow: hidden;
        }
        .form-div{
            text-align: center;
        }
        .userForm label{
            font-size: 2rem;
            font-family:"Roboto", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .info-div{
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            flex-shrink:1;
            gap: 10%;
        }
        .std-infodiv{
            font-family: "Roboto",sans-serif;
            text-align: center;
            color:#2772A0;
            padding-bottom: 5%;
        }
        .UserInfo-div{
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            /* padding-top: 10%; */
            padding-left: 5%;
            justify-content: center;
            align-items:start;
            height: 400px;
            background-color: var(--forbackround);
            font-size:50%;
            border-radius:10px;
            width: 450px;
            overflow: hidden;
        }
        .UserInfo-div div{
            justify-content:space-evenly;
            height: 50px;
        }
        .UserInfo-div p{
            font-size: 1.4rem;
            font-family: "Roboto",sans-serif;
            /* font-weight:550; */
        }

        .Portal-header{
            padding: 15px;
            /* background-color: hsl(183, 46%, 78%); */
            background-color: var(--Header);
            margin:0px;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
        .header-logout button{
            font-family: "Roboto",sans-serif;
            font-size: 1rem;
        }
        .header-logout button a {
            text-decoration: none;
            color: black;
        }
        .Aimclass{
            font-family: "Roboto",sans-serif;
            color:rgb(204, 221, 234);
        }
        .Main-content{
            display: flex;
            flex-direction:column;
            gap: 45px;
        }
        .edit-update{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .edit-update p{
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 700;
            color:#2772A0;
        }
        .edit-update button{
            border:solid;
            border-color: var(--forBorder);
            background-color: var(--forbackround);
            font-size: 1.2em;
            border-radius: 4px;
            padding: 8px;
            font-family: "Roboto",sans-serif;
        }
        .edit-update button a{
            text-decoration: none;
            color: hsl(186, 42%, 30%);
        }
        .edit-update button:hover{
            background-color:#e2f3f4
        }
        .upload-btn{
            border:solid;
            border-color: rgb(170, 202, 226);
            background-color: rgb(123, 163, 196);
            font-size: 1.1em;
            border-radius: 3px;
            padding: 5px;
            font-family: "Roboto",sans-serif;
        }
        footer{
            height: 30px;
            bottom: 0;
        }
        @media all and (max-width:840px){
            .main-div{
                display: flex;
                flex-direction: row; /*use column direction in mobile response*/
                justify-content:center;
                align-items: center;
                flex-wrap: wrap;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: 2%;
                gap: 10%;
            }
            .UserInfo-div{
                display: flex;
                flex-direction: column;
                flex-wrap: nowrap;
                /* padding-top: 10%; */
                padding-left: 5%;
                justify-content: center;
                align-items:start;
                height: 380px;
                background-color: var(--forbackround);
                font-size:50%;
                border-radius:10px;
                width: 430px;
                overflow: hidden;
            }

        }
        @media all and (max-width:650px){
            .main-div{
                display: flex;
                flex-direction: row; /*use column direction in mobile response*/
                justify-content:center;
                align-items: center;
                flex-wrap: wrap;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: 2%;
                gap: 10%;
            }
            .UserInfo-div{
                display: flex;
                flex-direction: column;
                flex-wrap: nowrap;
                /* padding-top: 10%; */
                padding-left: 5%;
                justify-content: center;
                align-items:start;
                height: 380px;
                background-color:var(--forbackround);
                font-size:50%;
                border-radius:10px;
                width: 390px;
                overflow: hidden;
            }

        }

        @media all and (max-width:480px) {
            .main-div{
                display: flex;
                flex-direction: column; /*use column direction in mobile response*/
                justify-content:center;
                align-items: center;
                flex-wrap: wrap;
                margin-left: 5%;
                margin-right: 5%;
                margin-top: 2%;
                gap: 15px;
            }
            .Main-content{
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 5px;
                flex-direction:column;
                /* gap: 45px; */
            }
            .image-div{
                display: flex;
                flex-direction: column;
                flex-wrap: nowrap;
                flex-grow: -1;
                justify-content: center;
                align-items: center;
                gap:15px;
                /* background-color: violet; */
                padding: 5px;
            
            }
            .userProfilePhoto img {
                /* aspect-ratio: 1/1; */
                border: 2.5px;
                border-style:solid;
                border-color: var(--forBorder);/*change color at a point*/
                border-radius: 50%;
                object-fit: cover;
                width: 270px;
                height: 270px;
                overflow: hidden;
            
            }
            .UserInfo-div{
                display: flex;
                flex-direction: column;
                flex-wrap: nowrap;
                /* padding-top: 10%; */
                padding-left: 5%;
                justify-content: center;
                align-items:start;
                height: 380px;
                background-color: var(--forbackround);
                font-size:50%;
                border-radius:10px;
                width: 340px;
                overflow: hidden;
            }
            .UserInfo-div p{
                font-size: 1.3rem;
                font-family: "Roboto",sans-serif;
                /* font-weight: 400; */
            }
        }




    </style>
</head>
<body>
    <header>
        <div class="Portal-header">
            <div class="Aimclass">
                <h3>Portal</h3>
            </div>
            <div class="header-logout">
                <button><a href="LogOut.php">Log Out</a></button>
            </div>
        </div>
    </header>
    <main class="Main-content">
        <div class="main-div">
            <div class="image-div">
                <div class="userProfilePhoto">
                    <?php if($current_image && file_exists('Upload/'.$current_image)): ?>
                        <img class="userimage" src="Upload/<?php echo $current_image; ?>">
                    <?php else: ?>
                        <img class="userimage" src="placeholder.jpg" >
                    <?php endif; ?>
                </div>
                <div class="form-div">
                    <form class="userForm" action="" method="POST" enctype="multipart/form-data">
                        <label for="image">Upload Profile:</label><br>
                        <input type="file" name="image" id="image"><br>
                        <button type="submit" class="upload-btn" name="submit">Upload</button>                  
                    </form>
                </div>
            </div>
            <div class="info-div">
                <div class="std-infodiv">
                    <h1>Student Infomation.</h1>
                </div>
                <div class="UserInfo-div">
                    <div>
                        <p><strong>Name:   </strong> <?php echo $name;?></p>
                    </div>
                    <div>
                        <p><strong>Surname:   </strong> <?php echo $surname?></p>
                    </div>
                    <div>
                        <p><strong>Student Number:   </strong> <?php echo $studentNumber?></p>
                    </div>
                    <div>
                        <p><strong>Contact:   </strong> <?php echo $contact?></p>
                    </div>
                    <div>
                        <p><strong>Module Code:   </strong> <?php echo $moduleCode?></p>
                    </div>
                    <div>
                        <p><strong>Email:   </strong> <?php echo $email ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-update">
            <p>If you changed any details click update below:</p>
            <button><a href="update.php">Update</a></button>
        </div>
    </main>
    <footer class="footer1">
    </footer>

<script>
    // Check if alerts were already shown
    if (!localStorage.getItem('alerts_shown')) {
        // First welcome alert
        window.alert("Hi <?php echo addslashes($name); ?>, Welcome & thanks for choosing my portal");
        // Only show upload reminder if user hasn't uploaded an image
        <?php if(!$current_image): ?>
            window.alert("Please make sure you upload your picture")
        <?php endif; ?>
        
        // Set flag in localStorage
        localStorage.setItem('alerts_shown', 'true');
    }
</script>
</body>
</html>











