<?php


class Query
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function check($id)
    {


        $query = $this->pdo->prepare("UPDATE guests SET checked=1 WHERE id={$id}");
        $query->execute();
    }
    

    public function create_query($search_box=""){
        $query = "SELECT * FROM guests WHERE checked IS NULL ";

        if (isset($search_box)) {
            if($search_box!=""){
            $query .= "AND( name LIKE :name OR surname LIKE :surname)";
        }}
        return $query .= " ORDER BY name ASC";


        
        
    }

    public function total_data($search_box=""){

       

        $statment = $this->pdo->prepare($this->create_query($search_box));
        if (isset($search_box)) {
            if($search_box !=""){
            $bind = "%" . $search_box . "%";

            $statment->bindValue(':name', $bind, PDO::PARAM_STR);
            $statment->bindValue(':surname', $bind, PDO::PARAM_STR);
        }}
        $statment->execute();
        return $total_data = $statment->rowCount();

    }


    public function fetch($search_box="",$start,$limit){
        $filter_query =$this->create_query($search_box) . '  LIMIT ' . $start . ', ' . $limit . '';
        $statment = $this->pdo->prepare($filter_query);
        if (isset($search_box)) {
            if($search_box!=""){
            $bind = "%" . $search_box . "%";

            $statment->bindValue(':name', $bind, PDO::PARAM_STR);
            $statment->bindValue(':surname', $bind, PDO::PARAM_STR);
        }}

        $statment->execute();
        return $result = $statment->fetchAll();

    }
}
