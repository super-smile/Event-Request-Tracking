    <?php
session_start(); // Start a session
include 'config.php';

if (isset($_POST['login'])) {
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];

    // Use prepared statements to prevent SQL injection
    $select = "SELECT * FROM tbl_account WHERE userEmail = ? AND userPass = ?";
    $stmt = mysqli_prepare($conn, $select);
    mysqli_stmt_bind_param($stmt, "ss", $userEmail, $userPass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['userName'] = $row['userName'];
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['userType'] = $row['userType'];
        header('location: home.php');
        header('location: home.php');
    }else {
        $error[] = 'Incorrect email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLogin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <title>Login</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="container text-center mx-auto" style="padding-top: 50px;" id="image-container">
                    <h2><img src="logoo.png" alt="" width="350" height="550" class="img-fluid"></h2>
                    <div class="mt-4" style="font-size: 14px; color: white; padding-top: 90px">This website is managed by the Office of the Student Organization at Batangas State University
             - The NEU Lipa Campus</div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center"  id="login-container">
                <div class="container text-center mx-auto" style="padding-top: 30px; padding-right: 100px; padding-left: 100px;">
                    <div class="mx-auto" style="font-family: 'Poppins'; font-size: 41.953px; font: weight 700px;"><strong>LOGIN</strong></div>
                    <div class="border border-dark w-80"></div>
                    <br>Please login to access your account</br>
                    <p>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $errorMsg) {
                            echo '<span class="error-msg">' . $errorMsg . '</span>';
                        }
                    }
                    ?>
                    </p>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="userEmail" class="form-control" id="InputText" placeholder="Email Address*" style=" border: 1px solid #444444; " required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="userPass" class="form-control" id="InputPassword" placeholder="Password*" style=" border: 1px solid #444444; " required>
                        </div>
                        <button type="submit" name="login" class="btn btn-outline-dark btn-lg btn-block">LOGIN</button>
                    </form>
                    <div class="container text-center">
                        <div class="horizontal-line"></div>
                        <span class="or-text">   or   </span>
                        <div class="horizontal-line"></div>
                        </div>
                    <button type="button" class="btn btn-outline-dark btn-lg btn-block">Log in with Google</button>
                    <div class="mt-4" style="font-size: 14px;"><b>Note:</b> If you're experiencing difficulty logging in, please contact the Office of Student Organization for assistance.</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>