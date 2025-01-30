<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['deleteId'] ?? null;
    $tieude = $_POST['checkTieuDe'] ?? null;
    $ngaydang = $_POST['checkNgayDang'] ?? null;
    $trangthai = $_POST['checkTrangThai'] ?? null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM bai_viet WHERE id=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) 
        {
            echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>";
            echo "<div class='alert alert-success' role='alert'>
                    Xoa thanh cong! Chuyển đến trang danh sach bai viet sau 3 giây...
                    <br>Chi tiet:</br>
                    <br>id: $id</br>
                    <br>tieu de: $tieude</br>
                    <br>ngay dang: $ngaydang</br>
                    <br>trang thai: $trangthai</br>
                </div>";
            echo '<meta http-equiv="refresh" content="3;url=danhSachBaiViet.php">';
            exit();
            // header("location: danhSachBaiViet.php");
            // exit();
        } else {
            echo "<br>Xoa thất bại!</br>";
        }
        $stmt->store_result();
        $stmt->close();
    } 
    else {
        echo "Dữ liệu không hợp lệ! id = $id";
    }
}