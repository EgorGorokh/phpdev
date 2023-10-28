<?php

class DataBase
{
    private $servername;
    private $username;
    private $passpord;
    private $dbname;

    public function getConnection()
    {
        $this->servername ='localhost';
        $this->username='root';
        $this->password='root';
        $this->dbname='phpdevtest';

        try {
            $connect=new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            return $connect;
        } catch (Exception $e) {
            $error=$e->getMessage();
            echo $error;
        }
    }




    public function getBooks($connect)
    {
        $request1 = "SELECT * FROM books";
        $result1 = $connect->prepare($request1);
        $result1->execute();
        $result1 = $result1->get_result();
        return  $result1;
    }


    public function getAuthors($connect)
    {
        $request2 = "SELECT * FROM authors";
        $result2 = $connect->prepare($request2);
        $result2->execute();
        $result2 = $result2->get_result();
        return  $result2;
    }

   
}
