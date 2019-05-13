<?php
/* Autor Nedra ABIDI 12/05/2019 : 14h */
class Liste
{
    //db stuff
    private $cnx;
    private $table = 'list';

    //List properties
    public $id;
    public $title;
    public $author;
    public $date_create;
    public $date_update;
    public $date_delete;

    //construct
    public function __construct(PDO $db)
    {
        $this->cnx = $db;
    }
	
	// get all Lists
    public function getLists()
    {
        //create query
        $query = 'SELECT l.id, l.title, l.author, l.date_create, l.date_update, l.date_delete , item.id AS id_item, item.title as title_item 
                                FROM ' . $this->table . ' l
								LEFT JOIN item ON l.id = item.id_list
                                ';

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	public function allLists()
    {
        //create query
        $query = 'SELECT l.id, l.title, l.author, l.date_create, l.date_update, l.date_delete 
                                FROM ' . $this->table . ' l
                                ';

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	// get List By Id
    public function getListById($id)
    {
        //create query
        $query = 'SELECT l.id, l.title, l.author, l.date_create, l.date_update, l.date_delete , item.id AS id_item, item.title as title_item
                                FROM ' . $this->table . ' l
								LEFT JOIN item ON l.id = item.id_list
                                WHERE l.id = ' . $id . '
								';

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	// delete List By Id
    public function deleteListById($id)
    {
        
		
		//create query for delete  items in list id_list = $id 
		$query = "DELETE FROM item WHERE id_list = $id";
 

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();
		
		//create query for delete list id = $id 
		$query = "DELETE FROM ". $this->table ." WHERE id = $id";
 

        //prepate statement
        $stmt = $this->cnx->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

	

	
	
	

}