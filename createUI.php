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
    <title>Create article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .my-form * {
            width: 100%;
        }

        .hinhanh {
            position: relative;
        }

        #hinhanh-contanter {
            display: none;
            position: absolute;
            right: -220px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 200px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 2px solid #121212;
            overflow: hidden;
        }

        /* #avt-contanter img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        } */

        .my-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: monospace;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="my-container">
        <h2 class="my-3">Create article</h2>
        <form class="my-form w-50 d-flex justify-content-center flex-column align-items-center"
            action="createHandle.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tieude" class="form-label">Tieu de</label>
                <input type="text" class="form-control" id="tieude" name="tieude" require>
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mo ta</label>
                <input type="text" class="form-control" id="mota" name="mota" require>
            </div>
            <div class="hinhanh mb-3">
                <label for="avatar" class="form-label">Hinh anh</label>
                <input type="file" accept=".jpge,.jpg,.png" class="form-control" id="hinhanh" name="hinhanh"
                    require>
                <div id="hinhanh-contanter">
                    <img id="hinhanh-review" alt="Avatar review" src="">
                </div>
            </div>
            <div class="mb-3">
                <label for="ngaydang" class="form-label">Ngay dang</label>
                <input type="date" class="form-control" id="ngaydang" name="ngaydang" require>
            </div>
            <div class="mb-3">
                <label for="ngaydang" class="form-label">Trang thai</label>
                <input type="number" class="form-control" id="trangthai" name="trangthai" require>
            </div>
            <button type="submit" class="mt-3 w-50 btn btn-dark">Create</button>
        </form>
    </div>
    <script>
        const avatarContainer = document.getElementById("hinhanh-contanter");
        const avtReview = document.getElementById("hinhanh-review");
        const avatarInput = document.getElementById("hinhanh");
        avatarInput.addEventListener('change', function () {
            const file = avatarInput.files[0]; // Lấy file đã chọn

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Đặt URL hình ảnh vào thuộc tính src của thẻ <img>
                    avtReview.src = e.target.result;
                    avatarContainer.style.display = 'flex';
                    avatarContainer.style.justifyContent = 'center';
                    avatarContainer.style.alignItems = 'center';
                };
                reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
            } else {
                avtReview.src = '';
                avatarContainer.style.display = 'none';
            }
        });
    </script>
</body>

</html>