<?php
  require_once '../config/database.php';

  $data = json_decode(file_get_contents("php://input"), true);

  if(!empty($data["name"]) && !empty($data['account_number'])){
    $stmt = $pdo->prepare("INSERT INTO accounts (name, account_number) VALUES (:name, :account_number)");
    try{
      $stmt->execute([
        ':name' => $data['name'],
        ':account_number' => $data['account_number'],
      ]);

      echo json_encode(['message' => "Account created successfully!"]);
    }catch(PDOException $e){
      https_response_code(400);
      echo json_encode(["error" => "Account's number already exists!"]);
    }
  }else{
    http_response_code(400);
    echo json_encode(["error" => "Dados inválidos."]);
  }