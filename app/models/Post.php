<?php

class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getPosts()
    {
        $this->db->query("SELECT * FROM mvcphp.post ");

        return $this->db->resultSet();
    }
}
