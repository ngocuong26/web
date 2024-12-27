<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức - Deli Việt Nam</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header_menu_category.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        a{
            text-decoration: none;
        }

        p{
            color: black;
        }
    </style>
</head>

<?php
    include("header.php");
?>

<div class="container_news">
        <div class="grid">
            <div class="row">
                <div class="col col_4">
                    <div class="container_news_items" style="box-shadow: 0 1px 3px -2px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);">
                        <img src="img/img_news.png" alt="" style="width: 100%; position: static !important;">
                        <a href="show_news.php" class="">
                            <div class="container_news_content" style="padding: 0px 12px;">
                                <h3 style="color: #bd163d;">Văn phòng phẩm Deli ghi dấu ấn trên sàn thương mại điện tử</h3>
                                <p style="padding-bottom: 20px; display: block;">Trong sự kiện siêu sale với hàng triệu ưu đãi hấp dẫn ngày 11/11, Deli [...]</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php
        include("footer.php");
    ?>
</body>
</html>