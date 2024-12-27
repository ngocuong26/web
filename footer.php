<?php
    $sql = "SELECT DISTINCT dm_parent FROM danhmuc WHERE dm_parent IN ('BÚT CÁC LOẠI', 'BÌA CÁC LOẠI', 'DỤNG CỤ VĂN PHÒNG', 'GIẤY CÁC LOẠI')";
    $query = mysqli_query($conn, $sql);
?>

<footer class="footer">
        <div class="footer_up">
            <div class="grid">
                <div class="row">
                    <div class="col_3">
                        <strong style="font-size: 19px; width: 100%;">Công ty CPTM Kỹ Thuật Hoàng Thiên Ân</strong>
                        <ul style="padding-left: 20px;">
                            <li>Địa chỉ : 29 DD11, P.Tân Hưng Thuận, Q.12, Tp.HCM</li>
                            <li>Hotline : 0336.293.698 - 0918.982.444</li>
                            <li>Email : delivietnam@gmail.com</li>
                            <li>Mã số thuế: 0313394377</li>
                            <li>Cấp ngày:11/08/2015</li>
                        </ul>
                    </div>

                    <div class="col_3 cate_police">
                        <div class="cate_footer">
                            <strong style="font-size: 16px;">Danh mục sản phẩm</strong>
                            <ul>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '
                                        <ol>
                                            <form action="" style="margin: 0px;">
                                                <a href="show_all.php?category='. $row['dm_parent'] .'" class="text_cate_police-link">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    '. $row['dm_parent'] .'
                                                </a>
                                            </form>
                                        </ol>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="police_footer">
                            <strong style="font-size: 16px;">Chính sách</strong>
                            <ul>
                                <ol>
                                    <a href="" class="text_cate_police-link">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        Chính sách bảo mật
                                    </a>
                                </ol>
                                <ol>
                                    <a href="" class="text_cate_police-link">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        Chính sách kiểm hàng và đổi trả
                                    </a>
                                </ol>
                                <ol>
                                    <a href="" class="text_cate_police-link">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        Chính sách thanh toán
                                    </a>
                                </ol>
                                <ol>
                                    <a href="" class="text_cate_police-link">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        Hướng dẫn mua hàng
                                    </a>
                                </ol>
                                <ol>
                                    <a href="" class="text_cate_police-link">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        Quy định chung
                                    </a>
                                </ol>
                            </ul>
                        </div>
                    </div>

                    <div class="col_4">
                        <img src="img/image.png" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_bottom">
            <p>Copyright 2024 © <span style="font-weight: bold;">Deli Việt Nam</span></p>
        </div>
    </footer>