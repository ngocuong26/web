
<body>
    <!-- header -->
    <div class="header_up">
        <header class="header_to_up">
            <ul class="header_up_list">
                <ol class="header_up_list">VĂN PHÒNG PHẨM DELI VIỆT NAM</ol>
                <ol class="header_up_list" style="display: flex;">
                    <a href="" class="header_up-link">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="" class="header_up-link" style="margin: 0px 10px;">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="" class="header_up-link">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                </ol>
            </ul>
        </header>
    </div>
    <div class="header_between">
        <div class="header_between-list">
            <img src="img/image_logo.png" alt="" class="img_brand">
            <input type="text" class="search" placeholder="Tìm kiếm">
            <div class="cart"><i class="fa-solid fa-cart-shopping"></i></div>
            <!-- <div class="login_link"><a href="login.php" class="">Đăng nhập</a></div> -->
            <?php
                include("database.php");
                session_start();  // Bắt đầu session
                
                if (isset($_POST['logout'])) {
                    session_start();  // Bắt đầu session
                    session_unset();  // Xóa tất cả các biến session
                    session_destroy();  // Hủy session
                    header("Location: index.php");  // Điều hướng về trang chủ sau khi đăng xuất
                    exit();
                }

                // Kiểm tra nếu người dùng đã đăng nhập
                if (isset($_SESSION['user'])) {
                    $username = $_SESSION['user'];
                    // echo "Chào mừng, $username!";

                    echo "<div class='login_link'><p style='line-height: 40px; padding: 0px 10px;display: block;color: white;margin: auto;font-weight: bold;'>$username</p></div>";
                    echo "<div class='logout' style='display: flex; padding-left: 20px; margin: auto'><form method='POST' action=''><button type='submit' name='logout' class='logout' style='height: 40px; padding: 0px 10px;display: block;color: white;font-weight: bold; background-color:#bd163d; border: none; font-size: 15px; border-radius: 5px; box-sizing: border-box; margin: auto;'>Đăng xuất</button></form></div>";
                } else {
                    // echo "Bạn chưa đăng nhập.";
                }
            ?>

            <!-- Nút đăng nhập chỉ hiển thị nếu chưa đăng nhập -->
            <?php if (!isset($_SESSION['user'])): ?>
                <button onclick="window.location.href='login.php'" class="login_link1" style='line-height: 40px; padding: 0px 10px;display: block;color: white;margin: auto;font-weight: bold; background-color:#bd163d; border: unset; font-size: 16px'>Đăng nhập</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="main_header">
        <header class="header">
            <ul class="header_list">
                <ol class="list_items category">
                    <a href="" class="list_items-link">
                        <i class="fa-solid fa-bars"></i>
                        DANH MỤC SẢN PHẨM
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <div class="menu_category">
                        <ul class="menu_list">
                            <ol class="menu_list_items">
                                <a href="" class="menu_list-link show_f">
                                    <p>BÚT CÁC LOẠI</p>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <div class="show_category">
                                    <ul class="show_category_detail">
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÚT BI</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÚT CHÌ</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÚT GEL</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÚT LÔNG</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÚT XÓA</a>
                                        </ol>
                                    </ul>
                                </div>
                            </ol>
                            <ol class="menu_list_items">
                                <a href="" class="menu_list-link">
                                    <p>BÌA CÁC LOẠI</p>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <div class="show_category" style="top: -100%;">
                                    <ul class="show_category_detail">
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY BÌA MÀU</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA CÒNG</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA KẸP</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA LÁ</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA LỖ</a>
                                        </ol>
                                    </ul>
                                </div>
                            </ol>
                            <ol class="menu_list_items">
                                <a href="" class="menu_list-link">
                                    <p>SỔ - TẬP CÁC LOẠI</p>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <div class="show_category" style="top: -200%;">
                                    <ul class="show_category_detail">
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">SỔ LÒ XO</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">SỔ CAO CẤP</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">SỔ CARO</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA LÁ</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BÌA LỖ</a>
                                        </ol>
                                    </ul>
                                </div>
                            </ol>
                            <ol class="menu_list_items">
                                <a href="" class="menu_list-link">
                                    <p>DỤNG CỤ VĂN PHÒNG</p>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <div class="show_category" style="top: -300%;">
                                    <ul class="show_category_detail">
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BẤM KIM</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BẤM LỖ</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <?php
                                                $sql1 = "SELECT * FROM danhmuc where dm_child = 'Ghim giấy'";
                                                $query1 = mysqli_query($conn, $sql1);

                                                $row1 = mysqli_fetch_assoc($query1)
                                            ?>
                                            <form action="" style="margin-bottom: 0px;">
                                                <a href="show_all.php?category=<?php echo $row1['dm_child']; ?>" class="show_category_list-link">GHIM GIẤY</a>
                                            </form>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <?php
                                                $sql1 = "SELECT * FROM danhmuc where dm_child = 'Rọc giấy'";
                                                $query1 = mysqli_query($conn, $sql1);

                                                $row1 = mysqli_fetch_assoc($query1)
                                            ?>
                                            <form action="" style="margin-bottom: 0px;">
                                                <a href="show_all.php?category=<?php echo $row1['dm_child']; ?>" class="show_category_list-link">DAO RỌC GIẤY</a>
                                            </form>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BĂNG KEO</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">BẢNG TÊN</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">KẸP GIẤY</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <?php
                                                $sql1 = "SELECT * FROM danhmuc where dm_child = 'Hộp bút'";
                                                $query1 = mysqli_query($conn, $sql1);

                                                $row1 = mysqli_fetch_assoc($query1)
                                            ?>
                                            <form action="" style="margin-bottom: 0px;">
                                                <a href="show_all.php?category=<?php echo $row1['dm_child']; ?>" class="show_category_list-link">HỘP BÚT</a>
                                            </form>
                                            <!-- <a href="" class="show_category_list-link">HỘP BÚT</a> -->
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <?php
                                                $sql1 = "SELECT * FROM danhmuc where dm_child = 'Kéo'";
                                                $query1 = mysqli_query($conn, $sql1);

                                                $row1 = mysqli_fetch_assoc($query1)
                                            ?>
                                            <form action="" style="margin-bottom: 0px;">
                                                <a href="show_all.php?category=<?php echo $row1['dm_child']; ?>" class="show_category_list-link">KÉO</a>
                                            </form>
                                        </ol>
                                    </ul>
                                </div>
                            </ol>
                            <ol class="menu_list_items">
                                <a href="" class="menu_list-link">
                                    <p>GIẤY CÁC LOẠI</p>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <div class="show_category" style="top: -400%;">
                                    <ul class="show_category_detail">
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY A4</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY A5</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY A3</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY A0</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY NOTE</a>
                                        </ol>
                                        <ol class="show_category_detail-list">
                                            <a href="" class="show_category_list-link">GIẤY KIỂM TRA</a>
                                        </ol>
                                    </ul>
                                </div>
                            </ol>
                            <ol class="menu_list_items">
                                <?php
                                    $sql1 = "SELECT * from danhmuc where dm_parent = 'MÁY TÍNH'";
                                    $query1 = mysqli_query($conn, $sql1);

                                    $row1 = mysqli_fetch_assoc($query1)
                                ?>
                                <form action="" style="margin-bottom: 0px;">
                                    <a href="show_all.php?category=<?php echo $row1['dm_parent']; ?>" class="menu_list-link"><p>MÁY TÍNH</p></a>
                                </form>
                            </ol>
                        </ul>
                    </div>
                </ol>
                <ol class="list_items">
                    <a href="index.php" class="list_items-link">TRANG CHỦ</a>
                </ol>
                <ol class="list_items">
                    <a href="gioithieu.php" class="list_items-link">GIỚI THIỆU</a>
                </ol>
                <ol class="list_items">
                    <a href="tintuc.php" class="list_items-link">TIN TỨC</a>
                </ol>
                <ol class="list_items">
                    <a href="lienhe.php" class="list_items-link">LIÊN HỆ</a>
                </ol>
            </ul>
            <img src="" alt="">
        </header>
    </div>