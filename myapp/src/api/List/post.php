<?php
/* Autor Nedra ABIDI 12/05/2019 : 15:30h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Add Customer
$app->post('/api/list/add', function(Request $request, Response $response){

    $title = $request->getParam('title');
    $author = $request->getParam('author');
    $date_create = $request->getParam('date_create');
    $date_update = $request->getParam('date_update');
    $date_delete = $request->getParam('date_delete');



    try{
        // instanciate DB Object database
        $db = new db();
        // Connect database
        $db = $db->connect();

		$customer = new Customer($db);
		
		$stmt = $customer->addCustomer($first_name,$last_name,$phone,$email,$address,$city,$state) ; 
		
		$sql = "INSERT INTO list VALUES
		(:title,:author,:date_create,:date_update,:date_delete)";
	
		
		$stmt = $db->prepare($sql);
		
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author',  $author);
        $stmt->bindParam(':date_create',      $date_create);
        $stmt->bindParam(':date_update',      $date_update);
        $stmt->bindParam(':date_delete',    $date_delete);


        $stmt->execute();

        echo '{"sucess": {"message": "List Added"}';

    } catch(PDOException $e){
        echo '{"error": {"message": '.$e->getMessage().'}';
    }
});

