<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>User Profile</title>
</head>

<body>
    <?php include "header.php"; ?>
    <?php
    require "connection.php";
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM bai_viet WHERE id=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result(); // Lấy kết quả truy vấn
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy hàng dữ liệu dưới dạng mảng
                $id = htmlspecialchars($row['id']);
                $tieude = htmlspecialchars($row['tieu_de']);
                $mota = htmlspecialchars($row['mo_ta']);
                $hinhanh = htmlspecialchars($row['hinh_anh']);
                $ngaydang = htmlspecialchars($row['ngay_dang']);
                $trangthai = htmlspecialchars($row['trang_thai']);
                // heredoc php
                echo <<<CHITIETBAIVIET
                <section class="vh-100" style="background-color: #f4f5f7;">
                        <div class="container pb-5 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col col-lg-6 mb-4 mb-lg-0">
                                    <div class="card mb-3" style="border-radius: .5rem;">
                                        <div class="row g-0">
                                            <div class="col-md-4 gradient-custom text-center text-white" 
                                                style="
                                                    border: 1px solid #2125294a;
                                                    margin-left: 8px;
                                                    margin-top: 30px;
                                                    border-radius: 50%;
                                                    height: 150px; 
                                                    width: 150px; 
                                                    overflow: hidden;
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                ">
                                                <img id="review" src="./$hinhanh" alt="Avatar"
                                                    style="max-width: 100%; max-height: 100%;" />
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body p-4">
                                                    <h5>Information</h5>
                                                    <hr class="mt-0 mb-4">
                                                    <p class="text-muted">Tieu de: $tieude</p>
                                                    <p class="text-muted">Ngay dang: $ngaydang</p>
                                                    <p class="text-muted">Trang thai: $trangthai</p>
                                                    <hr class="mt-0 mb-2">
                                                    <p class="text-muted">Mo ta: $mota</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                CHITIETBAIVIET;
            } else {
                echo "Khong nhan duoc _GET['id']!";
            }
        }
    } else {
        echo "Invalid request method.";
    }
    ?>
</body>

</html>