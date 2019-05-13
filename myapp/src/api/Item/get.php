<?php
/* Autor Nedra ABIDI 12/05/2019 : 13h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Customers
$app->get('/api/items', function(Request $request, Response $response){

    try{
        // instanciate DB Object database
        $db = new db();
        // Connect db
        $db = $db->connect();
		
		$item = new Item($db);
		$res = $item->getItems();

		$items = $res->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($items);
    } catch(PDOException $e){
       echo  json_encode(
        array('message' => 'there is no items !' , '{"error": {"text": '.$e->getMessage().'}')
    );
    }
});

// Get Single Customer
$app->get('/api/item/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        // instanciate DB Object database
        $db = new db();
        // Connect database
        $db = $db->connect();
		
		$item = new Item($db);
		$res = $item->getItemById($id);
		$num = $res->rowCount();
		$itm = array('message' => 'there is no item !') ; 
		if ($num > 0) {
			$itm = $res->fetch(PDO::FETCH_OBJ);
		}
        $db = null;
        echo json_encode($itm);
    } catch(PDOException $e){
        echo  json_encode(
        array('{"error": {"text": '.$e->getMessage().'}')
    );
    }
});




