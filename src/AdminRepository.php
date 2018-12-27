<?php
namespace Itb;

class AdminRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTableAdmins()
    {
        $sql = "DROP TABLE IF EXISTS Admins";
        $this->connection->exec($sql);
    }

    public function createTableAdmins()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Admins
        (id integer not null primary key auto_increment,
        username text,
        password text)";

        $this->connection->exec($sql);
    }

    public function deleteAllFromAdmins()
    {
        $sql = 'DELETE * FROM Admins';

        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoAdmins($username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        //prepare INSERT statement to SQL db
        $sql = 'INSERT INTO Admins(username, password) VALUES(:username, :password)';
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

    public function getAllFromAdmins()
    {
        $sql = 'SELECT * FROM Admins';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Admin');

        $users = $stmt->fetchAll();

        return $users;
    }

    public function getOneFromAdmins($id)
    {
        //var_dump($id);
        //die();
        $sql = 'SELECT * FROM Admins WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        //execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\Admin');

        $user = $stmt->fetch();

        return $user;
    }

    public function deleteOneFromAdmins($id)
    {
        // Prepare SQL
        $sql = 'DELETE FROM Admins WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);

        // Execute statement
        $noError = $stmt->execute();

        // does NOT imply any rows were deleted ...
        return $noError;
    }

    public function updateAdmins($id, $username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        // Prepare INSERT statement to SQL file db, no ID since that is AUTO-INCREMENTED by DB
        $sql = "UPDATE Admins SET username = :username, password = :password WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password_hashed);

        $noError = $stmt->execute();
        return $noError;
    }
}