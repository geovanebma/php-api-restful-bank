<?php
  header("Access-Control-Allow-Origin: *");
  header("Content Type: application/json");

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
      require 'endpoints/createAccount.php';
      break;
    case 'GET':
      require 'endpoints/createAccount.php';
      break;
    case 'PUT':
      require 'endpoints/updateBalance.php';
      break;
    case 'DELETE':
      require 'endpoints/deleteAccount.php';
      break;
    default:
      http_response_code(405);
      echo json_encode(['error' => 'Method not allowed.']);
      break;
  }
?>