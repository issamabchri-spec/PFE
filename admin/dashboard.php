<?php
session_start(); // ← زيد هاد السطر

// حماية الصفحة
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../auth/login.php");
    exit;
}

// lindk database
require_once '../includes/db.php';

try {
    // Fetch all orders sorted by newest first
    $sql = "SELECT * FROM orders ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    $orders = $stmt->fetchAll();
} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyRestaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css"> <style>
        body { 
    font-family: 'Inter', sans-serif; 
    padding: 40px 20px; 
    background: #0B0F0B; /* Caviar Black */
    color: #A9BBA9;      /* Soft Sage Gray */
    -webkit-font-smoothing: antialiased;
    margin: 0;
}

.admin-container { 
    max-width: 1200px; 
    margin: 0 auto; /* it centres it*/
    background: #121812; /* Deep Moss Surface */
    padding: 30px; 
    border-radius: 16px 4px 16px 4px; 
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.65); 
    border: 1px solid rgba(255, 255, 255, 0.02);
    box-sizing: border-box;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    width: 100%;
}

.admin-container:hover {
    border-color: rgba(214, 175, 55, 0.15); 
}

/* 🔄 غطاء ديناميكي لضمان عدم خروج الطابلو على اليمين أو اليسار */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    margin-top: 25px;
    border-radius: 4px;
}

table { 
    width: 100%; 
    border-collapse: collapse; 
    text-align: center; /* رديناها Center باش كلشي يجي مستف ف الوسط موازن */
    box-sizing: border-box;
}

th, td { 
    padding: 16px 15px; 
    border-bottom: 1px solid rgba(255, 255, 255, 0.03); 
    font-size: 0.9rem;
}

th { 
    background-color: rgba(19, 51, 31, 0.4); /* أخضر زمردي داكن */
    color: #FFFFFF; 
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    border-bottom: 2px solid #1a241a;
}

tr:hover td {
    background: rgba(255, 255, 255, 0.01); 
    color: #FFFFFF;
}

/* 💎 Premium Status Badges */
.status-badge { 
    display: inline-block;
    padding: 6px 12px; 
    border-radius: 4px; 
    font-weight: 700; 
    font-size: 0.75rem; 
    letter-spacing: 1px;
    text-transform: uppercase;
    text-align: center;
    width: 90px; /* توحيد العرض لجمالية الترتيب */
}

.pending { 
    background: rgba(224, 168, 0, 0.1); 
    color: #E0A800; 
    border: 1px solid rgba(224, 168, 0, 0.25); 
}

.preparing { 
    background: rgba(23, 162, 184, 0.1); 
    color: #17A2B8; 
    border: 1px solid rgba(23, 162, 184, 0.25); 
}

.delivered { 
    background: rgba(40, 167, 69, 0.1); 
    color: #28A745; 
    border: 1px solid rgba(40, 167, 69, 0.25); 
}

.canceled { 
    background: rgba(224, 83, 83, 0.08); 
    color: #E05353; 
    border: 1px solid rgba(224, 83, 83, 0.25); 
}

/* 🎛️ Premium Dropdown Menu */
select { 
    background: #0f150f; 
    color: #FFFFFF; 
    border: 1px solid #1a241a; 
    padding: 8px 10px; 
    border-radius: 4px; 
    outline: none;
    cursor: pointer;
    font-size: 0.85rem;
    font-family: inherit;
    transition: all 0.3s ease;
}

select:focus { 
    border-color: #D4AF37; 
    box-shadow: 0 0 10px rgba(214, 175, 55, 0.1);
}
    </style>
</head>
<body>

<div class="admin-container">
    <h1>👨‍🍳 Restaurant Control Panel - Admin Dashboard</h1>
<p>Here you can manage orders coming from customers directly and in real-time.</p>
    
    <table>
        <thead>
            <tr>
                <th>order number</th>
                <th>client</th>
                <th>phone number</th>
                <th>adress</th>
                <th>Grand Total</th>
                <th>Order Status</th>
                <th>Change Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">there is no orders right now</td>
                </tr>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong>#<?php echo $order->id; ?></strong></td>
                        <td><?php echo htmlspecialchars($order->customer_name); ?></td>
                        <td><?php echo htmlspecialchars($order->customer_phone); ?></td>
                        <td><?php echo htmlspecialchars($order->customer_address); ?></td>
                        <td><strong><?php echo $order->total_price; ?> MAD</strong></td>
                        <td>
                            <span class="status-badge <?php echo $order->status; ?>" id="badge-<?php echo $order->id; ?>">
                                <?php echo ucfirst($order->status); ?>
                            </span>
                        </td>
                        <td>
                            <select onchange="updateStatus(<?php echo $order->id; ?>, this.value)">
                                <option value="pending" <?php echo $order->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="preparing" <?php echo $order->status == 'preparing' ? 'selected' : ''; ?>>Preparing</option>
                                <option value="delivered" <?php echo $order->status == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                <option value="canceled" <?php echo $order->status == 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                            </select>
                        </td>
                        <td><?php echo $order->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function updateStatus(orderId, newStatus) {
    // Kanrbto front-end with back-end
    fetch("update_status.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `order_id=${orderId}&status=${newStatus}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
          // Update the badge instantly without showing the page
            const badge = document.getElementById(`badge-${orderId}`);
            badge.className = `status-badge ${newStatus}`;
            badge.innerText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
        } else {
            alert("An error occurred during the update: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
       alert("Error connecting to the server!");
    });
}
</script>

</body>
</html>