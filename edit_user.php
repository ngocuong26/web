<?php
    include("database.php");
    session_start();

    if (!isset($_GET['id'])) {
        header("Location: quanly.php?quanly=khachhang");
        exit();
    }

    $id = $_GET['id'];

    // Lấy thông tin khách hàng từ cơ sở dữ liệu
    $sql = "SELECT * FROM khachhang WHERE MaKH = '$id'";
    $query = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Xử lý form sửa khách hàng
        $tenkh = $_POST['tenkh'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $id_kh = $_POST['email']; // Cập nhật tên ảnh, nếu cần

        // Cập nhật khách hàng trong cơ sở dữ liệu
        $sql_update = "UPDATE khachhang SET tenKH = '$tenkh', Diachi = '$diachi', SDT = '$sdt', email = '$id_kh' WHERE MaKH = '$id'";
        if (mysqli_query($conn, $sql_update)) {
            echo "<script>alert('Cập nhật khách hàng thành công!'); window.location.href='quanly.php?quanly=khachhang';</script>";
        } else {
            echo "<script>alert('Cập nhật khách hàng thất bại!');</script>";
        }
    }
?>

<?php
    // Xử lý xóa khách hàng
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Câu lệnh xóa khách hàng khỏi cơ sở dữ liệu
        $sql_delete = "DELETE FROM khachhang WHERE id_kh = $delete_id";
        $query_delete = mysqli_query($conn, $sql_delete);

        // Kiểm tra nếu xóa thành công
        if ($query_delete) {
            echo "<script>alert('Khách hàng đã được xóa thành công!'); window.location.href = 'quanly.php?quanly=khachhang';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi xóa khách hàng.'); window.location.href = 'quanly.php?quanly=khachhang';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>Sửa thông tin khách hàng - Deli Việt Nam</title>
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
                    <h1>Sửa thông tin khách hàng</h1>
                    <form action="edit_user.php?id=<?php echo $customer['MaKH']; ?>" method="POST">
                        <div>
                            <label for="tenkh">Tên khách hàng:</label>
                            <input type="text" id="tenkh" name="tenkh" value="<?php echo $customer['tenKH']; ?>" required>
                        </div>
                        <div>
                            <label for="diachi">Địa chỉ:</label>
                            <input type="text" id="diachi" name="diachi" value="<?php echo $customer['Diachi']; ?>" required>
                        </div>
                        <div>
                            <label for="sdt">Số điện thoại:</label>
                            <input type="text" id="sdt" name="sdt" value="<?php echo $customer['SDT']; ?>" required>
                        </div>
                        <div>
                            <label for="id">Email:</label>
                            <input type="text" id="eamail" name="email" value="<?php echo $customer['email']; ?>">
                        </div>
                        <div>
                            <button type="submit">Cập nhật khách hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
