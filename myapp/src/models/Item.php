<?php
/* Autor Nedra ABIDI 12/05/2019 : 11h */

class Item
{
    //db stuff
    private $cnx;
    private $table = 'item';

    //Item properties
    public $id;
    public $id_list;
    public $title;
    public $date_create;
    public $date_update;
    public $date_delete;

    //construct
    public function __construct(PDO $db)
    {
        $this->cnx = $db;
    }
	
	// get all Customers
    public function getItems()
    {
        //create query
        $query = 'SELECT itm.id, itm.id_list, itm.title, itm.date_create, itm.date_update, itm.date_delete
                                FROM ' . $this->table . ' itm
                                ';

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	// get Item By Id
    public function getItemById($id)
    {
        //create query
        $query = 'SELECT itm.id, itm.id_list, itm.title, itm.date_create, itm.date_update, itm.date_delete
                                FROM ' . $this->table . ' itm
                                WHERE itm.id = ' . $id . '
								';
        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	// delete Item By Id
    public function deleteItemById($id)
    {
        //create query
		$query = "DELETE FROM ". $this->table ." WHERE id = $id";

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }


}