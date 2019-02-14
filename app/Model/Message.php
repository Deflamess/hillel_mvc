<?php

namespace Hillel\Model;


use Hillel\Application\DatabaseConnection;

class Message extends BaseModel
{
    public function __construct(\PDO $databaseConnection)
    {
        parent::__construct($databaseConnection);
    }

    protected $tableName = 'messages';
}