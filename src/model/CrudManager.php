<?php
//require __DIR__ . '/../../config/config.php';

function dbConnect() {
    static $db = false;
    if ($db === false) {
        $db = new PDO(DSN, USERNAME, PASSWORD, OPTIONS);
    }
    return $db;
}

//var_dump(__FILE__, MODEL . 'Manager.php'); die();
function createManager($firstName, $lastName, $email, $age, $location) {
    $new_user = array(
        "firstname" => $firstName,
        "lastname" => $lastName,
        "email" => $email,
        "age" => $age,
        "location" => $location
    );

    $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)", USERSTABLE, implode(", ", array_keys($new_user)), ":" . implode(", :", array_keys($new_user))
    );

    $ok = false;
    try {
        $db = dbConnect();
        $statement = $db->prepare($sql);
        $ok = $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return $ok;
}

function readManager($location) {
    $sql = "SELECT * FROM " . USERSTABLE . " WHERE location = :location";

    $result = false;
    try {
        $db = dbConnect();

        $statement = $db->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return $result;
}

function updateManager() {
    $sql = "SELECT * FROM " . USERSTABLE;

    $result = false;
    try {
        $db = dbConnect();
        $statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return $result;
}

function getUserManager($id) {
    $sql = "SELECT * FROM " . USERSTABLE . " WHERE id = :id";
    $user = false;
    try {
        $db = dbConnect();
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return($user);
}

function updateSingleManager($id, $firstName, $lastName, $email, $age, $location, $date) {
    if (isset($_POST['submit'])) {
        $user = [
            "id" => $id,
            "firstname" => $firstName,
            "lastname" => $lastName,
            "email" => $email,
            "age" => $age,
            "location" => $location,
            "date" => null
        ];
        $sql = "UPDATE " . USERSTABLE .  
            " SET 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age, 
              location = :location, 
              date = :date 
            WHERE id = :id";

        try {
            $db = dbConnect();
            $statement = $db->prepare($sql);
            $statement->execute($user);
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}

function deleteManager($id) {
    $success = false;
    if ($id) {
        try {
            $sql = "DELETE FROM " . USERSTABLE . " WHERE id = :id";
            $db = dbConnect();
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $success = "User successfully deleted";
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    try {
        $sql = "SELECT * FROM " . USERSTABLE;
        $db = dbConnect();
        $statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return [$success, $result];
}
