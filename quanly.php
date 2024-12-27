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
        $tensp = $_POST['tensp'];
        $giasp = $_POST['giasp'];
        $danhmuc = $_POST['danhmuc'];
        $anh = $_FILES['anh']['name'];
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['anh']['name']);

        // Di chuyển ảnh đến thư mục đích
        if (move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)) {
            // Câu lệnh SQL để thêm sản phẩm
            $sql_add = "INSERT INTO sanpham (tensp, giasp, danhmuc, anh) VALUES ('$tensp', '$giasp', '$danhmuc', '$anh')";
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
    <title>Quản lý sản phẩm - Deli Việt Nam</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/quanly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="grid">
            <div class="row">
                <div class="col col_2">
                    <div class="menu" style="border: none; height: 100vh; box-shadow: 1px 1px 2px rgba(0, 0, 0, .24)">
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
                    <div class="container_manage">
                        <?php
                        // Xử lý xóa sản phẩm
                        if (isset($_GET['delete_id'])) {
                            $delete_id = $_GET['delete_id'];
                        
                            // Câu lệnh xóa sản phẩm khỏi cơ sở dữ liệu
                            $sql_delete_1 = "DELETE FROM dongdonhang WHERE MaMH = '$delete_id'";
                            $query_delete_1 = mysqli_query($conn, $sql_delete_1);
                            
                            $sql_delete = "DELETE FROM sanpham WHERE MaMH = '$delete_id'";
                            $query_delete = mysqli_query($conn, $sql_delete);
                        
                            // Kiểm tra nếu xóa thành công
                            if ($query_delete && $sql_delete_1) {
                                echo "<script>alert('Sản phẩm đã được xóa thành công!'); window.location.href = 'quanly.php?quanly=sanpham';</script>";
                            } else {
                                echo "<script>alert('Có lỗi xảy ra khi xóa sản phẩm.'); window.location.href = 'quanly.php?quanly=sanpham';</script>";
                            }
                        }
                        if (isset($_GET['delete_id_kh'])) {
                            $delete_id = $_GET['delete_id_kh'];
                        
                            // Câu lệnh xóa khach hang khỏi cơ sở dữ liệu
                            $sql_delete_1 = "DELETE FROM dondathang WHERE MaKH = '$delete_id'";
                            $query_delete_1 = mysqli_query($conn, $sql_delete_1);

                            $sql_delete = "DELETE FROM khachhang WHERE MaKH = '$delete_id'";
                            $query_delete = mysqli_query($conn, $sql_delete);
                        
                            // Kiểm tra nếu xóa thành công
                            if ($query_delete && $sql_delete_1) {
                                echo "<script>alert('Khách hàng đã được xóa thành công!'); window.location.href = 'quanly.php?quanly=khachhang';</script>";
                            } else {
                                echo "<script>alert('Có lỗi xảy ra khi xóa khách hàng.'); window.location.href = 'quanly.php?quanly=khachhnang';</script>";
                            }
                        }
                        
                        // Quản lý sản phẩm
                        if (isset($_GET['quanly']) && $_GET['quanly'] == 'sanpham') {
                            echo "<h1>Quản lý sản phẩm</h1>";
                            echo '<a href="add_product.php?quanly=sanpham&action=add" style="display: inline; border-radius: 5px; background-color: #bd163d; color: white;">Thêm sản phẩm</a>';
                            echo '<div id="add_product_form" style="display:none; margin-top: 20px;">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <label for="tensp">Mã sản phẩm:</label>
                                        <input type="text" id="MaMH" name="MaMH" required>
                                        <label for="tensp">Tên sản phẩm:</label>
                                        <input type="text" id="tensp" name="tensp" required>
                                        <label for="giasp">Giá sản phẩm:</label>
                                        <input type="text" id="giasp" name="giasp" required>
                                        <label for="danhmuc">Danh mục:</label>
                                        <input type="text" id="danhmuc" name="danhmuc" required>
                                        <label for="anh">Ảnh:</label>
                                        <input type="file" id="anh" name="anh" required>
                                        <button type="submit" name="add_product">Thêm sản phẩm</button>
                                    </form>
                                  </div>';

                            // Phân trang
                            $items_per_page = 5; // Số sản phẩm mỗi trang
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
                            $offset = ($page - 1) * $items_per_page; // Tính vị trí bắt đầu

                            // Lấy sản phẩm từ CSDL
                            $sql = "SELECT * FROM sanpham LIMIT $items_per_page OFFSET $offset";
                            $query = mysqli_query($conn, $sql);

                            // Tính tổng số trang
                            $sql_total = "SELECT COUNT(*) as total FROM sanpham";
                            $result_total = mysqli_query($conn, $sql_total);
                            $total_items = mysqli_fetch_assoc($result_total)['total'];
                            $total_pages = ceil($total_items / $items_per_page);

                            // Hiển thị bảng sản phẩm
                            echo '<div style="margin-top: 20px; text-align: center;">';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<div style=" display: flex; margin: 0px 10px; width: 40px; height: 40px; border-radius: 50%; display: inline-block;">';
                                $active = ($i == $page) ? 'style="font-weight: bold; color: red;margin: auto; display: block; padding: 10px 10px;"' : '';
                                echo "<a href='quanly.php?quanly=sanpham&page=$i' $active style='margin-right:0px 10px;; display: block;'>$i</a>";
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<table style="width: 100%; border: 1px solid; margin-top: 20px; text-align: center;">
                                    <tr>
                                        <th>ID sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Ảnh</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>';

                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                        <td>{$row['MaMH']}</td>
                                        <td>{$row['tenMH']}</td>
                                        <td>" . number_format($row['gia'], 3) . " đ</td>
                                        <td>{$row['danhmuc']}</td>
                                        <td><img src='img/{$row['img']}' style='width: 120px;'></td>
                                        <td><a href='edit_product.php?id={$row['MaMH']}' style='background-color: #007bff; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Sửa</a></td>
                                        <td><a href='quanly.php?quanly=sanpham&delete_id={$row['MaMH']}' style='background-color: #bd163d; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Xóa</a></td>
                                      </tr>";
                            }
                            echo '</table>';

                        } else if(isset($_GET['quanly']) && $_GET['quanly'] == 'khachhang')  {
                            echo "<h1>Quản lý khách hàng</h1>";
                            echo '<a href="add_user.php?quanly=khachhang&action=add" style="display: inline; border-radius: 5px; background-color: #bd163d; color: white;">Thêm khách hàng</a>';
                            echo '<div id="add_product_form" style="display:none; margin-top: 20px;">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <label for="tensp">Tên khách hàng:</label>
                                        <input type="text" id="tenKH" name="tenKH" required>
                                        <label for="giasp">Địa chỉ:</label>
                                        <input type="text" id="Diachi" name="Diachi" required>
                                        <label for="danhmuc">Số điện thoại:</label>
                                        <input type="text" id="SDT" name="SDT" required>
                                        <label for="anh">ID:</label>
                                        <input type="file" id="img" name="anh" required>
                                        <button type="submit" name="add_product">Thêm sản phẩm</button>
                                    </form>
                                  </div>';

                            // Phân trang
                            $items_per_page = 5; // Số sản phẩm mỗi trang
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
                            $offset = ($page - 1) * $items_per_page; // Tính vị trí bắt đầu

                            // Lấy sản phẩm từ CSDL
                            $sql = "SELECT * FROM khachhang LIMIT $items_per_page OFFSET $offset";
                            $query = mysqli_query($conn, $sql);

                            // Tính tổng số trang
                            $sql_total = "SELECT COUNT(*) as total FROM khachhang";
                            $result_total = mysqli_query($conn, $sql_total);
                            $total_items = mysqli_fetch_assoc($result_total)['total'];
                            $total_pages = ceil($total_items / $items_per_page);

                            // Hiển thị bảng sản phẩm
                            echo '<div style="margin-top: 20px; text-align: center;">';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<div style=" display: flex; margin: 0px 10px; width: 40px; height: 40px; border-radius: 50%; display: inline-block;">';
                                $active = ($i == $page) ? 'style="font-weight: bold; color: red;margin: auto; display: block; padding: 10px 10px;"' : '';
                                echo "<a href='quanly.php?quanly=user&page=$i' $active style='margin-right:0px 10px;; display: block;'>$i</a>";
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<table style="width: 100%; border: 1px solid; margin-top: 20px; text-align: center;">
                                    <tr>
                                        <th>ID khách hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>SĐT</th>
                                        <th>Email</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>';

                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                        <td>{$row['MaKH']}</td>
                                        <td>{$row['tenKH']}</td>
                                        <td>{$row['Diachi']}</td>
                                        <td>{$row['SDT']}</td>
                                        <td>{$row['email']}</td>
                                        <td><a href='edit_user.php?id={$row['MaKH']}' style='background-color: #007bff; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Sửa</a></td>
                                        <td><a href='quanly.php?quanly=user&delete_id_kh={$row['MaKH']}' style='background-color: #bd163d; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Xóa</a></td>
                                      </tr>";
                            }
                            echo '</table>';
                        }else if(isset($_GET['quanly']) && $_GET['quanly'] == 'donhang'){
                            echo "<h1>Quản lý đơn hàng</h1>";
                            echo '<a href="add_donhang.php?quanly=donhang&action=add" style="display: inline; border-radius: 5px; background-color: #bd163d; color: white;">Thêm đơn hàng</a>';
                            echo '<div id="add_donhang_form" style="display:none; margin-top: 20px;">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <label for="tensp">Tên khách hàng:</label>
                                        <input type="text" id="tensp" name="tensp" required>
                                        <label for="giasp">Địa chỉ:</label>
                                        <input type="text" id="giasp" name="giasp" required>
                                        <label for="danhmuc">Số điện thoại:</label>
                                        <input type="text" id="danhmuc" name="danhmuc" required>
                                        <label for="anh">ID:</label>
                                        <input type="file" id="anh" name="anh" required>
                                        <button type="submit" name="add_product">Thêm sản phẩm</button>
                                    </form>
                                  </div>';

                            // Phân trang
                            $items_per_page = 5; // Số sản phẩm mỗi trang
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
                            $offset = ($page - 1) * $items_per_page; // Tính vị trí bắt đầu

                            // Lấy sản phẩm từ CSDL
                            $sql = "SELECT dondathang.MaDH AS id_donhang, khachhang.tenKH, sanpham.tenMH, dondathang.TrangThai, dongdonhang.Soluong
                                    FROM dondathang
                                    INNER JOIN khachhang ON dondathang.MaKH = khachhang.MaKH
                                    INNER JOIN dongdonhang ON dondathang.MaDH = dongdonhang.MaDH
                                    INNER JOIN sanpham ON dongdonhang.MaMH = sanpham.MaMH 
                                    LIMIT $items_per_page OFFSET $offset";

                            $query = mysqli_query($conn, $sql);

                            // Tính tổng số trang
                            $sql_total = "SELECT COUNT(*) as total FROM dondathang";
                            $result_total = mysqli_query($conn, $sql_total);
                            $total_items = mysqli_fetch_assoc($result_total)['total'];
                            $total_pages = ceil($total_items / $items_per_page);

                            // Hiển thị bảng sản phẩm
                            echo '<div style="margin-top: 20px; text-align: center;">';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<div style=" display: flex; margin: 0px 10px; width: 40px; height: 40px; border-radius: 50%; display: inline-block;">';
                                $active = ($i == $page) ? 'style="font-weight: bold; color: red;margin: auto; display: block; padding: 10px 10px;"' : '';
                                echo "<a href='quanly.php?quanly=donhang&page=$i' $active style='margin-right:0px 10px;; display: block;'>$i</a>";
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<table style="width: 100%; border: 1px solid; margin-top: 20px; text-align: center;">
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>';

                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                        <td>{$row['id_donhang']}</td>
                                        <td>{$row['tenKH']}</td>
                                        <td>{$row['tenMH']}</td>
                                        <td>{$row['Soluong']}</td>
                                        <td>{$row['TrangThai']}</td>
                                        <td><a href='edit_order.php?id={$row['id_donhang']}' style='background-color: #007bff; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Sửa</a></td>
                                        <td><a href='quanly.php?quanly=donhang&delete_id_dh={$row['id_donhang']}' style='background-color: #bd163d; color: white; border: none; padding: 5px 10px;text-align: center; border-radius: 5px'>Xóa</a></td>
                                      </tr>";
                            }
                            echo '</table>';
                        }if (isset($_GET['quanly']) && $_GET['quanly'] == 'doanhthu') {
                            echo "<h1>Quản lý doanh thu</h1>";
                            $selected_month = isset($_GET['month']) ? $_GET['month'] : '';  // Giá trị tháng chọn
                            echo '
                                <span style="margin-right: 20px">Lọc theo tháng</span>
                                <select name="month_filter" id="month_filter" style="padding: 6px 10px" onchange="window.location.href=this.value;">
                                    <option value="">Chọn</option>
                                    <option value="?quanly=doanhthu&month=1" ' . ($selected_month == '1' ? 'selected' : '') . '>1</option>
                                    <option value="?quanly=doanhthu&month=2" ' . ($selected_month == '2' ? 'selected' : '') . '>2</option>
                                    <option value="?quanly=doanhthu&month=3" ' . ($selected_month == '3' ? 'selected' : '') . '>3</option>
                                    <option value="?quanly=doanhthu&month=4" ' . ($selected_month == '4' ? 'selected' : '') . '>4</option>
                                    <option value="?quanly=doanhthu&month=5" ' . ($selected_month == '5' ? 'selected' : '') . '>5</option>
                                    <option value="?quanly=doanhthu&month=6" ' . ($selected_month == '6' ? 'selected' : '') . '>6</option>
                                    <option value="?quanly=doanhthu&month=7" ' . ($selected_month == '7' ? 'selected' : '') . '>7</option>
                                    <option value="?quanly=doanhthu&month=8" ' . ($selected_month == '8' ? 'selected' : '') . '>8</option>
                                    <option value="?quanly=doanhthu&month=9" ' . ($selected_month == '9' ? 'selected' : '') . '>9</option>
                                    <option value="?quanly=doanhthu&month=10" ' . ($selected_month == '10' ? 'selected' : '') . '>10</option>
                                    <option value="?quanly=doanhthu&month=11" ' . ($selected_month == '11' ? 'selected' : '') . '>11</option>
                                    <option value="?quanly=doanhthu&month=12" ' . ($selected_month == '12' ? 'selected' : '') . '>12</option>
                                </select>
                            ';
                            // Cập nhật total cho từng hóa đơn
                            $sql_hoadon = "SELECT MaDH FROM hoadon";
                            $result_hoadon = mysqli_query($conn, $sql_hoadon);
                            while ($order = mysqli_fetch_assoc($result_hoadon)) {
                                    $id_dh = $order['MaDH'];
                        
                                    $sql_total = "  SELECT SUM(dh.Soluong * sp.gia) AS total
                                                    FROM dongdonhang dh
                                                    INNER JOIN dondathang ON dh.MaDH = dondathang.MaDH
                                                    INNER JOIN sanpham sp ON dh.MaMH = sp.MaMH
                                                    WHERE dh.MaDH = '$id_dh' 
                                                    AND dondathang.TrangThai = 'Hoàn thành'";
                                    $result_total = mysqli_query($conn, $sql_total);
                                    $total = 0;
                        
                                    if ($row_total = mysqli_fetch_assoc($result_total)) {
                                        $total = $row_total['total'] ?? 0;
                                    }


                                    $sql_update = " UPDATE hoadon 
                                                    INNER JOIN dondathang ON hoadon.MaDH = dondathang.MaDH
                                                    SET hoadon.Tongtien = $total 
                                                    WHERE hoadon.MaDH = '$id_dh'";
                                    mysqli_query($conn, $sql_update);
                            }
                        
                            // Hiển thị bảng doanh thu
                            echo "
                                <table style='width: 100%; border: 1px solid; margin-top: 20px; text-align: center;'>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã hóa đơn</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày hóa đơn</th>
                                    </tr>
                            ";

                            // Lấy danh sách hóa đơn
                            $sql = "SELECT * FROM hoadon
                                    INNER JOIN dondathang ON hoadon.MaDH = dondathang.MaDH
                                    WHERE dondathang.TrangThai = 'Hoàn thành'";
                            // Lọc theo tháng nếu có
                            if (!empty($selected_month)) {
                                // dấu chấm nối các chuỗi
                                $sql .= " AND MONTH(hoadon.NgayHD) = '$selected_month'"; 
                            }
                            
                            $query = mysqli_query($conn, $sql);
                        
                            $total_price = 0;
                            $stt = 1;

                            // Lấy doanh thu tháng trước
                            $selected_month = intval($selected_month);
                            $previous_month = $selected_month - 1;
                            if ($previous_month == 0) {
                                $previous_month = 12; // Nếu là tháng 1, thì tháng trước là tháng 12
                            }

                            $sql_previous_month = "SELECT SUM(hoadon.Tongtien) AS total_previous
                                                   FROM hoadon
                                                   INNER JOIN dondathang ON hoadon.MaDH = dondathang.MaDH
                                                   WHERE MONTH(hoadon.NgayHD) = $previous_month
                                                   AND dondathang.TrangThai = 'Hoàn thành'";
                            $result_previous_month = mysqli_query($conn, $sql_previous_month);
                            $row_previous_month = mysqli_fetch_assoc($result_previous_month);
                            $total_previous_month = $row_previous_month['total_previous'] ?? 0;

                            while ($row = mysqli_fetch_assoc($query)) {
                                $total_price += $row['Tongtien'];
                                $difference = $total_price - $total_previous_month;
                                echo "
                                    <tr>
                                        <td>{$stt}</td>
                                        <td>{$row['MaDH']}</td>";
                                        echo "<td>" . number_format($row['Tongtien'], 0, '.', ','); echo "</td>";
                                        echo "<td>{$row['NgayHD']}</td>
                                    </tr>
                                ";
                                $stt++;
                            }
                            echo "</table>";
                            echo "<div style='width: 100%; border: 1px solid black; margin: 20px 0px;'></div>";
                            if ((!empty($selected_month)) && (!empty($previous_month))) {
                                echo "Tổng doanh thu tháng " .$selected_month. ": <span style='margin-left: 20px;'> <strong style='font-weight: bold;'> " . number_format($total_price, 0, '.', ',') . "</strong><br>";
                                if(!empty($difference)){
                                    echo "Tổng doanh thu tháng " .$previous_month. ": <span style='margin-left: 20px;'> <strong style='font-weight: bold; margin-top: 10px; display: inline-block;'> " . number_format($difference, 0, '.', ',') . "</strong>";
                                }
                            }else{
                                echo "Tổng doanh thu: <span style='margin-left: 20px;'> <strong style='font-weight: bold;'>" . number_format($total_price, 0, '.', ',') . "</strong>";

                            }
                        
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

