<?php 
require_once '../Slim/vendor/autoload.php';
require 'rb.php';

function getTransaction($account_number, $from, $to){
	$result = R::getAll("SELECT tr.transaction_date, tr.description, tr.transaction_type, tr.amount, tr.balance FROM tr_transaction tr JOIN ms_account ms ON tr.account_id = ms.id WHERE account_number = '".$account_number."' and tr.transaction_date BETWEEN '".$from."' AND '".$to."' ORDER BY tr.transaction_date ASC");

	return $result;
}

function insertTransaction($account_id, $transaction_date, $description, $transaction_type, $amount){
	$result = R::getAll("SELECT balance FROM `tr_transaction` WHERE account_id = ".$account_id." order by id desc limit 1");
	if(sizeof($result)>0){
		$balance = $result[0]['balance'];
	}
	else{
		$balance = 0;
	}
	if($transaction_type == "DB"){
		$balance -= $amount;
	}
	else{
		$balance += $amount;
	}


	R::begin();
    try{
        R::exec("INSERT INTO tr_transaction (account_id, transaction_date, description, transaction_type, amount, balance) VALUES ('".$account_id."', '".$transaction_date."', '".$description."', '".$transaction_type."', ".$amount.", ".$balance.")");
        R::commit();

        return 'Insert SUCCEED';
    }
    catch(Exception $e) {
        R::rollback();
        echo $e->getMessage(); exit();
        return 'Insert ERROR';
    }

}

function checkAccount($account_no){
	$sql = R::getAll("select id from ms_account where account_number = '".$account_no."'");

	if(sizeof($sql)>0){
		$response = $sql[0]['id'];
	}
	else{
		$response = "unknown";
	}

	return $response;
}

$app = new \Slim\App;

$app->post('/get/transaction/detail', function ($request, $response) {
	R::setup( 'mysql:host=localhost;dbname=money_tracker', 'root', '');
	$requestBody = $request->getParsedBody();
	$account_no = $requestBody['account'];
	$from = $requestBody['date_from'];
	$to = $requestBody['date_to'];

	$accountID = checkAccount($account_no);
	if($accountID != "unknown"){
		$result = getTransaction($account_no, $from, $to);
	}
	else{	
		$result = R::getAll("SELECT 'Not Found' AS description");
	}
	R::close();
	echo json_encode($result);

});

$app->post('/insert/transaction', function ($request, $response) {
	R::setup( 'mysql:host=localhost;dbname=money_tracker', 'root', '');
	$requestBody = $request->getParsedBody();
	$account_no = $requestBody['account'];
	$transaction_date = $requestBody['transaction_date'];
	$description = $requestBody['description'];
	$transaction_type = $requestBody['transaction_type'];
	$amount = $requestBody['amount'];

	$accountID = checkAccount($account_no);
	if($accountID != "unknown"){
		$result = insertTransaction($accountID, $transaction_date, $description, $transaction_type, $amount);
	}
	else{	
		$result = "ERROR";
	}

	R::close();
	return $result;
});


$app->run();
?>