<?php
// // Send the response as JSON
header('Content-Type: application/json');

// rabt file dial database
require_once '../includes/db.php';

// Read the JSON data sent by JavaScript
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid data!']);
    exit;
}

$customerName = trim($data['customerName']);
$customerPhone = trim($data['customerPhone']);
$customerAddress = trim($data['customerAddress']);
$customerNote = trim($data['customerNote']);
$items = $data['items'];

// checking wach lkhanat l2assasiyin khawyin
if (empty($customerName) || empty($customerPhone) || empty($customerAddress) || empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all the required fields!']);
    exit;
}

// Calculate the total price on the backend because this is about security
$totalPrice = 0;
foreach ($items as $item) {
    $totalPrice += floatval($item['price']) * intval($item['quantity']);
}

try {
    // Start the transaction, so if an error occurs with any product, everything is rolled back
    $pdo->beginTransaction();

    // 1. insert infos in orders table
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

    // katrja3 dial akhir insert 3melt b had connection
    $orderId = $pdo->lastInsertId();

    // 2. insert prroducts in order_items
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

    // ila koulchi nja7 sjel taghyirat f database
    $pdo->commit();

    echo json_encode(['success' => true, 'order_id' => $orderId]);

} catch (Exception $e) {
    // ila w9a3 ay khata2 hbess koulchi
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'خطأ في السيرفر: ' . $e->getMessage()]);
}
?>