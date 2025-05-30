<?php 
// session_start();

// if(isset($_SESSION['email'])){

//     unset($_SESSION['email']);
//     session_destroy();

// }

// header("Location: LoginPage.php");
// die;
// exit();


session_start();

// Force browser to NOT cache any page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Clear session
if (isset($_SESSION['email'])) {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

// Use JavaScript to clear localStorage AND redirect
echo '
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
</head>
<body>
    <script>
        localStorage.removeItem("alerts_shown"); // Clear the flag
        window.location.href = "LoginPage.php"; // Redirect after clearing
    </script>
</body>
</html>
';
exit(); // Stop PHP execution
?>