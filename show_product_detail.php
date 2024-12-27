<?php
    include("database.php");
    // Lấy id sản phẩm từ URL
    if (isset($_GET['id'])) {
    $id_sp = $_GET['id'];
    // Truy vấn chi tiết sản phẩm theo id
    $sql = "SELECT * FROM sanpham WHERE MaMH = '$id_sp'";
    $query = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($query)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['tenMH']; ?></title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_cate.css">
    <link rel="stylesheet" href="css/header_menu_category.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/show_detail_pro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
    include("header.php");
?>

<!-- show detail -->
<div class="container">
        <div class="grid">
            <div class="row">
                <div class="col col_7">
                    <div class="show_product_detail">
                        <div class="row">
                            <div class="col col_3">
                                <div class="main_img_product">
                                    <img src="img/<?php echo $row['img']; ?>" alt="" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col col_2">
                                <div class="main_info_product">
                                        <h1><?php echo $row['tenMH']; ?></h1>
                                        <h2><?php echo number_format($row['gia'], 0, '.', ','); ?> đ</h2>
                                    <ul style="margin-left: 20px;">
                                        <li>SẢN PHẨM CAM KẾT CHÍNH HÃNG</li>
                                        <li>HÓA ĐƠN, CHỨNG TỪ ĐẦY ĐỦ</li>
                                        <li>MUA GIÁ SỈ LH : 0336.293.968 – 0394.334.199</li>
                                    </ul>
                                    <div class="option_select" style="margin-top: 20px;">
                                        <span style="margin-right: 20px">Phân loại</span>
                                        <select name="" id="" style="padding: 6px 10px">
                                            <option value="">Chọn</option>
                                            <option value="1">màu xanh</option>
                                            <option value="2">màu đỏ</option>
                                            <option value="3">màu hồng</option>
                                            <option value="4">màu vàng</option>
                                        </select>
                                    </div>
                                    <div class="quantity">
                                        <div class="quantity1">
                                        <form action="thanhtoan.php" method="GET" style="display: flex; align-items: center; gap: 10px;">
                                            <div class="" style="display: flex;">
                                                <!-- Nút giảm số lượng -->
                                                <button type="button" onclick="this.nextElementSibling.stepDown()" 
                                                        style="padding: 5px 10px; font-size: 18px; background-color: #ccc; border: 1px solid #ccc;">-</button>
                                                                    
                                                <!-- Ô nhập số lượng -->
                                                <input type="number" name="quantity" value="1" min="1" 
                                                       style="width: 60px; text-align: center; font-size: 16px; border: none;box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1); border: 1px solid #ccc">
                                                                    
                                                <!-- Nút tăng số lượng -->
                                                <button type="button" onclick="this.previousElementSibling.stepUp()" 
                                                        style="padding: 5px 10px; font-size: 18px; background-color: #ccc; border: 1px solid #ccc;">+</button>
                                            </div>
                                                                
                                            <!-- Ẩn ID sản phẩm -->
                                            <input type="hidden" name="id" value="<?php echo $row['MaMH']; ?>">
                                                                
                                            <!-- Nút MUA NGAY -->
                                            <button type="submit" 
                                                    style="padding: 5px 20px; font-size: 16px; background-color: #d26e4b; color: white; border: none; font-weight: bold;">
                                                THÊM VÀO GIỎ HÀNG
                                            </button>
                                            <button type="submit" 
                                                    style="padding: 5px 20px; font-size: 16px; background-color: #d26e4b; color: white; border: none; font-weight: bold;">
                                                MUA NGAY
                                            </button>

                                        </form>

                                        </div>
                                        <div class="" style="margin-left: 10px;">
                                            <!-- <form action="">
                                                <a href="" style="padding: 0px 20px; border: 1px solid rgba(204, 204, 204, 0.7);border: none;background-color: #d26e4b;font-weight: bold;font-size: 16px;color: white;line-height: 40px; display: inline-block; text-decoration: none">THÊM VÀO GIỎ HÀNG</a>
                                                <a href="thanhtoan.php?id=<?php echo $row['MaMH']; ?>" style="padding: 0px 20px; border: 1px solid rgba(204, 204, 204, 0.7);border: none;background-color: #d26e4b;font-weight: bold;font-size: 16px;color: white;line-height: 40px; display: inline-block; text-decoration: none">MUA NGAY</a>
                                            </form> -->
                                        </div>
                                    </div>

                                    <div class="line"></div>
                                    <span>Mã: <span><?php echo $row['MaMH'] ?></span></span>
                                    <div class="line"></div>
                                    <span style="display: block;">Danh mục: 
                                        <!-- <a href=""><?php echo $row['dm_parent']; ?>, </a> -->
                                        <a href=""><?php echo $row['danhmuc']; ?></a>
                                    </span>
                                    <div class="line"></div>
                                </div>
                            </div>

                            
                        </div>

                        <div class="describe">
                            <div style="border-top: 2px solid #bd163d; width: fit-content; margin-bottom: 30px; padding-top: 4px;font-weight: bold;">MÔ TẢ</div>
                            <span style="font-weight: bold;">Bút lông màu 2 đầu Acrylic Marker Deli EC187 – Sự lựa chọn hoàn hảo cho việc viết và vẽ</span>
                            <h3>Chất liệu:</h3>
                            <p>Bút lông Deli EC187 có thân bút được làm từ nhựa cao cấp, đảm bảo độ bền lâu dài. Đầu bút lông sử dụng sợi Polyester, cho nét bút nhỏ, dễ tô vẽ. Mực cao cấp không chứa chất huỳnh quang hay hóa chất độc hại, an toàn cho sức khỏe người sử dụng.</p>
                            <h3>Công dụng nổi bật:</h3>
                            <p>Bút lông màu 2 đầu Acrylic Marker Deli EC187 được thiết kế với 2 đầu bút tiện lợi: 1 đầu tròn nhọn và 1 đầu vuông, đáp ứng mọi nhu cầu viết, vẽ của người dùng. Màu sắc tươi sáng, phân lớp rõ ràng, cho ra những nét vẽ chính xác và trung thực. Đầu bút làm từ sợi mật độ cao, không trổ lông, chống nước và chịu nhiệt tốt, giúp bút bền lâu.</p>
                            <h3>Tính năng đặc biệt</h3>
                            <p>Bút lông Deli EC187 có thể chồng nhiều lớp màu mà không lo bị lem, đồng thời mực không thấm qua mặt sau của giấy, điều mà ít dòng bút lông nào có thể đạt được.</p>
                        </div>

                        <div class="same_product" style="border-top: 1px solid #ddd; margin-top: 20px;">
                            <h2 style="font-size: 22px;">SẢN PHẨM TƯƠNG TỰ</h2>
                        </div>
                    </div>
                </div>

                <div class="col col_4">
                    <div class="cate_detail"></div>
                </div>
            </div>
        </div>
    </div>
<?php
        }
    }
?>

    <!-- FOOTER -->
    <?php
        include("footer.php");
    ?>
</body>
</html>