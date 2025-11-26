<?php
session_start();
require "flower.php";

$error = '';

// Xử lý login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Sai tên đăng nhập hoặc mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách các loài hoa Xuân - Hè</title>
<style>
    body { font-family: Arial, sans-serif; background: #fafafa; margin:0; padding:0 20px; }

    h1 { margin-top: 80px; text-align:center; padding:25px 0; color:#d63664; }

    .flower-box { 
        background:#fff; 
        padding:20px; 
        margin:25px auto; 
        max-width:800px; 
        border-radius:12px; 
        box-shadow:0 4px 12px rgba(0,0,0,0.1); }
    .flower-name { 
        font-size:26px; 
        font-weight:bold; 
        color:#c42540; 
        margin:15px 0 10px; }
    .flower-description { 
        font-size:17px; 
        line-height:1.6; 
        white-space:pre-line; 
        color:#333; }
    .image-gallery { 
        display:flex; 
        gap:10px; 
        overflow-x:auto; 
        padding-bottom:10px; }
    .image-gallery img { 
        height:260px; 
        border-radius:10px; 
        object-fit:cover; 
        box-shadow:0 2px 10px rgba(0,0,0,0.1); }

    .login-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #fff;
        padding: 12px 22px;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: 0.3s ease;
    }
    .login-btn:hover { background: linear-gradient(135deg, #0056b3, #003f7f); transform: scale(1.05); }

    #loginForm {
        display:none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        z-index: 1000;
        width: 300px;
    }
    #loginForm input[type=text],
    #loginForm input[type=password] {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    #loginForm button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
    }
    #loginForm button:hover { background: #0056b3; }

    #loginForm .close-btn {
        position: absolute;
        top: 8px;
        right: 12px;
        cursor: pointer;
        font-size: 18px;
        color: #555;
    }

    #loginOverlay {
        display: none;
        position: fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background: rgba(0,0,0,0.4);
        z-index: 500;
    }
</style>
</head>
<body>

<button class="login-btn" onclick="showLogin()">Đăng nhập</button>

<div id="loginOverlay" onclick="hideLogin()"></div>

<div id="loginForm">
    <span class="close-btn" onclick="hideLogin()">&times;</span>
    <?php if($error): ?>
        <p style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="login" value="1">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <button type="submit">Đăng nhập</button>
    </form>
</div>

<h1>14 Loài Hoa Tuyệt Đẹp Cho Mùa Xuân - Hè</h1>

<?php foreach ($flowers as $flower): ?>
<div class="flower-box">
    <div class="flower-name"><?= htmlspecialchars($flower["name"]) ?></div>
    <div class="flower-description"><?= nl2br(htmlspecialchars($flower["description"])) ?></div>
    <br>
    <div class="image-gallery">
        <?php foreach ($flower["image"] as $img): ?>
            <img src="images/<?= $img ?>" alt="<?= $flower['name'] ?>">
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>

<script>
function showLogin() {
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('loginOverlay').style.display = 'block';
}
function hideLogin() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('loginOverlay').style.display = 'none';
}
</script>

</body>
</html>
