<?php
require "flower.php";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý danh sách hoa</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #333;
        text-align: center;
    }
    th, td {
        padding: 10px;
        text-align: center;
    }
    th {
        background: #f0f0f0;
    }
    img {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
    .btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 6px;
    color: white;
    font-weight: bold;
    text-decoration: none;
    margin-bottom: 10px;
    }
    .edit { background: #28a745; }
    .delete { background: #dc3545; }
</style>
</head>
<body>

<h2>Trang Quản Trị</h2>

<a href="visitor.php">← Quay lại trang khách</a>

<table>
    <tr>
        <th>STT</th>
        <th>Tên hoa</th>
        <th width = 40%>Mô tả</th>
        <th width = 20%>Hình ảnh</th>
        <th>Thao tác</th>
    </tr>

    <?php foreach ($flowers as $index => $f): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= $f["name"] ?></td>
        <td><?= $f["description"] ?></td>
        <td>
            <?php foreach ($f["image"] as $img): ?>
                <img src="images/<?= $img ?>" alt="">
            <?php endforeach; ?>
        </td>
        <td>
            <a href="#" class="btn edit">Sửa</a>
            <a href="#" class="btn delete">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
