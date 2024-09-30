<?php
include($_SERVER['DOCUMENT_ROOT'] . '/normateca/db/db_info.php');
class LoginModel extends DB{
    
    public function LoginUser($email, $password){
        $query = "SELECT * FROM `admin` WHERE `Email` = ?";
        
        // Prepare the statement
        $statement = $this->connection->prepare($query);
        
        // Bind the parameter
        $statement->bind_param("s", $email);
        
        // Execute the query
        $statement->execute();
        
        // Get the result
        $result = $statement->get_result();
        
        // Check if there is a user with the given email
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verify the hashed password
            if (password_verify($password, $row['Password'])) {
                // Password is correct, return the user data
                return $result;
            }
        }
        
        // No user found or incorrect password, return false
        return false;
    }
    
    
    public function getCuerpos(){

        $query = "SELECT * FROM cuerpos";
        return $this->run_query($query);
    }
    
    public function hashPassword($password, $user){
        $query = "UPDATE `admin` SET `Password` = '$password' WHERE `admin`.`Admin_id` = '$user'";
        return $this->run_query($query);
    }
}
?>