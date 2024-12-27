<?php
    session_start();  // Bắt đầu session

    // Hủy session
    session_unset();  // Xóa tất cả các biến session
    session_destroy();  // Hủy session

    // Chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit();
?>
