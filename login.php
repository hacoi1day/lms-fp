<?php
    // error_reporting(E_ERROR | E_PARSE);
    session_start();
    require './db/connect.php';
    require './db/query-data.php';
    if ($_SESSION['is_login'] == 1) {
        echo '
            <script>
                location.href = \'/index.php\';
            </script>
        ';
        die();
    }
    
?>

<?php
    if ($_POST['email'] && $_POST['password']) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = 'SELECT * FROM students WHERE email = \'' . $email . '\' AND password = \'' . $password . '\'';
        if ($result = mysqli_query($conn, $query)) {
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['is_login'] = true;
                echo '
                    <script>
                        location.href = \'/index.php\';
                    </script>
                ';
                die();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
    <div class="top py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>You are not logged in. (<a href="/login.php">Login</a>)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar my-3 py-2">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/index.php">
                    <img class="banner-img" src="/assets/images/banner_logo.png" alt="Banner Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Course</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="content mb-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login border">
                        <h2 class="h-3 text-center">Đăng nhập</h2>
                        <form accept="/login.php" method="post">
                            <div class="form-group mb-3">
                                <label for="email">Địa chỉ email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer pt-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <img class="image-connect" src="/assets/images/ketnoi.jpeg" alt="ketnoi">
                    <p>Hệ thống LMS/LCMS cho Blended learning tại trường Đại học Kinh tế Quốc dân</p>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h4 class="h-3">INFO</h4>
                    <a href="">CỔNG THÔNG TIN ĐÀO TẠO</a>
                    <a href="">daihocchinhquy.neu.edu.vn</a>
                    <a href="">myaep.neu.edu.vn</a>
                    <a href="">vlvh.neu.edu.vn</a>
                    <a href="">thacsi.neu.edu.vn</a>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h4 class="h-3">CONTACT US</h4>
                    <p class="mb-0">207 Giải phóng</p>
                    <p class="mb-0">Phone : +84 36280280</p>
                    <p class="mb-0">E-mail : <a href="mailto:ask-cait@neu.edu.vn">ask-cait@neu.edu.vn</a></p>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h4 class="h-3">GET SOCIAL</h4>
                    <div class="socials">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-pinterest-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-google-plus-square"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="copyright text-center text-muted pt-1">Copyright © 2020 - Developed by CAIT@neu. Powered by Moodle</p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0355850d71.js"></script>
</body>
</html>
<?php
    require './db/disconnect.php';
?>