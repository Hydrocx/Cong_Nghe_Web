<?php
// import_accounts_csv.php
$csvFile = '65HTTT_Danh_sach_diem_danh.csv';

// đọc CSV
$rows = [];
if (($handle = fopen($csvFile, 'r')) !== false) {
    $header = fgetcsv($handle); // đọc header
    while (($data = fgetcsv($handle)) !== false) {
        $rows[] = array_combine($header, $data);
    }
    fclose($handle);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách tài khoản CSV</title>
    <style>
        body {font-family: Arial; max-width:1000px; margin:20px auto;}
        table {border-collapse: collapse; width: 100%;}
        th, td {border:1px solid #ccc; padding:6px 10px; text-align:left;}
        th {background:#f0f0f0;}
        tr:nth-child(even){background:#f9f9f9;}
    </style>
</head>
<body>
    <h1>Danh sách tài khoản từ CSV</h1>
    <table>
        <tr>
            <?php foreach($header as $h): ?>
                <th><?= htmlspecialchars($h) ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach($rows as $row): ?>
            <tr>
                <?php foreach($header as $h): ?>
                    <td><?= htmlspecialchars($row[$h]) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
