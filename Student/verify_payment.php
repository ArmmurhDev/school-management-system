<?php
require_once '../auth/session.php';
require_once '../include/config.php';
checkAccess('student');

header('Content-Type: application/json');

$reference = $_GET['reference'] ?? '';

if (empty($reference)) {
    echo json_encode(['status' => 'error', 'message' => 'No reference supplied']);
    exit;
}

$url = "https://api.paystack.co/transaction/verify/" . rawurlencode($reference);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . PAYSTACK_SECRET_KEY,
    "Cache-Control: no-cache",
]);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(['status' => 'error', 'message' => 'Curl returned error: ' . $err]);
    exit;
}

$tranx = json_decode($response);

if (!$tranx->status) {
    // there was an API error
    echo json_encode(['status' => 'error', 'message' => 'API returned error: ' . $tranx->message]);
    exit;
}

if ('success' == $tranx->data->status) {
    // transaction was successful...
    // please check other things like whether you already gave value for this ref
    // if the amount matches the price of the product etc
    
    $student_id = $_SESSION['user_id'];
    $amount = $tranx->data->amount / 100; // convert kobo to naira
    
    try {
        // Check if reference already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM payments WHERE reference = ?");
        $stmt->execute([$reference]);
        if ($stmt->fetchColumn() == 0) {
            // Insert into payments table
            $stmt = $pdo->prepare("INSERT INTO payments (student_id, amount, reference, status) VALUES (?, ?, ?, 'success')");
            $stmt->execute([$student_id, $amount, $reference]);
            
            echo json_encode(['status' => 'success', 'message' => 'Payment verified and recorded']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Payment already recorded']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Transaction failed: ' . $tranx->data->status]);
}
?>
