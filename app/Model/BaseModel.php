<?php

namespace Hillel\Model;

use Hillel\Application\DatabaseConnection;
use PDO;

abstract class BaseModel
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var array
     */
    private $sqlParts = [];

    /**
     * @var \PDO
     */
    private $databaseConnection;

    public function __construct(PDO $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";

        $stmt = $this->databaseConnection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @return array|null
     */
    public function findAll(): ?array
    {
        $sql = "SELECT * FROM $this->tableName";
        $stmt = $this->databaseConnection->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function save(array $data): int
    {
        $fields = array_keys($data);
        $fields = implode(',', $fields);

        $values = array_values($data);
        $preparedValues = [];
        foreach ($values as $value) {
            if (is_string($value)) {
                $preparedValues[] = "'$value'";
            } else {
                $preparedValues[] = $value;
            }
        }

        $preparedValues = implode(',', $preparedValues);
        $sql = "INSERT INTO $this->tableName ($fields) VALUES ($preparedValues)";

        $query = $this->databaseConnection->exec($sql);
        return $this->databaseConnection->lastInsertId();

    }
}
