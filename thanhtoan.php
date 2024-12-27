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
<form action="thanhtoan_tc.php" method="POST">
    <div class="grid">
        <div class="row">
            <div class="col col_2">
                <strong style="margin-top: 20px; font-size: 18px;">THÔNG TIN THANH TOÁN</strong>
                <div class="container_pay_left">
                    <div class="info_left_pay">
                        <div class="infor_left_pay-items">
                            <label for="">Họ và tên *</label>
                            <input type="text" name="full_name" id="" placeholder="Nhập đầy đủ họ và tên của bạn" required>
                        </div>
                        <div class="infor_left_pay-items">
                            <label for="">Địa chỉ email*</label>
                            <input type="text" name="email_address" id="" required>
                        </div>
                        <div class="infor_left_pay-items">
                            <label for="">Quận/Huyện *</label>
                            <input type="text" name="district" id="" placeholder="Chọn quận/huyện" required>
                        </div>
                    </div>
                    <div class="info_right_pay">
                        <div class="infor_left_pay-items">
                            <label for="">Số điện thoại *</label>
                            <input type="text" name="phone_number" id="" required>
                        </div>
                        <div class="infor_left_pay-items">
                            <label for="">Tỉnh/Thành phố *</label>
                            <input type="text" name="city" id="" required>
                        </div>
                        <div class="infor_left_pay-items">
                            <label for="">Xã/Phường/Thị trấn *</label>
                            <input type="text" name="province" id="" placeholder="Chọn xã/phường/thị trấn" required>
                        </div>
                    </div>
                </div>
                <div class="info_address" style="width: 100%;">
                    <label for="">Địa chỉ *</label>
                    <input type="text" name="address" placeholder="Ví dụ: Số 18 Ngõ 86 Phú Kiều" required>
                </div>
                <strong style="margin: 30px 0px 20px 0px; display: block;">THÔNG TIN BỔ SUNG</strong>
                <div class="info_note" style="width: 100%;">
                    <label for="">Ghi chú đơn hàng (nếu có)</label>
                    <textarea name="note" id="" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                </div>
            </div>
            <div class="col col_3">
                <div class="container_pay_right">
                    <strong style="margin: 30px 0px;">ĐƠN HÀNG CỦA BẠN</strong>
                    <div class="grid_pay">
                        <div class="row">
                            <div class="col col_10">
                                <strong style="font-weight: bold;" class="text_bold">SẢN PHẨM</strong>
                            </div>
                            <div class="col col_2_pay">
                                <strong style="font-weight: bold;" class="text_bold">TẠM TÍNH</strong>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col col_10">
                                <strong style="font-weight: bold;" class="text_bold">SL</strong>
                            </div>
                            <div class="col col_2_pay">
                                <strong style="font-weight: bold;" class="text_bold">TẠM TÍNH</strong>
                            </div>
                        </div> -->
                    </div>

                    <div class="line" style="border-bottom: 3px solid rgba(204, 204, 204, 0.7);"></div>

                    <?php
                        // Lấy id sản phẩm từ URL
                        if (isset($_GET['id']) && isset($_GET['quantity'])) {
                            $id_sp = $_GET['id'];
                            $quantity = $_GET['quantity'];
                            // Truy vấn chi tiết sản phẩm theo id
                            $sql = "SELECT * FROM sanpham WHERE MaMH = '$id_sp'";
                            $query = mysqli_query($conn, $sql);
                            if ($row = mysqli_fetch_assoc($query)) {
                                $total = $quantity * $row['gia'];
                    ?>

                    <div class="grid_pay">
                        <div class="row">
                            <div class="col col_10">
                                <p style="font-size: 16px;"><?php echo $row['tenMH']; ?></p>
                            </div>
                            <div class="col col_2_pay">
                                <strong class="text_bold"><?php echo $row['gia']; ?> ₫</strong>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>

                    <div class="grid_pay">
                        <div class="row">
                            <div class="col col_10">
                                <p style="font-size: 14px;">Số lượng</p>
                            </div>
                            <div class="col col_2_pay">
                                <strong class="text_bold"><?php echo $quantity; ?></strong>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>

                    <div class="grid_pay">
                        <div class="row">
                            <div class="col col_10">
                                <p style="font-size: 14px; font-weight: bold;">Tạm tính</p>
                            </div>
                            <div class="col col_2_pay">
                                <strong class="text_bold"><?php echo number_format($total, 3, '.', ','); ?> ₫</strong>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>

                    <div class="grid_pay">
                        <div class="row">
                            <div class="col col_10">
                                <p style="font-size: 14px; font-weight: bold;">Tổng</p>
                            </div>
                            <div class="col col_2_pay">
                                <strong class="text_bold"><?php echo number_format($total, 3, '.', ','); ?> ₫</strong>
                            </div>
                        </div>
                    </div>

                    <?php
                            }
                        }
                    ?>

                    <div class="line" style="    border-bottom: 3px solid rgba(204, 204, 204, 0.7);"></div>
                    
                    <strong style="font-size: 16px; margin-bottom: 20px;">CHỌN PHƯƠNG THỨC THANH TOÁN</strong>

                    <input type="radio" name="payment_method" id="payment_cod" value="cod">
                    <label for="" style="font-size: 14px; font-weight: bold;">Thanh toán khi nhận hàng</label><br>
                    <input type="radio" name="payment_method" id="payment_transfer" value="transfer">
                    <label for="" style="font-size: 14px; font-weight: bold;">Chuyển khoản ngân hàng</label><br>

                    <input type="hidden" name="product_id" value="<?php echo $row['MaMH']; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity ?>">
                    <!-- <input type="hidden" name="id" value="<?php echo $row['MaMH']; ?>"> -->
                    <button class="">ĐẶT HÀNG</button>

                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- FOOTER -->
    <?php
        include("footer.php");
    ?>
</body>
</html>