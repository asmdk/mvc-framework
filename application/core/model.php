<?php 

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function execSql($sql, $data = null)
    {
        $sth = $this->db->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll();
    }
}