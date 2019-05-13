<?php
/* Autor Nedra ABIDI 12/05/2019 : 15h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Lists
$app->get('/api/lists', function(Request $request, Response $response){

    try{
        // instanciate DB Object database
        $db = new db();
        // Connect db
        $db = $db->connect();
		
		$list = new Liste($db);
		$res = $list->getLists();

		$lists = $res->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($lists);
    } catch(PDOException $e){
       echo  json_encode(
        array('message' => 'there is no lists !' , '{"error": {"text": '.$e->getMessage().'}')
    );
    }
});

// Get All Lists sans jointure avec Items
$app->get('/api/alllists', function(Request $request, Response $response){

    try{
        // instanciate DB Object database
        $db = new db();
        // Connect db
        $db = $db->connect();
		
		$list = new Liste($db);
		$res = $list->allLists();

		$lists = $res->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($lists);
    } catch(PDOException $e){
       echo  json_encode(
        array('message' => 'there is no lists !' , '{"error": {"text": '.$e->getMessage().'}')
    );
    }
});

// Get List By id
$app->get('/api/list/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        // instanciate DB Object database
        $db = new db();
        // Connect database
        $db = $db->connect();
		
		$list = new Liste($db);
		$res = $list->getListById($id);
		$num = $res->rowCount();
		$cust = array('message' => 'there is no List !') ; 
		if ($num > 0) {
			$cust = $res->fetchAll(PDO::FETCH_OBJ);
		}
        $db = null;
        echo json_encode($cust);
    } catch(PDOException $e){
        echo  json_encode(
        array('{"error": {"text": '.$e->getMessage().'}')
    );
    }
});




