<?php
// إرسال الاستجابة كـ JSON
header('Content-Type: application/json');

// ربط الفيشي ديال قاعدة البيانات
require_once '../includes/db.php';

// قراءة البيانات الـ JSON لي صيفط الجافاسكريبت
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'بيانات غير صالحة!']);
    exit;
}

$customerName = trim($data['customerName']);
$customerPhone = trim($data['customerPhone']);
$customerAddress = trim($data['customerAddress']);
$customerNote = trim($data['customerNote']);
$items = $data['items'];

// التحقق من أن الخانات الأساسية ماشي خاويين
if (empty($customerName) || empty($customerPhone) || empty($customerAddress) || empty($items)) {
    echo json_encode(['success' => false, 'message' => 'عفاك عمر كاع الخانات الأساسية!']);
    exit;
}

// حساب المجموع الإجمالي (Total Price) فالـ Backend حيت السيكوريتي هادي
$totalPrice = 0;
foreach ($items as $item) {
    $totalPrice += floatval($item['price']) * intval($item['quantity']);
}

try {
    // بدء المعاملة (Transaction) باش يلا وقع غلط ف شي برودوي يتلغى كلشي
    $pdo->beginTransaction();

    // 1. إدخال المعلومات في جدول orders
    $sqlOrder = "INSERT INTO orders (customer_name, customer_phone, customer_address, customer_note, total_price, status) 
                 VALUES (:name, :phone, :address, :note, :total, 'pending')";
    
    $stmtOrder = $pdo->prepare($sqlOrder);
    $stmtOrder->execute([
        ':name' => $customerName,
        ':phone' => $customerPhone,
        ':address' => $customerAddress,
        ':note' => $customerNote,
        ':total' => $totalPrice
    ]);

    // جيب الـ ID ديال هاد الكوموند لي عاد تكرات دابا نيت
    $orderId = $pdo->lastInsertId();

    // 2. إدخال منتجات السلة في جدول order_items
    $sqlItem = "INSERT INTO order_items (order_id, item_name, price, quantity) 
                VALUES (:order_id, :item_name, :price, :quantity)";
    $stmtItem = $pdo->prepare($sqlItem);

    foreach ($items as $item) {
        $stmtItem->execute([
            ':order_id' => $orderId,
            ':item_name' => $item['name'],
            ':price' => floatval($item['price']),
            ':quantity' => intval($item['quantity'])
        ]);
    }

    // إيلا داز كلشي أمان، حفظ التغييرات ف قاعدة البيانات
    $pdo->commit();

    echo json_encode(['success' => true, 'order_id' => $orderId]);

} catch (Exception $e) {
    // يلا وقع أي خطأ، ألغي كلشي وماتسجل والو
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'خطأ في السيرفر: ' . $e->getMessage()]);
}
?>