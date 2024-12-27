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

    // Xử lý thêm sản phẩm
    if (isset($_POST['add_product'])) {
        $masp = $_POST['masp'];
        $tensp = $_POST['tensp'];
        $giasp = $_POST['giasp'];
        $danhmuc = $_POST['danhmuc'];
        $anh = $_FILES['anh']['name'];
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['anh']['name']);

        // Di chuyển ảnh đến thư mục đích
        if (move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)) {
            // Câu lệnh SQL để thêm sản phẩm
            $sql_add = "INSERT INTO sanpham (MaMH, tenMH, gia, Mota, danhmuc, img) VALUES ('$masp','$tensp', '$giasp', '', '$danhmuc', '$anh')";
            $query_add = mysqli_query($conn, $sql_add);

            // Kiểm tra nếu thêm thành công
            if ($query_add) {
                echo "<script>alert('Sản phẩm đã được thêm thành công!'); window.location.href = 'quanly.php?quanly=sanpham';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi thêm sản phẩm.'); window.location.href = 'quanly.php?quanly=sanpham';</script>";
            }
        } else {
            echo "<script>alert('Có lỗi xảy ra khi tải lên ảnh.'); window.location.href = 'quanly.php?quanly=sanpham';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - Deli Việt Nam</title>
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
                            <!-- <li><a href="add_product.php">Thêm sản phẩm</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col col_10">
                    <h1>Thêm sản phẩm</h1>
                    <form action="add_product.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <label for="tensp">Mã sản phẩm:</label>
                            <input type="text" id="masp" name="masp" required>
                        </div>
                        <div>
                            <label for="tensp">Tên sản phẩm:</label>
                            <input type="text" id="tensp" name="tensp" required>
                        </div>
                        <div>
                            <label for="giasp">Giá sản phẩm:</label>
                            <input type="text" id="giasp" name="giasp" required>
                        </div>
                        <div>
                            <label for="danhmuc">Danh mục:</label>
                            <input type="text" id="danhmuc" name="danhmuc" required>
                        </div>
                        <div>
                            <label for="anh">Ảnh:</label>
                            <input type="file" id="anh" name="anh" required>
                        </div>
                        <div>
                            <button type="submit" name="add_product">Thêm sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
