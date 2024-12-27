<?php

    include("database.php");

    session_start();

    if (!isset($_GET['id'])) {
        header("Location: quanly.php?quanly=sanpham");
        exit();
}

$id = $_GET['id'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM sanpham WHERE MaMH = '$id'";
$query = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý form sửa sản phẩm
    $tensp = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    $danhmuc = $_POST['danhmuc'];
    $anh = $_POST['anh']; // Cập nhật tên ảnh, nếu cần

    // Cập nhật sản phẩm trong cơ sở dữ liệu
    $sql_update = "UPDATE sanpham SET MaMH = '$id', tenMH = '$tensp', gia = '$giasp', Mota = '', danhmuc = '$danhmuc', img = '$anh' WHERE MaMH = '$id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='quanly.php?quanly=sanpham';</script>";
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
    <title>Sửa sản phẩm - Deli Việt Nam</title>
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
                    <h1>Sửa sản phẩm</h1>
                    <form action="edit_product.php?id=<?php echo $product['MaMH']; ?>" method="POST">
                        <div>
                            <label for="tensp">Tên sản phẩm:</label>
                            <input type="text" id="tensp" name="tensp" value="<?php echo $product['tenMH']; ?>" required>
                        </div>
                        <div>
                            <label for="giasp">Giá sản phẩm:</label>
                            <input type="text" id="giasp" name="giasp" value="<?php echo $product['gia']; ?>" required>
                        </div>
                        <div>
                            <label for="danhmuc">Danh mục:</label>
                            <input type="text" id="danhmuc" name="danhmuc" value="<?php echo $product['danhmuc']; ?>" required>
                        </div>
                        <div>
                            <label for="anh">Ảnh:</label>
                            <input type="file" id="anh" name="anh" value="<?php echo $product['img']; ?>">
                        </div>
                        <div>
                            <button type="submit">Cập nhật sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
