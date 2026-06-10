<?php
// 1. kanbdaw session
session_start();

// 2. إيلا كان الأدمن ديجا مسجل الدخول، صيفطو ديريكت للـ Dashboard بلا ما يعاود الـ Login
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

// 3.mli admin yclicki ela button
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //trim: kanjibo lbayanat w kandfo lfaraghat
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 4. kant7a9e9o mn ma3lomat s7i7a
    if ($email === "admin@restaurant.com" && $password === "admin123") {
        // إيلا صحيحة، كنشعلو الـ Session وكنعطيوه قيمة true
        $_SESSION['admin_logged_in'] = true;
        
        //kanjwho l dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // إيلا غلط، كنعرضو ميساج د الخطأ
        $error = "البريد الإلكتروني أو الرقم السري غير صحيح!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - MyRestaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #1a1a1a; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-box { background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); width: 100%; max-width: 380px; text-align: center; }
        h2 { color: #333; margin-bottom: 25px; font-size: 24px; }
        .input-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 6px; color: #666; font-size: 14px; font-weight: bold; }
        input { width: 100%; padding: 12px; border: 2px solid #eee; border-radius: 6px; box-sizing: border-box; font-size: 15px; transition: 0.3s; }
        input:focus { border-color: #ffc107; outline: none; }
        button { width: 100%; padding: 12px; background: #ffc107; color: #1a1a1a; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background: #e0a800; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; text-align: right; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🔐 تسجيل دخول الإدارة</h2>
    
    <?php if (!empty($error)): ?>
        <div class="error">⚠️ <?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="login.php" method="POST">
        <div class="input-group">
            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" placeholder="admin@restaurant.com" required>
        </div>
        
        <div class="input-group">
            <label>الرقم السري:</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        
        <button type="submit">دخول للوحة التحكم</button>
    </form>
</div>

</body>
</html>