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
}
