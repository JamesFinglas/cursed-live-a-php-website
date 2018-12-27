<?php
namespace Itb;

class VisitorRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTableVisitors()
    {
        $sql = "DROP TABLE IF EXISTS Visitors";
        $this->connection->exec($sql);
    }

    public function createTableVisitors()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Visitors
        (id integer not null primary key auto_increment,
        username text,
        email text)";

        $this->connection->exec($sql);
    }

    public function deleteAllFromVisitors()
    {
        $sql = 'DELETE * FROM Visitors';

        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoVisitors($username, $email)
    {
        //prepare INSERT statement to SQL db
        $sql = 'INSERT INTO Visitors(username, email) VALUES(:username, :email)';
        $stmt = $this->connection->prepare($sql);

        //bind parameters to statement variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        //execute statement
        $noError = $stmt->execute();

        if($noError){
            return $this->connection->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAllFromVisitors()
    {
        $sql = 'SELECT * FROM Visitors';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Visitor');

        $Users = $stmt->fetchAll();

        return $Users;
    }

    public function getOneFromVisitors($id)
    {
        $sql = 'SELECT * FROM Visitors WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        //execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\Visitor');

        $visitors = $stmt->fetch();

        return $visitors;
    }

    public function deleteOneFromVisitors($id)
    {
        // Prepare SQL
        $sql = 'DELETE FROM Visitors WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);

        // Execute statement
        $noError = $stmt->execute();

        // does NOT imply any rows were deleted ...
        return $noError;
    }

    public function updateVisitors($id, $username, $email)
    {
        // Prepare INSERT statement to SQL file db, no ID since that is AUTO-INCREMENTED by DB
        $sql = "UPDATE Visitors SET username = :username, email = :email WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        $noError = $stmt->execute();
        return $noError;
    }
}