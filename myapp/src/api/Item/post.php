<?php
/* Autor Nedra ABIDI 12/05/2019 : 13h30 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



// Add Item
$app->post('/api/item/add', function(Request $request, Response $response){
    $id_list = $request->getParam('id_list');
    $title = $request->getParam('title');
    $date_create = $request->getParam('date_create');
    $date_update = $request->getParam('date_update');
    $date_delete = $request->getParam('date_delete');


    try{
        // instanciate DB Object database
        $db = new db();
        // Connect database
        $db = $db->connect();

		$customer = new Customer($db);
		
		$sql = "INSERT INTO item (id_list,title,date_create,date_update,date_delete) VALUES
		(:id_list,:title,:date_create,:date_update,:date_delete)";
	
		
		$stmt = $db->prepare($sql);
		
        $stmt->bindParam(':id_list', $id_list);
        $stmt->bindParam(':title',  $title);
        $stmt->bindParam(':date_create', $date_create);
        $stmt->bindParam(':date_update', $date_update);
        $stmt->bindParam(':date_delete', $date_delete);
  

        $stmt->execute();

        echo '{"sucess": {"message": "Item Added"}';

    } catch(PDOException $e){
        echo '{"error": {"message": '.$e->getMessage().'}';
    }
});

