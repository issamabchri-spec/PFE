<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

// التحقق من أن البيانات جاية بـ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // الحالات المسموح بها فقط فالـ ENUM
    $allowedStatus = ['pending', 'preparing', 'delivered', 'canceled'];

    if ($orderId > 0 && in_array($status, $allowedStatus)) {
        try {
            $sql = "UPDATE orders SET status = :status WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':status' => $status,
                ':id' => $orderId
            ]);

            echo json_encode(['success' => true]);
            exit;
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'بيانات غير صالحة!']);
?>