<?php
require "connection.php";
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $tieude = $_POST['tieude'];
    $mota = $_POST['mota'];
    $trangthai = $_POST['trangthai'];
    $ngaydang = $_POST['ngaydang'];
    $id = $_POST['baivietid'];
    $hinhanhhientai = $_POST['hinhanhhientai'];

    if (
        $tieude === "" || $mota === "" ||
        $trangthai === "" || $ngaydang === ""
    ) {
        echo "<h1>Không được bỏ trống trường nào!</h1>";
        echo "<h1>tieu de: $tieude</h1>";
        echo "<h1>mo ta: $mota</h1>";
        echo "<h1>ngay dang: $ngaydang</h1>";
        echo "<h1>trang thai: $trangthai</h1>";
    } else {
        if (isset($_FILES['hinhanh'])) {
            $hinhanh = $_FILES['hinhanh'];
            var_dump($hinhanh);
            if (!empty($hinhanh['name']) || !empty($hinhanh['tmp_name'])) {
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!in_array($hinhanh['type'], $allowedTypes)) {
                    die("Chỉ cho phép tải lên các tệp hình ảnh (JPEG, JPG, PNG).");
                }
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $hinhanhhientai = $uploadDir . uniqid() . "_" . basename($hinhanh['name']);
                if (move_uploaded_file($hinhanh['tmp_name'], $hinhanhhientai)) {
                    echo "Tệp đã được tải lên thành công: $hinhanhhientai";
                } else
                    die("Không thể lưu tệp tải lên.");
            }
        }

        $dateInputStr = strtotime($ngaydang);
        $ngayDangValid = date("Y-m-d", $dateInputStr);
        $currentDate = date('Y-m-d');
        // ngay dang nho hon ngay hien tai
        if ($ngayDangValid < $currentDate) {
            $stmt = $conn->prepare("UPDATE bai_viet SET tieu_de=?,mo_ta=?,ngay_dang=?,hinh_anh=?,trang_thai=? WHERE id=?");
            $stmt->bind_param("ssssii", $tieude, $mota, $ngaydang, $hinhanhhientai, $trangthai, $id);
            if ($stmt->execute()) {
                echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>";
                echo "<div class='alert alert-success' role='alert'>Sua thanh cong voi bai viet id=$id! Chuyển đến trang chi tiet bai viet sau 1 giây...</div>";
                echo "<meta http-equiv='refresh' content='1;url=chiTietBaiViet.php?id=$id'>";
                // echo '<meta http-equiv="refresh" content="1;url=danhSachBaiViet.php">';
                exit();
            } else {
                echo "<br>Sua thất bại!</br>";
            }
            // $stmt->store_result();
            $stmt->close();
        } else {
            echo "<br>Ngay dang phai nho hon ngay hien tai!</br>";
        }
    }
}

$conn->close();
