<?php
// Kết nối cơ sở dữ liệu
include("database.php");

// Bắt đầu session để quản lý đăng nhập
session_start();

// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Xử lý thêm người dùng
if (isset($_POST['add_user'])) {
    $makh = $_POST['makh'];
    $tenkh = $_POST['tenkh'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $user_id = $_POST['user_id'];

    // Câu lệnh SQL để thêm người dùng
    $sql_add = "INSERT INTO khachhang (MaKH, tenKH, Diachi, SDT, email, mauser) VALUES ('$makh', '$tenkh', '$diachi', '$sdt', '$email', '$user_id')";
    $query_add = mysqli_query($conn, $sql_add);

    // Kiểm tra nếu thêm thành công
    if ($query_add) {
        echo "<script>alert('Người dùng đã được thêm thành công!'); window.location.href = 'quanly.php?quanly=khachhang';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi thêm người dùng.'); window.location.href = 'quanly.php?quanly=khachhang';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng - Deli Việt Nam</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/quanly.css">
    <link rel="stylesheet" href="css/edit_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="grid">
            <div class="row">
                <div class="col col_2">
                    <div class="menu">
                        <?php
                        // Hiển thị thông tin người dùng
                        if (isset($_SESSION['user'])) {
                            $username = $_SESSION['user'];
                            echo "<div class='login_link'><p style='color: white; font-weight: bold;'>Xin chào, $username</p></div>";
                            echo "<div>
                                    <form method='POST' action=''>
                                        <button type='submit' name='logout' style='background-color:#bd163d; color:white; border:none; padding:10px 20px; border-radius:5px;'>Đăng xuất</button>
                                    </form>
                                  </div>";
                        }
                        ?>
                        <ul>
                            <li><a href="quanly.php?quanly=sanpham">Quản lý sản phẩm</a></li>
                            <li><a href="quanly.php?quanly=khachhang">Quản lý khách hàng</a></li>
                            <li><a href="quanly.php?quanly=donhang">Quản lý đơn hàng</a></li>
                            <li><a href="quanly.php?quanly=doanhthu">Quản lý doanh thu</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col_10">
                    <h1>Thêm người dùng</h1>
                    <form action="add_user.php" method="POST">
                        <div>
                            <label for="tenkh">Mã khách hàng:</label>
                            <input type="text" id="makh" name="makh" required>
                        </div>
                        <div>
                            <label for="tenkh">Tên khách hàng:</label>
                            <input type="text" id="tenkh" name="tenkh" required>
                        </div>
                        <div>
                            <label for="diachi">Địa chỉ:</label>
                            <input type="text" id="diachi" name="diachi" required>
                        </div>
                        <div>
                            <label for="sdt">Số điện thoại:</label>
                            <input type="text" id="sdt" name="sdt" required>
                        </div>
                        <div>
                            <label for="id_user">Email:</label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="id_user">User:</label>
                            <input type="text" id="user_id" name="user_id" required>
                        </div>
                        <div>
                            <button type="submit" name="add_user">Thêm người dùng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
