<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['login'])) {
    $userInfo = $_SESSION['login'];
} else {
    header("Location: login.php");
    exit;
}

include($_SERVER['DOCUMENT_ROOT'] . '/normateca/models/backend/adminModel.php');

function setData(){
    
    $model = new AdminModel("localhost", "normateca", "root", "");
    $model->start_connection();
    $categorias = [];
    $Allcategorias = [];
    $cuerpos = [];
    $Allcuerpos = [];
    $enlazarDocumentos = [];
    $documentos = [];
    $documentosn = [];
    $enlazarDocumentosn = [];
    $keywords = [];
    $admins = [];

    $cuerpo = $_SESSION['login']['Cuerpo'];
    
    $result = $model->getCategorias($cuerpo);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "cat_abbr" => $row['Category_abbr'],
                "cat_name" => $row['Category_name'],
                "cat_corp" => $row['Cuerpo_name'],
                "cat_corp_abbr" => $row['Cuerpo_abbr']
            );

            array_push($categorias, $values);
        }
    } else {
        $categorias = null;
    }

    $result = $model->getAllCategorias();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "cat_abbr" => $row['Category_abbr'],
                "cat_name" => $row['Category_name'],
                "cat_corp" => $row['Cuerpo_name'],
                "cat_corp_abbr" => $row['Cuerpo_abbr']
            );

            array_push($Allcategorias, $values);
        }
    } else {
        $Allcategorias = null;
    }

    $result = $model->getCuerpos($cuerpo);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "corp_abbr" => $row['Cuerpo_abbr'],
                "corp_name" => $row['Cuerpo_name']
            );

            array_push($cuerpos, $values);
        }
    } else {
        $cuerpos = null;
    }

    $result = $model->getAllCuerpos();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "corp_abbr" => $row['Cuerpo_abbr'],
                "corp_name" => $row['Cuerpo_name']
            );

            array_push($Allcuerpos, $values);
        }
    } else {
        $Allcuerpos = null;
    }

    //enlazar documentos
    $result = $model->GetEnlazarDocumentos($cuerpo);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Obtener documentos modificados
            $ammended = $model->enmienda_documents($row['Document_id']);
            $derroga = $model->derroga_documents($row['Document_id']);
            
            // Guardar los valores devueltos por ammended_documents()
            $ammended_values = array();
            while ($ammended_row = $ammended->fetch_assoc()) {
                $ammended_values[] = $ammended_row;
            }
            // Guardar los valores devueltos por derroga_documents()
            $derroga_values = array();
            while ($derroga_row = $derroga->fetch_assoc()) {
                $derroga_values[] = $derroga_row;
            }

            // Guardar los valores del documento original junto con los documentos modificados
            $values = array(
                "id" => $row['Document_id'],
                "number" => $row['Certification_number'],
                "fiscal" => $row['Fiscal_year'],
                "title" => $row['Document_title'],
                "category" => $row['Category_name'],
                "ammended" => $ammended_values, // Guardar los valores devueltos por ammended_documents()
                "derroga" => $derroga_values // Guardar los valores devueltos por derroga_documents()
            );
            array_push($enlazarDocumentos, $values);
        }
    } else {
        $enlazarDocumentos = null;
    }

    
    $result = $model->getEditDocumentos($cuerpo);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "Document_id" => $row['Document_id'],
                "Document_title" => $row['Document_title'],
                "cuerpo" => $row['Cuerpo_abbr'],
                "category" => $row['Category_abbr'],
                "categoria" => $row['Category_name'],
                "certi" => $row['Certification_number'],
                "fiscal" => $row['Fiscal_year'],
                "lenguaje" => $row['Document_lenguaje'],
                "path" => $row['Document_path'],
                "estado" => $row['Document_state']
            );

            array_push($documentos, $values);
        }
    } else {
        $documentos = null;
    }

    $result = $model->getKeywords();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "keyword_id" => $row['Keywords_id'],
                "keyword_name" => $row['Keywords_name']
            );
            array_push($keywords, $values);
        } 
    } else {
        $documentos = null;
    }

    $result = $model->getadmins();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values = array(
                "admin_id" => $row['Admin_id'],
                "admin_name" => $row['Name'],
                "admin_email" => $row['Email'],
                "admin_last_name" => $row['Last_name'],
                "admin_cuerpo" => $row['Cuerpo'],
                "admin_password" => $row['Password']
            );
            array_push($admins, $values);
        } 
    } else {
        $admins = null;
    }


    $_SESSION['corps'] = $cuerpos;
    $_SESSION['Allcorps'] = $Allcuerpos;
    $_SESSION['cats'] = $categorias;
    $_SESSION['Allcats'] = $Allcategorias;
    $_SESSION['Enlazar'] = $enlazarDocumentos;
    $_SESSION['documentos'] = $documentos;
    $_SESSION['documentosn'] = $documentosn;
    $_SESSION['Enlazarn'] = $enlazarDocumentosn;
    $_SESSION['keywords'] = $keywords;
    $_SESSION['admins'] = $admins;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {//subir documentos
    
    if ($_POST['type'] == "1") {
        $_SESSION['form_success'] = true;
        if (isset($_POST['filename'])) {
            $target_directory = '../../files/';
            $target_file = $target_directory . basename($_FILES['pdf']['name']);
            $upload_file = '../files/' . basename($_FILES['pdf']['name']);
        
            $file_type = mime_content_type($_FILES['pdf']['tmp_name']);
        
            if ($file_type == "application/pdf") {
                $values = array(
                    "file_name" => $_POST['filename'],
                    "file_date" => $_POST['filedate'],
                    "file_desc" => $_POST['desc'],
                    "file_number" => $_POST['number'],
                    "file_state" => $_POST['state'],
                    "file_cat" => $_POST['category'],
                    "file_lang" => $_POST['lenguaje'],
                    "file_year" => $_POST['fiscalYear'],
                    "file_corp" => $_POST['corp'],
                    "file_signature" => $_POST['signature'],
                    "file_path" => $upload_file
                );

                $selectedKeywords = $_POST['selected_keywords'];
                
                // Convert the values array to a string for tracking
                $values_string = json_encode($values);
        
                // Get admin ID from session
                $Admin = isset($_SESSION['login']['ID']) ? $_SESSION['login']['ID'] : '';
                
                // Move uploaded file to the target directory
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $target_file)) {
        
                    // Insert file data into the database
                    $model = new AdminModel("localhost", "normateca", "root", "");
                    $model->start_connection();
                    $model->InsertFile($values);
                    $id_insertado = $model->connection->insert_id; 

                    // Process the selected keywords
                    foreach ($selectedKeywords as $selectedKeyword) {
                        $model->insertContains($id_insertado, $selectedKeyword);
                    }
                    $model->connection->close();
                    
                    // Successful upload
                    header("Location: ../../views/admin.php?success");
                    exit();
                } else {
                    // Error uploading file
                    header("Location: ../../views/admin.php?error=path");
                    exit();
                }
            } else {
                // Invalid file type
                header("Location: ../../views/admin.php?error=filetype");
                exit();
            }
        }
    } else if ($_POST['type'] == "2") { //editar documentos
        $_SESSION['form_edit'] = true;
        if (isset($_POST["documentoId"]) || isset($_POST["nombreDocumento"]) || isset($_POST["fechaDocumento"]) || isset($_POST["fiscalYear"]) || isset($_POST["Cuerpo"]) || isset($_POST["certi"]) || isset($_POST["path"]) || isset($_POST["estado"]) || isset($_POST["lenguaje"])) {

            $documentoId = $_POST["documentoId"];
            $cuerpo = $_POST["Cuerpo"];
            $nombreDocumento = $_POST["nombreDocumento"];
            $categoria = $_POST["categoria"];
            $certi = $_POST["certi"];
            $fiscalYear = $_POST["fiscalYear"];
            $lenguaje = $_POST["lenguaje"];
            $estado = $_POST["estado"]; 
            $oldpath = $_POST["OldPath"];
            
            // Check if a file was uploaded
            if (isset($_FILES["path"]) && $_FILES["path"]["error"] == 0) {
                // A file was uploaded
                $target_file = '../../files/' . basename($_FILES['path']['name']);
                $upload_file = '../files/' . basename($_FILES['path']['name']);

                $file_type = mime_content_type($_FILES['path']['tmp_name']);

                if ($file_type == "application/pdf") {
                    // Move uploaded file to the target directory
                    if (move_uploaded_file($_FILES['path']['tmp_name'], $target_file)) {
                        // File uploaded successfully
                        $model = new AdminModel("localhost", "normateca", "root", "");
                        $model->start_connection();
                        $model->updateDocument($documentoId, $nombreDocumento, $cuerpo, $categoria, $certi, $fiscalYear, $lenguaje, $upload_file, $estado);
                        $model->connection->close();

                        header("Location: ../../views/admin.php?success");
                        exit();
                    } else {
                        // Error uploading file
                        header("Location: ../../views/admin.php?error=fileupload");
                        exit();
                    }
                } else {
                    // Invalid file type
                    header("Location: ../../views/admin.php?error=filetype");
                    exit();
                }
            } else {
                // No file uploaded
                $model = new AdminModel("localhost", "normateca", "root", "");
                $model->start_connection();
                $success = $model->updateDocument($documentoId, $nombreDocumento, $cuerpo, $categoria, $certi, $fiscalYear, $lenguaje, $oldpath, $estado);
                $model->connection->close();

                if ($success) {
                    echo "Data updated successfully.";
                    header("Location: ../../views/admin.php?success");
                    exit(); // Always exit after a header redirect
                } else {
                    header("Location: ../../views/admin.php?error");
                    exit();
                }
            }
        }
    } else if ($_POST['type'] == "3") { //crear categorias
        $_SESSION['addcatt'] = true;

        $categoria = $_POST["categoria"];
        $Abreviacion = $_POST["Abreviacion"];
        $cuerpo = $_POST["cuerpo"];

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->NewCategory($categoria, $Abreviacion, $cuerpo);
        $model->connection->close();

        if ($success) {
            echo "se uoopdate la dataaa";
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }

    } else if ($_POST['type'] == "4") { //crear cuerpos
        $_SESSION['addcatt'] = true;
        $cuerpo = $_POST["cuerpo"];
        $Abreviacion = $_POST["Abreviacion"];

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->NewCuerpo($cuerpo, $Abreviacion);
        $model->connection->close();

        if ($success) {
            echo "se uoopdate la dataaa";
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    } else if ($_POST['type'] == "5") { //editar cuerpos
        $_SESSION['editcatt'] = true;
        $cuerpo = $_POST["cuerpo"];
        $Abreviacion = $_POST["Abreviacion"];
        $oldabbr = $_POST["oldabbr"];

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $model->updateACuerpo($Abreviacion, $oldabbr);
        $model->connection->close();

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $model->updateBdocs($Abreviacion, $oldabbr);
        $model->connection->close();

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $model->updateCdocs($Abreviacion, $oldabbr);
        $model->connection->close();

        session_start();
        $_SESSION['login']['Cuerpo'] = $Abreviacion;

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->updateCuerpo($cuerpo, $Abreviacion, $oldabbr);
        $model->connection->close();


        if ($success) {
            header("Location: ../../views/admin.php?succes");
        } else {
            echo "errorrr";
        }

    } else if ($_POST['type'] == "6") { //editar categorias
        $_SESSION['editcatt'] = true;
        $categoria = $_POST["categoria"];
        $Abreviacion = $_POST["Abreviacion"];
        $cuerpo = $_POST["cuerpoDropdown"];
        $oldabbr = $_POST["oldabbr"];

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $model->updateACategory($Abreviacion,$oldabbr);
        $success = $model->updateCategory($categoria, $Abreviacion, $cuerpo, $oldabbr);
        $model->connection->close();

        if ($success) {
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    }else if ($_POST['type'] == "7") {
        $_SESSION['amended_s'] = true;
        $Main = $_POST["MainDoc"];
        $amended = $_POST["amendedDoc"];

        
        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->Enmendar($Main, $amended);
        $model->connection->close();

        if ($success) {
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    }else if ($_POST['type'] == "8") {
        $_SESSION['derrogado_s'] = true;
        $Main = $_POST["MainDoc"];
        $Derr = $_POST["derrogaDoc"];

        
        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->Derrogar($Main, $Derr);
        $model->connection->close();

        if ($success) {
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    }else if ($_POST['type'] == "9") { //keywords editar
        $_SESSION['key_edit'] = true;
        $id = $_POST["key_id"];
        $name = $_POST["key"];

        
        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->updateKeyword($id, $name);
        $model->connection->close();

        if ($success) {
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    }else if ($_POST['type'] == "10") { //keywords insertar
        $_SESSION['key_add'] = true;
        $name = $_POST["key"];

        $model = new AdminModel("localhost", "normateca", "root", "");
        $model->start_connection();
        $success = $model->insertKeyword($name);
        $model->connection->close();

        if ($success) {
            header("Location: ../../views/admin.php?succes");

        } else {
            echo "errorrr";
        }
    }else if ($_POST['type'] == "11") { //update admins

        $oldpassword = $_POST["oldpassword"];
        $id = $_POST["Adminid"];
        $name = $_POST["adminname"];
        $last = $_POST["adminlast"];
        $email = $_POST["adminEmail"];
        $corp = $_POST["admincorp"];
        $password = $_POST["newpassword"];
        $password2 = $_POST["newpassword2"]; 

        if ($password == $password2) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            if ($hash == $oldpassword) {
                echo "Location: ../../views/admin.php?samepassword";
            }else{
                $model = new AdminModel("localhost", "normateca", "root", "");
                $model->start_connection();
                $success = $model->updateAdmins($id, $name, $last, $email, $corp, $hash);
                $model->connection->close();

                header("Location: ../../views/admin.php?succes");
            }

        }else {
            echo "Location: ../../views/admin.php?error";
        }

    }else if ($_POST['type'] == "12") { //insert admins

        $name = $_POST["adminname"];
        $last = $_POST["adminlast"];
        $email = $_POST["adminEmail"];
        $corp = $_POST["admincorp"];
        $password = $_POST["newpassword"];
        $password2 = $_POST["newpassword2"]; 

        if ($password == $password2) {

            $hash = password_hash($password, PASSWORD_DEFAULT);


            $model = new AdminModel("localhost", "normateca", "root", "");
            $model->start_connection();
            $success = $model->InsertAdmins($name, $last, $email, $corp, $hash);
            $model->connection->close();
            if ($success) {
                header("Location: ../../views/admin.php?succes");
    
            } else {
                echo "Location: ../../views/admin.php?error";
            }
        }else {
            echo "Location: ../../views/admin.php?error";
        }
    }
}