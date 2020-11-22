<?php
error_reporting(error_reporting() & ~E_NOTICE);
ini_set('memory_limit', '-1');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type");

require_once('connect_db.php');


$_POST = json_decode(file_get_contents('php://input'), true);



$user_id = $_POST['user_id'];
$backtest_id = $_POST['backtest_id'];


$sql = "SELECT settings FROM backtests WHERE user_id=? AND backtest_id=?";
if ($stmt = $db_connect->prepare($sql)) {
  $stmt->bind_param("ii", $user_id, $backtest_id);
  $stmt->execute();
  $stmt->bind_result(
    $settings
  );
  while ($stmt->fetch()) {
    $res = $settings;
  }
}

echo (json_encode($res));


