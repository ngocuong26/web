<?php
    session_start();  // Bắt đầu session

    include("database.php");  // Kết nối cơ sở dữ liệu

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION['user'])) {
        header("Location: index.php");
        // Hiển thị liên kết đăng xuất nếu đã đăng nhập
        // echo '<a href="logout.php">Đăng xuất</a>';
        exit();  // Dừng script nếu đã đăng nhập
    }

    // Xử lý đăng nhập
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Làm sạch dữ liệu đầu vào (tránh XSS hoặc SQL Injection)
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        // Chuẩn bị câu truy vấn SQL để tìm người dùng
        $sql = "SELECT * FROM nguoidung WHERE Tendangnhap = ? AND Matkhau = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu truy vấn: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra xem có người dùng nào với tên đăng nhập và mật khẩu này không
        if ($result->num_rows > 0) {
            // Đăng nhập thành công
            $_SESSION['user'] = $username;  // Lưu thông tin người dùng vào session
            header("Location: index.php");  // Chuyển hướng đến trang chủ
            exit();
        } else {
            // Sai tên đăng nhập hoặc mật khẩu
            echo "Sai tên đăng nhập hoặc mật khẩu.";
        }

        $stmt->close();
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Deli Việt Nam</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/log_in.css">
</head>
<body>
    <div class="container_login">
        <div class="login">
            <h2>Welcome to Deli Vietnam</h2>
            <div class="line"></div>
            <!-- Form Đăng nhập -->
            <form action="" method="post">
                <label for="username">Username</label>
                <input type="email" name="username" id="username" placeholder="your-email@domain.com" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your password" required>
                <input type="submit" name="login" value="Log in" class='btn'>
            </form>
        </div>
    </div>
</body>
</html>
