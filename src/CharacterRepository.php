<?php
namespace Itb;

class CharacterRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTableCharacters()
    {
        $sql = "DROP TABLE IF EXISTS Characters";
        $this->connection->exec($sql);
    }

    public function createTableCharacters()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Characters
        (id integer not null primary key auto_increment,
        description text,
        biography text)";

        $this->connection->exec($sql);
    }

    public function deleteAllFromCharacters()
    {
        $sql = 'DELETE * FROM Characters';

        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoCharacters($description, $biography)
    {
        //prepare INSERT statement to SQL db
        $sql = 'INSERT INTO Characters(description, biography) VALUES(:description, :biography)';
        $stmt = $this->connection->prepare($sql);

        //bind parameters to statement variables
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':biography', $biography);

        //execute statement
        $noError = $stmt->execute();

        if($noError){
            return $this->connection->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAllFromCharacters()
    {
        $sql = 'SELECT * FROM Characters';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Character');

        $characters = $stmt->fetchAll();

        return $characters;
    }

    public function getOneFromCharacters($id)
    {
        $sql = 'SELECT * FROM Characters WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        //execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\Character');

        $characters = $stmt->fetch();

        return $characters;
    }

    public function deleteOneFromCharacters($id)
    {
        // Prepare SQL
        $sql = 'DELETE FROM Characters WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);

        // Execute statement
        $noError = $stmt->execute();

        // does NOT imply any rows were deleted ...
        return $noError;
    }

    public function updateCharacters($id, $description, $biography)
    {
        // Prepare INSERT statement to SQL file db, no ID since that is AUTO-INCREMENTED by DB
        $sql = "UPDATE Characters SET description = :description, description = :biography WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':biography', $biography);

        $noError = $stmt->execute();
        return $noError;
    }
}