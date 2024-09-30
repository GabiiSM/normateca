<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/normateca/models/backend/loginModel.php');

function setLogin(){
    $model = new LoginModel("localhost", "normateca", "root", "");
    $model->start_connection();
    $cuerpos = [];

    $result = $model->getCuerpos();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "corp_abbr" => $row['Cuerpo_abbr'],
                "corp_name" => $row['Cuerpo_name']
            );

            array_push($cuerpos, $values);
        }
    }else {
        $cuerpos = null;
    }

    $_SESSION['cuerpos'] = $cuerpos;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['log'] == "1") {
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cuerpo = $_POST['cuerpo'];
            
        
            $model = new LoginModel("localhost", "normateca", "root", "");
            $model->start_connection();
            $result = $model->LoginUser($email, $password); // Modified to handle hashed passwords
            $model->connection->close();
        
            if ($result) {
                var_dump($result);
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    
                    if($cuerpo == $row['Cuerpo']){
                        if (!isset($_SESSION['login'])) {
                            $_SESSION['login'] = [];
                        }
        
                        $_SESSION['login'] = [
                            "ID" => $row['Admin_id'],
                            "Nombre" => $row['Name'],
                            "Apellido" => $row['Last_name'],
                            "Cuerpo" => $row['Cuerpo']
                        ];
                        
                        header("Location: ../../views/admin.php?success"); 
                    } else{
                        header("Location:../../views/login.php?error");
                        $message = "Dont got access to those documents";
                    }
                }
            } else {
                header("Location: ../../views/login.php?error");
                $message = "Wrong credentials";
            }
        }
    }else if ($_POST['log'] == "2") {
        
        if (isset($_POST['hash']) == true) {
            $password = $_POST['password'];
            $user = $_POST['id'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $model = new LoginModel("localhost", "normateca", "root", "");
            $model->start_connection();
            $result = $model->hashPassword($hash, $user);
            $model->connection->close();
            header("Location:../../views/login.php?error");
        }
    }

}
?>