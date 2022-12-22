<?php
class HomepageModel
{
    private Database $db;

    public function __construct($db = new Database)
    {
        $this->db = $db;
    }

    public function getLoginDetails()
    {
        $this->db->query("SELECT * FROM LoginDetails");
        return $this->db->resultSet();
    }
}
