<?php
namespace Itb;

class UserRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function createTableUsers()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Users
        (id integer not null primary key auto_increment,
        username text,
        password text)";

        $this->connection->exec($sql);
    }

    public function deleteAllFromUsers()
    {
        $sql = 'DELETE * FROM Users';

        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoUsers($username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        //prepare INSERT statement to SQL db
        $sql = 'INSERT INTO Users(username, password) VALUES(:username, :password)';
        $stmt = $this->connection->prepare($sql);

        //bind parameters to statement variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password_hashed);

        //execute statement
        $noError = $stmt->execute();

        if($noError){
            return $this->connection->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAllFromUsers()
    {
        $sql = 'SELECT * FROM Users';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\User');

        $users = $stmt->fetchAll();

        return $users;
    }

    public function getOneFromUsers($id)
    {
        $sql = 'SELECT * FROM Users WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        //execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\User');

        $Users = $stmt->fetch();

        return $Users;
    }

    public function deleteOneFromUsers($id)
    {
        // Prepare SQL
        $sql = 'DELETE FROM Users WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);

        // Execute statement
        $noError = $stmt->execute();

        // does NOT imply any rows were deleted ...
        return $noError;
    }

    public function updateUsers($id, $username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        // Prepare INSERT statement to SQL file db, no ID since that is AUTO-INCREMENTED by DB
        $sql = "UPDATE Users SET username = :username, password = :password WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password_hashed);

        $noError = $stmt->execute();
        return $noError;
    }
}