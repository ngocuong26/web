<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Văn Phòng Phẩm Deli Việt Nam</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header_menu_category.css">
    <link rel="stylesheet" href="css/style_cate.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
    include("header.php");
?>

    <!-- noi dung chinh -->
    <div class="container">
        <img src="img/image_intro.png" alt="">
        <div class="category_name">
            <p>BÚT CÁC LOẠI</p>
        </div>
        <div class="grid">
            <div class="row">
                <?php
                    $sql = "SELECT * FROM sanpham WHERE danhmuc IN (SELECT dm_child FROM danhmuc WHERE dm_parent = 'BÚT CÁC LOẠI') LIMIT 10";
                    $query = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($query)){
                ?>
                    <div class="col col_5">
                        <div class="product" style="margin-top: 10px">
                            <img src="img/<?php echo $row['img']; ?>" alt="" class="img_product">
                            <div class="text_product" style="margin: 14px">
                                <form action="show"></form>
                                <a href="show_product_detail.php?id=<?php echo $row['MaMH']; ?>" style="text-decoration: none;">
                                    <p class="name_product" style="padding-bottom: 10px; color: #bd163d; height: 80px"><?php echo $row['tenMH']; ?></p>
                                    <p class="price_product" style="text-align: center; font-weight: bold; color: black; padding-bottom: 16px"><?php echo number_format($row['gia'], 0, '.', ','); ?> ₫</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>

            </div>
        </div>
        <div class="show_all_product">
            <?php
                $sql = "SELECT * from danhmuc where dm_parent = 'BÚT CÁC LOẠI'";
                $query = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($query)
            ?>
            <form action="">
                <a href="show_all.php?category=<?php echo $row['dm_parent']; ?>" class="show_all_product-link">Xem tất cả</a>
            </form>

        </div>
        <div class="category_name">
            <p>BÌA CÁC LOẠI</p>
        </div>
        <div class="grid">
            <div class="row">
                <?php
                    $sql = "SELECT * FROM sanpham WHERE danhmuc IN (SELECT dm_child FROM danhmuc WHERE dm_parent = 'BÌA CÁC LOẠI')";
                    $query = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($query)){
                ?>
                    <div class="col col_5">
                        <div class="product" style="margin-top: 10px">
                            <img src="img/<?php echo $row['img']; ?>" alt="" class="img_product">
                            <div class="text_product" style="margin: 14px">
                                <form action="show"></form>
                                <a href="show_product_detail.php?id=<?php echo $row['MaMH']; ?>" style="text-decoration: none;">
                                    <p class="name_product" style="padding-bottom: 10px; color: #bd163d; height: 80px"><?php echo $row['tenMH']; ?></p>
                                    <p class="price_product" style="text-align: center; font-weight: bold; color: black; padding-bottom: 16px"><?php echo number_format($row['gia'], 0, '.', ','); ?> ₫</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>

            </div>
        </div>
        <div class="show_all_product">
            <?php
                $sql = "SELECT * from danhmuc where dm_parent = 'BÌA CÁC LOẠI'";
                $query = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($query)
            ?>
            <form action="">
                <a href="show_all.php?category=<?php echo $row['dm_parent']; ?>" class="show_all_product-link">Xem tất cả</a>
            </form>

        </div>
    </div>

    <!-- FOOTER -->
    <?php
        include("footer.php");
    ?>
</body>
</html>