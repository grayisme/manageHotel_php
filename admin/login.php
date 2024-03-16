<?php
session_start();

if (isset($_SESSION["user"])) {
    header("location: home.php");
    exit();
} ?>

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
                <h1>Tạo tài khoản</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng email của bạn để đăng ký</span>
                <div class="infield">
                    <input type="text" placeholder="Username" name="user" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="pass" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="text" placeholder="FullName" name="fullname" />
                    <label></label>
                </div>
                <button type="submit" name="dangky" class="submit">
                    Đăng ký</button>
            </form>
        </div>


        <div class="form-container sign-in-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h1>Đăng nhập</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <div class="infield">
                    <input type="text" placeholder="Username" name="user" class="autoname" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="pass" class="autopass" required />
                    <label></label>
                </div>
                <a href="#" class="forgot">Quên mật khẩu?</a>
                <button type="submit" name="dangnhap" class="submit">


                    Đăng nhập</button>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Hãy đăng nhập</p>
                    <button style="margin-bottom: 20px;">
                        Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Tạo tài khoản đăng ký ^^</p>
                    <button style="margin-top: 20px;">Đăng ký</button>
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
    if (isset($_POST['dangky'])) {
        handleRegistration($con);
    }

    // Close database connection
    mysqli_close($con);
}

// Function to handle login logic
function handleLogin($con)
{
    $myusername = mysqli_real_escape_string($con, $_POST['user']);
    $mypassword = mysqli_real_escape_string($con, $_POST['pass']);

    // Get the user data including the hashed password
    $sql = "SELECT * FROM login WHERE usname = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $myusername);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) {
        $hashedPassword = $row['pass'];
        //băm mk md5 để so sánh 
        if (md5($mypassword) === $hashedPassword) {
            $userRole = $row['role'];
            $_SESSION['user'] = $myusername;
            $_SESSION['email'] = $row['email'];

            if ($userRole == 1) {
                echo '<script>window.location.href = "./home.php";</script>';
            } else {
                $_SESSION['email'] = $row['email'];
                $_SESSION['fullname'] = $row['user'];
                $_SESSION['id'] = $row['id'];
                echo '<script>window.location.href = "../index.php";</script>';
            }
        } else {
            echo '<script>alert("Tên tài khoản hoặc mật khẩu không chính xác") </script>';
        }
    } else {
        echo '<script>alert("Tên tài khoản hoặc mật khẩu không chính xác") </script>';
    }
    mysqli_stmt_close($stmt);
}

function handleRegistration($con)
{
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $defaultRole = 0; 

    $checkQuery = "SELECT * FROM login WHERE usname = ?";
    $checkStmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "s", $username);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);


    $checkEmailQuery = "SELECT * FROM login WHERE email = ?";
    $checkEmailStmt = mysqli_prepare($con, $checkEmailQuery);
    mysqli_stmt_bind_param($checkEmailStmt, "s", $email);
    mysqli_stmt_execute($checkEmailStmt);
    $emailResult = mysqli_stmt_get_result($checkEmailStmt);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists, show error message
        echo '<script>alert("Tên tài khoản đã tồn tại") </script>';
    } elseif (mysqli_num_rows($emailResult) > 0) {
        // Email already exists, show error message
        echo '<script>alert("Email đã tồn tại") </script>';
    } else {
        //băm md5
        $hashedPassword = md5($password);

        $insertQuery = "INSERT INTO login (role, email, user, usname, pass) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "issss", $defaultRole, $email, $fullname, $username, $hashedPassword);
        mysqli_stmt_execute($insertStmt);

        if (mysqli_stmt_affected_rows($insertStmt) > 0) {
            echo '<script>alert("Đăng ký thành công") </script>';
        } else {
            echo '<script>alert("Đăng ký không thành công") </script>';
        }

        mysqli_stmt_close($insertStmt);
    }

    mysqli_stmt_close($checkStmt);
    mysqli_stmt_close($checkEmailStmt);
}