<?php
/* Autor Nedra ABIDI 12/05/2019 : 16h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Delete Customer By Id
$app->delete('/api/list/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    //$sql = "DELETE FROM customers WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
		
		$list = new Liste($db);
		$res = $list->deleteListById($id);
		
        
        $db = null;
        echo '{"sucess": {"message": "List and items Deleted"}';
    } catch(PDOException $e){
        echo '{"eroor": {"message": '.$e->getMessage().'}';
    }
});