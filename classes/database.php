<?php
    class database {
        function opencon() {
            return new PDO('mysql:host=localhost;dbname=php_221','root','');
        }
        function check($username, $password){
            $con = $this->opencon();
            // Corrected SQL query string
            $query = "SELECT * FROM users WHERE user='".$username."' AND password='".$password."'";
            return $con->query($query)->fetch();
        }

        function signup($firstname, $lastname, $birthday, $gender, $username, $password){
            $con = $this->opencon();

            $query = $con->prepare("SELECT user FROM users WHERE user = ?");
            $query->execute([$username]);
            $existingUser = $query->fetch();

            if($existingUser){
                return false;
            }
            return $con->prepare("INSERT INTO users (firstname, lastname, birthday, gender, user,password) VALUE(?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $gender, $username, $password]);
        }

        function signupUser($firstname, $lastname, $birthday, $gender, $username, $password){
            $con = $this->opencon();

            $query = $con->prepare("SELECT user FROM users WHERE user = ?");
            $query->execute([$username]);
            $existingUser = $query->fetch();

            if($existingUser){
                return false;   
            }

            $con->prepare("INSERT INTO users (firstname, lastname, birthday, gender, user,password) VALUE(?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $gender, $username, $password]);

            return $con->lastInsertId();
        }

        function insertAddress($user_id,$street,$barangay,$city,$province){
            $con = $this->opencon();

            return $con->prepare("INSERT INTO address (user_id,street,barangay,city,province) VALUE(?,?,?,?,?)")->execute([$user_id,$street,$barangay,$city,$province]);
        }

        function view() {
            $con = $this->opencon();
            return $con->query("SELECT
            users.user_id,
            users.firstname,
            users.lastname,
            users.gender,
            users.birthday,
            users.user, CONCAT(
            address.street,' ',address.barangay,' ',address.city,' ',address.province) as address
        FROM
            users
        INNER JOIN address ON users.user_id = address.user_id")->fetchAll();  
        }

        function delete($id){
            try{
                $con = $this->opencon();
                $con->beginTransaction();
                $query = $con->prepare("DELETE FROM address WHERE user_id = ?"); 
                $query->execute([$id]);
                $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?"); 
                $query2->execute([$id]);
                $con->commit();
                return true;
            }   catch(PDOException $e){
                $con->rollBack();
                return false;
            }
        }

        function viewdata($id){
            try{
                $con = $this->opencon();
                $query = $con->prepare("SELECT
            users.user_id,
            users.firstname,
            users.lastname,
            users.gender,
            users.birthday,
            users.user,
            users.password,
            address.street,
            address.barangay,
            address.city,
            address.province
            FROM
                users
            INNER JOIN address ON 
                users.user_id = address.user_id
            WHERE 
                users.user_id = ?");
            $query->execute([$id]);
            return $query->fetch();
                } catch(PDOException $e){
                    return [];
            }
        }
        
        function update($id){
            try{
                $con = $this->opencon();
                $con->beginTransaction();
                $query = $con->prepare("UPDATE ");
            }catch(PDOException $e){
                $con->rollBack();
                return false;
            }

        }

    }   
?>