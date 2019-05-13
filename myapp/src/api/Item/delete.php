<?php
/* Autor Nedra ABIDI 12/05/2019 : 12h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Delete Customer By Id
$app->delete('/api/item/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
		
		$item = new Item($db);
		$res = $item->deleteItemById($id);
		
        
        $db = null;
        echo '{"sucess": {"message": "Item Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"message": '.$e->getMessage().'}';
    }
});