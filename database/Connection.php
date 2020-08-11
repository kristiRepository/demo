<?php



class Connection
{
    public static function create($config)
    {
        try {
            return new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['attributes']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
