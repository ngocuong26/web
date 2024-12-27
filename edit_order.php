<?php

    include("database.php");

    session_start();

    if (!isset($_GET['id'])) {
        header("Location: quanly.php?quanly=donhang");
        exit();
}

$id = $_GET['id'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM dondathang WHERE MaDH = '$id'";
$query = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý form sửa sản phẩm
   
    $state = $_POST['state'];

    // Cập nhật sản phẩm trong cơ sở dữ liệu
    $sql_update = "UPDATE dondathang SET TrangThai = '$state' WHERE MaDH = '$id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='quanly.php?quanly=donhang';</script>";
    } else {
        echo "<script>alert('Cập nhật sản phẩm thất bại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>Sửa đơn hàng - Deli Việt Nam</title>
    <link rel="stylesheet" href="css/quanly.css">
    <link rel="stylesheet" href="css/edit_product.css">
</head>
<body>
    <div class="container">
        <div class="grid">
            <div class="row">
                <div class="col col_2">
                    <div class="menu">
                        <ul>
                            <li><a href="quanly.php?quanly=sanpham">Quản lý sản phẩm</a></li>
                            <li><a href="quanly.php?quanly=khachhang">Quản lý khách hàng</a></li>
                            <li><a href="quanly.php?quanly=donhang">Quản lý đơn hàng</a></li>
                            <li><a href="quanly.php?quanly=doanhthu">Quản lý doanh thu</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col_10">
                    <h1>Sửa đơn đặt hàng</h1>
                    <form action="edit_order.php?id=<?php echo $order['MaDH']; ?>" method="POST">
                        <div>
                            <label for="danhmuc">Trạng thái:</label>
                            <input type="text" id="state" name="state" value="<?php echo $order['TrangThai']; ?>" required>
                        </div>
                        <div>
                            <button type="submit">Cập nhật đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
