<?php
include("database.php"); 

$category = isset($_GET['category']) ? $_GET['category'] : '';

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

$orderBy = '';
if ($sort === 'asc') {
    $orderBy = "ORDER BY gia ASC"; 
} elseif ($sort === 'desc') {
    $orderBy = "ORDER BY gia DESC"; 
}

// Truy vấn sản phẩm
$sql = "SELECT * FROM sanpham 
        WHERE danhmuc = '$category' 
        OR danhmuc IN (SELECT dm_child FROM danhmuc WHERE dm_parent = '$category') 
        $orderBy";

$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category; ?> - Deli Việt Nam</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_cate.css">
    <link rel="stylesheet" href="css/header_menu_category.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/thanhtoan.css">
    <link rel="stylesheet" href="css/showall.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php
    include("header.php");
?>
    <div class="show_all">
        <div class="filter">
            <div class="box_filter">
                <strong style="color: black; display: block; line-height: 40px; font-weight: normal; margin-right: 10px;">
                    Hiển thị sản phẩm
                </strong>
                <!-- Dropdown sắp xếp -->
                <select name="sort" id="sort" onchange="location = this.value;">
                    <option value="?category=<?php echo $category; ?>&sort=default" 
                        <?php if ($sort === 'default') echo 'selected'; ?>>Thứ tự mặc định</option>
                    <option value="?category=<?php echo $category; ?>&sort=asc" 
                        <?php if ($sort === 'asc') echo 'selected'; ?>>Giá từ thấp đến cao</option>
                    <option value="?category=<?php echo $category; ?>&sort=desc" 
                        <?php if ($sort === 'desc') echo 'selected'; ?>>Giá từ cao đến thấp</option>
                </select>
            </div>
        </div>
        <div class="grid grid_showall">
            <div class="row">
                <?php
                    // Hiển thị sản phẩm
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <div class="col col_4_showall">
                    <div class="product" style="margin-top: 10px">
                        <img src="img/<?php echo $row['img']; ?>" alt="" class="img_product">
                        <div class="text_product" style="margin: 14px">
                            <a href="show_product_detail.php?id=<?php echo $row['MaMH']; ?>" style="text-decoration: none;">
                                <p class="name_product" style="padding-bottom: 10px; color: #bd163d; height: 80px">
                                    <?php echo $row['tenMH']; ?>
                                </p>
                                <p class="price_product" style="text-align: center; font-weight: bold; color: black; padding-bottom: 16px">
                                    <?php echo number_format($row['gia'], 0, '.', ','); ?> ₫
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    
    <!-- FOOTER -->
    <?php
        include("footer.php");
    ?>
</body>
</html>
