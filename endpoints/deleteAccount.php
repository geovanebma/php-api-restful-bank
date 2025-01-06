<?php
  require_once '../config/database.php';

  $data = json_decode(file_get_contents('php://input'), true);

  if(!empty($data['account_number'])){
    $stmt = $pdo->prepare('DELETE FROM accounts WHERE account_number = :account_number');
    $stmt->execute([":account_number" => $data['account_number']]);
    if ($stmt->rowCount()) {
      echo json_encode(['message' => 'Account deleted successfully!']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Account not found!']);
    }
  } else {
    http_response_code(400);
    echo json_encode(['error' => 'Account number not provided!']);
  }
?>