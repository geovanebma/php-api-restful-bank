<?php
  require_once "../config/database.php";

  $data = json_decode(file_get_contents('php://input'), true);

  if(!empty($data['account_number']) && isset($data['amount'])){
    $stmt = $pdo->prepare('UPDATE accounts SET balance = balance + :amount WHERE account_number = :account_number');
    $stmt->execute([
      ':amount' => $data['amount'],
      ':account_number' => $data['account_number']
    ]);

    if($stmt->rowCount()){
      echo json_encode(['message' => 'Balance updated successfully!']);
    }else{
      http_response_code(404);
      echo json_encode(['message' => 'Account not found!']);
    }
  }else{
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data.']);
  }
?>