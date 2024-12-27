<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Deli Việt Nam</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_cate.css">
    <link rel="stylesheet" href="css/header_menu_category.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/thanhtoan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        include("database.php");
        include("header.php");
    ?>
<?php
// session_start(); // Bắt đầu session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra người dùng đã đăng nhập chưa
    if (isset($_SESSION['user'])) {
        $customer_id = $_SESSION['user']; // Lấy ID khách hàng từ session
        
        // Lấy MaKH của khách hàng từ bảng khachhang
        $query = "SELECT MaKH FROM khachhang WHERE email = '$customer_id'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $id_kh = $row['MaKH']; // Lấy MaKH hợp lệ
        }

        // Tạo ID đơn hàng ngẫu nhiên
        function generateOrderID($length = 10) {
            return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $length));
        }

        // Tạo ID đơn hàng và kiểm tra trùng lặp
        do {
            $order_id = generateOrderID(); // Tạo ID ngẫu nhiên
            $check_query = "SELECT MaDH FROM dondathang WHERE MaDH = '$order_id'";
            $result = mysqli_query($conn, $check_query);
        } while (mysqli_num_rows($result) > 0); // Nếu trùng lặp, tạo lại ID

        do {
            $receipt_id = generateOrderID(); // Tạo ID ngẫu nhiên
            $check_query = "SELECT MaDH FROM dondathang WHERE MaDH = '$receipt_id'";
            $result = mysqli_query($conn, $check_query);
        } while (mysqli_num_rows($result) > 0);

        // Lấy thông tin từ form
        $full_name = $_POST['full_name'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $payment_method = $_POST['payment_method'];
        $current_date = date('Y-m-d'); // Ngày hiện tại
        if ($payment_method == 'cod') {
            $payment_method_name = 'Thanh toán khi nhận hàng (COD)';
        } elseif ($payment_method == 'transfer') {
            $payment_method_name = 'Chuyển khoản ngân hàng';
        } else {
            $payment_method_name = 'Không xác định';
        }
        $sql = "SELECT * FROM sanpham WHERE MaMH = '$product_id'";
        $query = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($query)) {
            $total = $quantity * $row['gia']; // Tính tổng tiền
        }

        // Chèn thông tin vào bảng donhang
        $sql = "INSERT INTO dondathang (MaDH, NgayDH, TrangThai, MaKH, Tongtien)
                VALUES ('$order_id', '$current_date',  'Đang xử lý', '$id_kh', '$total')";
        $sql_2 = "INSERT INTO dongdonhang (MaDH, MaMH, SoLuong)
                VALUES ('$order_id', '$product_id', '$quantity')";
        $sql_3 = "INSERT INTO hoadon (MaHD, MaDH, Tongtien, NgayHD)
                VALUES ('$receipt_id', '$order_id', '$total', '$current_date')";
        if (mysqli_query($conn, $sql)) {
            if (mysqli_query($conn, $sql_2)) {
                if(mysqli_query($conn, $sql_3)){
                    echo "
                    <div style='background-color: #e9ecef; padding: 40px 0px 80px 0px;'>
                    <div class='container' style='display: flex;'>
                        <div class='receipt' style='margin: auto;'>
                            <div class='content' style='border-top: 3px solid #74b816;'>
                                <i class='fa-solid fa-circle-check' style='font-size: 40px; color: #74b816'></i>
                                <h2>Đặt hàng thành công</h2>
                                <p>Mã đơn hàng $order_id </p>
                                <hr />
                                <p style='margin-bottom: 10px;'><strong>Thông tin giao hàng</strong></p>
                                <p>Người nhận: $full_name </p>
                                <p>SĐT: $phone_number </p>
                                <p>Địa chỉ: $address </p>
                                <hr />
                                <p style='margin-bottom: 10px;'><strong>Phương thức thanh toán</strong></p>
                                <p style='margin-bottom: 50px;'> $payment_method_name </p>
                            </div>
                            <div class='zigzag'>
                                <img src='img/receipt.png' alt=''>
                            </div>
                        </div>
                    </div>
                    </div>";
                }
            }
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Bạn cần đăng nhập để đặt hàng.";
    }
}
echo "
    ";
?>

<!-- FOOTER -->
<?php
        include("footer.php");
    ?>
