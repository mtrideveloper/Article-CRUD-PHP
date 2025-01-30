<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
include "connection.php";
$sql = "SELECT * FROM bai_viet where trang_thai = 1";
$result = $conn->query($sql);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <title>Profile</title>
</head>

<body>
    <?php include "header.php"; ?>    
    <h2 class="text-center my-3">Danh sach bai viet</h2>
    <h5 class="text-center my-3" style="color: red;">Chọn vào hàng tương ứng để xem chi tiết bài viết đó</h5>    
    <div class="container font-monospace d-flex flex-row justify-content-between p-2" style="gap: 16px;">
        <div style="width: 100%;">
            <table class="table table-primary table-hover">
                <thead>
                    <tr>
                        <th>Hinh anh</th>
                        <th>Tieu de</th>
                        <th>Mo ta</th>
                        <th>Ngay dang</th>
                        <th>Trang thai</th>
                        <th>Thao tac</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        while ($row) {
                            // if ($row['trang_thai'] == 1) { // 1 : trang thai hien thi; 2: an; 3: da khoa
                            // }
                            $baivietid = htmlspecialchars($row['id']);
                            $tieude = htmlspecialchars($row['tieu_de']);
                            $mota = htmlspecialchars($row['mo_ta']);
                            $hinhanh = htmlspecialchars($row['hinh_anh']);
                            $ngaydang = htmlspecialchars($row['ngay_dang']);
                            $trangthai = htmlspecialchars($row['trang_thai']);
                            echo <<<ROW_RESULT
                            <!--<tr style="cursor: pointer;" onclick="event.stopPropagation(); window.location.href='chiTietBaiViet.php?id=$baivietid';">-->
                            <tr style="cursor: pointer;" 
                                onclick="handleRowClick(event, '$baivietid')">
                                <td style="height: 150px; width: 150px;">
                                    <img src="$hinhanh" style="max-width: 100%; max-height: 100%;">
                                </td>
                                <td class="text-truncate" style="max-width: 150px;">$tieude</td>
                                <td class="text-truncate" style="max-width: 200px;">$mota</td>
                                <td>$ngaydang</td>
                                <td>$trangthai</td>
                                <td>
                                    <button class="btn btn-dark" type="button" onclick="handleEditClick(event, '$baivietid')">Sửa</button>
                                    <form method="post" action="deleteHandle.php" style="display: inline;">
                                        <input type="hidden" name="deleteId" value="$baivietid">
                                        <input type="hidden" name="checkTieuDe" value="$tieude">
                                        <input type="hidden" name="checkNgayDang" value="$ngaydang">
                                        <input type="hidden" name="checkTrangThai" value="$trangthai">
                                        <button class="btn btn-danger" type="submit">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            ROW_RESULT;
                            $row = $result->fetch_assoc();
                        }
                    } else {
                        echo <<<EMPTY
                        <tr><td colspan="6">No bai_viet found.</td></tr>
                        EMPTY;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function handleRowClick(event, id) {
            // Kiểm tra xem mục tiêu của sự kiện có phải là nút hay form không
            if (event.target.tagName !== 'BUTTON' && event.target.tagName !== 'FORM') {
                window.location.href = `chiTietBaiViet.php?id=${id}`;
            }
        }

        function handleEditClick(event, id) {
            // Ngăn chặn sự kiện hàng được kích hoạt
            event.stopPropagation();
            window.location.href = `suaBaiVietUI.php?id=${id}`;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>