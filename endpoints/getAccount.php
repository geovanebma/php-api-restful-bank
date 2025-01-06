<?php
  require_once "../config/database.php";

  $accountNumber = $_GET["account_number"] ?? null;

  if($accountNumber){
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE account_number = :account_number");
    $stmt->execute([":account_number" => $accountNumber]);
    $account = $stmt-fetch(PDO::FETCH_ASSOC);

    if($account){
      echo json_encode($account);
    }else{
      http_response_code(404);
      echo json_encode(['error' => "Account not found!"]);
    }
  }else{
    http_response_code(400);
    echo json_encode(['error' => "Account number not provided!"]);
  }
?>