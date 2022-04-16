<?php
    session_start();
    require './db/connect.php';
    require './db/query-data.php';
    if (!isset($_SESSION['is_login'])) {
        echo '
            <script>
                location.href = \'/login.php\';
            </script>
        ';
        die();
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
                    <?php
                        if (!isset($_SESSION['is_login'])) {
                            echo '<p>You are not logged in. (<a href="/login.php">Login</a>)</p>';
                        }  else {
                            echo '<p><a href="/logout.php">Logout</a></p>';
                        }
                    ?>
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

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="titles">
                        <div class="title">
                            <div class="title-header d-flex justify-content-between align-items-center">
                                <span class="title-text">Danh sách sinh viên</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="title-content">
                                <table class="table border table-responsive">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Mật khẩu</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($students as $student) {
                                                echo '
                                                    <tr>
                                                        <td>'.$student['id'].'</td>
                                                        <td>'.$student['name'].'</td>
                                                        <td>'.$student['dob'].'</td>
                                                        <td>'.$student['email'].'</td>
                                                        <td>'.$student['phone'].'</td>
                                                        <td>'.$student['password'].'</td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="title">
                            <div class="title-header d-flex justify-content-between align-items-center">
                                <span class="title-text">Điểm thi học kì</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="title-content">
                                <table class="table border table-responsive">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã sinh viên</th>
                                        <th scope="col">Điểm</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($scores as $score) {
                                                echo '
                                                    <tr>
                                                        <td>'.$score['id'].'</td>
                                                        <td>'.$score['card'].'</td>
                                                        <td class="_1score" onclick="onEditScore(this)">
                                                            <span class="score-value">'.$score['score'].'</span>
                                                            <div class="score-form hide">
                                                                <form action="/update-score.php?type=score" method="POST" onsubmit="onSubmitFormUpdateScore(event)">
                                                                    <input type="hidden" name="id" value="'.$score['id'].'">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" name="score" class="form-control" placeholder="Nhập điểm" value="'.$score['score'].'">
                                                                        <button class="btn btn-success" type="submit">
                                                                            <i class="fas fa-check"></i> Lưu điểm
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="title">
                            <div class="title-header d-flex justify-content-between align-items-center">
                                <span class="title-text">Điểm thi online</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="title-content">
                                <table class="table border table-responsive">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã sinh viên</th>
                                        <th scope="col">Điểm</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($score_onlines as $score) {
                                                echo '
                                                    <tr>
                                                        <td>'.$score['id'].'</td>
                                                        <td>'.$score['card'].'</td>
                                                        <td class="_1score" onclick="onEditScore(this)">
                                                            <span class="score-value">'.$score['score'].'</span>
                                                            <div class="score-form hide">
                                                                <form action="/update-score.php?type=score_online" method="POST" onsubmit="onSubmitFormUpdateScore(event)">
                                                                    <input type="hidden" name="id" value="'.$score['id'].'">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" name="score" class="form-control" placeholder="Nhập điểm" value="'.$score['score'].'">
                                                                        <button class="btn btn-success" type="submit">
                                                                            <i class="fas fa-check"></i> Lưu điểm
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://kit.fontawesome.com/0355850d71.js"></script>
    <script>
        $(document).ready(function () {});
        function onEditScore(elem) {
            if ($($(elem).children('.score-value')[0]).hasClass('hide')) {
                return false;
            }
            $($(elem).children('.score-value')[0]).addClass('hide');
            $($(elem).children('.score-form')[0]).removeClass('hide');
        }
        function onSubmitFormUpdateScore(event) {
            event.preventDefault();
            const form = event.target;
            let url = $(form).attr('action');
            let method = $(form).attr('method');
            let params = $(form).serializeArray();
            let formData = new FormData();
            $.each(params, function (i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $($(form).parent().parent().children('.score-value')[0]).removeClass('hide');
                    $($(form).parent().parent().children('.score-form')[0]).addClass('hide');
                },
                success: function(res) {
                    $($(form).parent().parent().children('.score-value')[0]).text(res);
                    $($(form).parent().parent().find('input[name=score]')[0]).val(res);
                },
                error: function (err) {
                    console.log(err);
                },
            });
        }
    </script>
</body>
</html>
<?php
    require './db/disconnect.php';
?>