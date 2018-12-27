<?php
namespace Itb;

class StaffRepository
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTableStaffs()
    {
        $sql = "DROP TABLE IF EXISTS Staffs";
        $this->connection->exec($sql);
    }

    public function createTableStaffs()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Staffs
        (id integer not null primary key auto_increment,
        username text,
        password text)";

        $this->connection->exec($sql);
    }

    public function deleteAllFromStaffs()
    {
        $sql = 'DELETE * FROM Staffs';

        $stmt = $this->connection->exec($sql);
    }

    public function insertIntoStaffs($username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        //prepare INSERT statement to SQL db
        $sql = 'INSERT INTO Staffs(username, password) VALUES(:username, :password)';
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

    public function getAllFromStaffs()
    {
        $sql = 'SELECT * FROM Staffs';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Staff');

        $Users = $stmt->fetchAll();

        return $Users;
    }

    public function getOneFromStaffs($id)
    {
        $sql = 'SELECT * FROM Staffs WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        //execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'ITB\\Staff');

        $Users = $stmt->fetch();

        return $Users;
    }

    public function deleteOneFromStaffs($id)
    {
        // Prepare SQL
        $sql = 'DELETE FROM Staffs WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);

        // Execute statement
        $noError = $stmt->execute();

        // does NOT imply any rows were deleted ...
        return $noError;
    }

    public function updateStaffs($id, $username, $password)
    {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        // Prepare INSERT statement to SQL file db, no ID since that is AUTO-INCREMENTED by DB
        $sql = "UPDATE Staffs SET username = :username, password = :password WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password_hashed);

        $noError = $stmt->execute();
        return $noError;
    }
}