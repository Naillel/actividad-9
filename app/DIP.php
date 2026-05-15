<?php 

namespace App;

interface ConnectionInterface
{
    public function connect();
}

class DbConnection implements ConnectionInterface
{
    public function connect(){
        //
    }
}


class PasswordReminder{

    public function __construct(public ConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}