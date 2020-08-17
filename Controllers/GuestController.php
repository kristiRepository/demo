<?php




class GuestController
{
    protected $conn;
    protected $query;

    public function __construct()
    {
        require('database/Connection.php');
        require('database/Query.php');
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new Query($this->conn);
    }






    public function index()

    {
        $page = 1;
        $start = 0;
        $limit = "";

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);
        } else {
            $limit = 5;
        }

        if (isset($_GET['page'])) {
            if (intval($_GET['page']) > 1) {
                $start = ((intval($_GET['page']) - 1) * $limit);
                $page = (intval($_GET['page']));
            }
        } else {
            $start = 0;
        }



        if (isset($_GET['search_box'])) {
            $total_data = $this->query->total_data($_GET['search_box']);
        } else {
            $total_data = $this->query->total_data();
        }



        if (isset($_GET['search_box'])) {
            $result = $this->query->fetch($_GET['search_box'], $start, $limit);
        } else {
            $result = $this->query->fetch("", $start, $limit);
        }


        require('views/main.php');
    }




    public function checkGuest()
    {

        $id = "";

        if (!isset($_POST['id'])) {
            throw new Exception('Guest not identified');
        }
        $id = $_POST['id'];

        $query = new Query($this->conn);
        $query->check($id);


        $start = 0;
        $limit = $_POST['limit'];



        if (isset($_POST['search'])) {
            $total_data = $this->query->total_data($_POST['search']);
        } else {
            $total_data = $this->query->total_data();
        }

        if (isset($_POST['search'])) {
            $result = $this->query->fetch($_POST['search'], $start, $limit);
        } else {
            $result = $this->query->fetch("", $start, $limit);
        }



        require('views/main.php');
    }
}
