<?php
require "connection.php";
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $tieude = $_POST['tieude'];
    $mota = $_POST['mota'];
    $trangthai = $_POST['trangthai'];
    $ngaydang = $_POST['ngaydang'];

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
        $imagePath = "";
        // if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
        if (isset($_FILES['hinhanh'])) {
            $hinhanh = $_FILES['hinhanh'];
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!in_array($hinhanh['type'], $allowedTypes)) {
                die("Chỉ cho phép tải lên các tệp hình ảnh (JPEG, JPG, PNG).");
            }
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $imagePath = $uploadDir . uniqid() . "_" . basename($hinhanh['name']);

            if (move_uploaded_file($hinhanh['tmp_name'], $imagePath)) {
                echo "Tệp đã được tải lên thành công: $imagePath";
            } else
                die("Không thể lưu tệp tải lên.");
        } else
            die("Không có tệp nào được tải lên.");

        $dateInputStr = strtotime($ngaydang);
        $ngayDangValid = date("Y-m-d", $dateInputStr);
        $currentDate = date('Y-m-d');
        var_dump("input date: ".$ngayDangValid."\n");
        var_dump("current date: ".$currentDate."\n");
        // ngay dang nho hon ngay hien tai
        if ($ngayDangValid < $currentDate) {
            $stmt = $conn->prepare("INSERT INTO bai_viet (tieu_de,mo_ta,hinh_anh,ngay_dang,trang_thai) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $tieude, $mota, $imagePath, $ngaydang, $trangthai);
            if ($stmt->execute()) {
                // echo "<script>
                // alert('Đăng ký thành công! Chuyển đến trang đăng nhập.');
                // window.location.href = 'loginUI.php';
                // </script>";
                echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>";
                echo "<div class='alert alert-success' role='alert'>Them thanh cong! Chuyển đến trang danh sach bai viet sau 1 giây...</div>";
                echo '<meta http-equiv="refresh" content="1;url=danhSachBaiViet.php">';
                exit();
            } else {
                echo "<br>Them thất bại!</br>";
            }
            $stmt->store_result();
            $stmt->close();
        }
        else {
            echo "<br>Ngay dang phai nho hon ngay hien tai!</br>";
        }
    }
}


$conn->close();
