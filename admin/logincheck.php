<?php  
session_start();  
if(isset($_SESSION["user"])) {  
    header("location: home.php");  
    exit();
}
?>

<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check database connection
    if (!$con) {
        die("Lỗi kết nối: " . mysqli_connect_error());
    }

    // Handle login
    if (isset($_POST['dangnhap'])) {
        handleLogin($con);
    } 
    // Handle registration
    elseif (isset($_POST['dangky'])) {
        handleRegistration($con);
    }

    // Close database connection
    mysqli_close($con);
}

// Function to handle login logic
function handleLogin($con) {
    $myusername = mysqli_real_escape_string($con, $_POST['user']);
    $mypassword = mysqli_real_escape_string($con, $_POST['pass']);

    $sql = "SELECT * FROM login WHERE usname = ? AND pass = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $myusername, $mypassword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) {
        $userRole = $row['role'];
        $_SESSION['user'] = $myusername;
        $_SESSION['email'] = $row['email'];
        if ($userRole == 1) {
            header("location: home.php");
            exit();
        } else if ($userRole == 0) {
            $userName = $row['name'];
            header("location: ../index.php?user=" . urlencode($userName));
            exit();
        } else {
            echo '<script>alert("Invalid role") </script>';
        }
    } else {
        echo '<script>alert("Tên tài khoản hoặc mật khẩu không chính xác") </script>';
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
}

// Function to handle registration logic
function handleRegistration($con) {
    $username = mysqli_real_escape_string($con, $_POST['new_user']);
    $password = mysqli_real_escape_string($con, $_POST['new_pass']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $defaultRole = 0; // Set the default role to 0

    // Perform necessary validation and hashing of password

    $insertQuery = "INSERT INTO login (role, email, user, usname, pass) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($con, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "ssssi", $defaultRole, $email, $fullname, $username, $password);
    mysqli_stmt_execute($insertStmt);

    if (mysqli_stmt_affected_rows($insertStmt) > 0) {
        echo '<script>alert("User registered successfully") </script>';
    } else {
        echo '<script>alert("Registration failed") </script>';
    }

    // Close prepared statement
    mysqli_stmt_close($insertStmt);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hoặc đăng ký</title>
     <!-- font awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css stylesheet -->
    <link rel="stylesheet" href="./css/logincheck.css">
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <div class="infield">
                    <input type="text" placeholder="Username" name="user" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="new_pass" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="text" placeholder="FullName" name="fullname"  />
                    <label></label>
                </div>
                <button type="submit" name="dangky" class="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <div class="infield">
                    <input type="text" placeholder="Username" name="user" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="pass" required/>
                    <label></label>
                </div>
                <a href="#" class="forgot">Forgot your password?</a>
                <button type="submit" name="dangnhap" class="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button>Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>

    
    
    <!-- js code -->
    <script>
        const container = document.getElementById("container");
        const overlayCon = document.getElementById("overlayCon");
        const overlayBtn = document.getElementById("overlayBtn");

        overlayCon.addEventListener('click', () => {
            container.classList.toggle('right-panel-active');

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame(() => {
                overlayBtn.classList.add('btnScaled');
            })
        });


    </script>

</body>
</html>

