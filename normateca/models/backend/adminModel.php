<?php
include($_SERVER['DOCUMENT_ROOT'] . '/normateca/db/db_info.php');

class AdminModel extends DB{

    public function getCategorias($cuerpo){
        $query = "SELECT categories.Category_abbr, categories.Category_name, cuerpos.Cuerpo_name, cuerpos.Cuerpo_abbr
        FROM categories
        JOIN cuerpos ON categories.Cuerpo = cuerpos.Cuerpo_abbr
        WHERE cuerpos.Cuerpo_abbr = '$cuerpo'";
        return $this->run_query($query);
    }

    public function getAllCategorias(){
        $query = "SELECT categories.Category_abbr, categories.Category_name, cuerpos.Cuerpo_name, cuerpos.Cuerpo_abbr
        FROM categories
        JOIN cuerpos ON categories.Cuerpo = cuerpos.Cuerpo_abbr
        ORDER BY cuerpos.Cuerpo_name";
        return $this->run_query($query);
    }

    public function getCuerpos($cuerpo){
        $query = "SELECT * FROM cuerpos
        WHERE `Cuerpo_abbr` = '$cuerpo'";
        return $this->run_query($query);
    }

    public function getAllCuerpos(){
        $query = "SELECT * FROM cuerpos";
        return $this->run_query($query);
    }

    public function InsertFile($values){
        $query = "INSERT 
        INTO documentos (Document_title, Cuerpo_abbr, Category_abbr, Certification_number, Fiscal_year, Document_lenguaje, Document_path, Date_created, Document_state) 
        VALUES ('" . $values['file_name'] . "', '" . $values['file_corp'] . "', '" . $values['file_cat'] . "', '" . $values['file_number'] . "', '" . $values['file_year'] . "', '" . $values['file_lang'] . "', '" . $values['file_path'] . "', '" . $values['file_date'] . "', '" . $values['file_state'] . "')";
        return $this->run_query($query);
    }

    public function GetEnlazarDocumentos($cuerpo){
        $query = "SELECT documentos.Document_id, documentos.Certification_number, documentos.Fiscal_year, documentos.Document_title, categories.Category_name
        FROM documentos
        JOIN categories ON categories.Category_abbr = documentos.Category_abbr
        WHERE documentos.Cuerpo_abbr = '$cuerpo'";
        return $this->run_query($query);
    }
 
    public function getEditDocumentos($cuerpo){
        $query = "SELECT Document_id,Document_title,Cuerpo_abbr,documentos.Category_abbr,categories.Category_name,Certification_number,Fiscal_year,Document_lenguaje,Document_path,Document_state
        FROM documentos
        JOIN categories ON documentos.Category_abbr = categories.Category_abbr
        WHERE Cuerpo_abbr = '$cuerpo'";
        return $this ->run_query($query);
    }

    public function search_queryn($searchQuery){
        $query = "SELECT Document_title, Date_created,Document_id,Fiscal_year,Cuerpo_abbr,Certification_number,Document_path,Document_state,Document_lenguaje FROM documentos WHERE Document_title LIKE $searchQuery ";
        return $this ->run_query($query);
    }

    public function updateDocument($documentId, $nombreDocumento, $cuerpo, $categoria, $certi, $fiscalYear, $lenguaje, $path, $estado) {
        $query = "UPDATE documentos SET Document_title = '$nombreDocumento', `Cuerpo_abbr` = '$cuerpo', `Category_abbr` = '$categoria', `Certification_number` = '$certi', 
        `Fiscal_year` = '$fiscalYear', `Document_lenguaje` = '$lenguaje', `Document_path` = '$path', `Date_created` = current_timestamp(), `Document_state` = '$estado' WHERE Document_id = '$documentId'";
        return $this ->run_query($query);
    }

    //categorias
    public function NewCategory($categoria,$Abreviacion,$cuerpo) {
        $query = "INSERT INTO categories 
        (Category_abbr, Category_name, Cuerpo) 
        VALUES ('".$Abreviacion . "','". $categoria . "','". $cuerpo."')";
        return $this->run_query($query);
    }
    //update categoria
    public function updateCategory($categoria,$Abreviacion,$cuerpo,$oldabbr) {
        $query = "UPDATE categories SET Category_abbr = '$Abreviacion', Category_name = '$categoria', Cuerpo = '$cuerpo'
        WHERE Category_abbr = '$oldabbr'";
        return $this->run_query($query);
    }
    //update documentos en la categoria
    public function updateACategory($Abreviacion,$oldabbr) {
        $query = "UPDATE `documentos` SET `Category_abbr` = '$Abreviacion' 
        WHERE `Category_abbr` = '$oldabbr'";
        return $this->run_query($query);
    }

    //cuerpos
    public function NewCuerpo($cuerpo,$Abreviacion) {
        $query = "INSERT INTO cuerpos (Cuerpo_abbr, Cuerpo_name) 
        VALUES ('".$Abreviacion . "','". $cuerpo ."')";
        return $this->run_query($query);

    }
    //update el cuerpo
    public function updateCuerpo($cuerpo, $Abreviacion,$oldabbr) {
        $query = "UPDATE cuerpos SET Cuerpo_abbr = '$Abreviacion', Cuerpo_name = '$cuerpo' 
        WHERE Cuerpo_abbr = '$oldabbr'";
        return $this->run_query($query);
    }
    //Update categorias en el cuerpo
    public function updateACuerpo($Abreviacion, $oldabbr){
        $query = "UPDATE `categories` SET `Cuerpo` = '$Abreviacion' 
        WHERE `Cuerpo` = '$oldabbr'";
        return $this->run_query($query);
    }
    //Update documentos en el cuerpo
    public function updateBdocs($Abreviacion, $oldabbr){
        $query = "UPDATE `documentos` SET `Cuerpo_abbr` = '$Abreviacion'
        WHERE `Cuerpo_abbr` = '$oldabbr'";
        return $this->run_query($query);
    }
    //Update cuerpo en la session del admin
    public function updateCdocs($Abreviacion, $oldabbr){
        $query = "UPDATE `admin` SET `Cuerpo` = '$Abreviacion' 
        WHERE `Cuerpo` = '$oldabbr'";
        return $this->run_query($query);
    }

    //tacking
    public function Tracking($admin,$acction,$target,$new,$old){
        $query = "INSERT INTO `tracking` (`Tracking_id`, `Admin_id`, `Date`, `Acction`, `Target_id`, `New_Info`, `Old_info`) 
        VALUES (NULL, '$admin', current_timestamp(), '$acction', '$target', '$new', '$old')";
        return $this->run_query($query);
    }

    //Enmendar
    public function enmienda_documents($documentId){
        $query = "SELECT documentos.Certification_number, documentos.Fiscal_year, documentos.Document_path 
              FROM `enmienda` 
              JOIN `documentos` ON `enmienda`.`Document_id` = `documentos`.`Document_id`
              WHERE `documentos`.`Document_id` = $documentId";
        return $this->run_query($query);
    }
    public function Enmendar($main,  $amended){
        $query = "INSERT INTO `enmienda` (`Document_id`, `Target_id`, `Date`)
        VALUES ('$main', '$amended', current_timestamp())";
        return $this->run_query($query);
    }

    //derrogar
    public function derroga_documents($documentId){
        $query = "SELECT documentos.Certification_number, documentos.Fiscal_year, documentos.Document_path 
              FROM `derroga` 
              JOIN `documentos` ON `derroga`.`Document_id` = `documentos`.`Document_id`
              WHERE `documentos`.`Document_id` = $documentId";
        return $this->run_query($query);
    }
    public function Derrogar($main,  $Derr){
        $query = "INSERT INTO `derroga` (`Document_id`, `Target_id`, `Date`)
        VALUES ('$main', '$Derr', current_timestamp())";
        return $this->run_query($query);
    }

    //keywords
    //select all
    public function getKeywords(){
        $query = "SELECT * FROM keywords ";
        return $this->run_query($query);
    }

    //insert
    public function insertKeyword($nombre) {
        $query = "INSERT INTO `keywords` (`Keywords_id`, `Keywords_name`) VALUES (NULL, '$nombre')";
        return $this->run_query($query);
    }

    //edit
    public function updateKeyword($id, $nombre) {
        $query = "UPDATE keywords SET `Keywords_name` = '$nombre' WHERE `keywords`.`Keywords_id` = $id";
        return $this->run_query($query);
    }

    //contains 
    public function insertContains($doc, $key) {
        $query = "INSERT INTO `contains` (`Document_id`, `Keyword_id`) VALUES ('$doc', '$key')";
        return $this->run_query($query);
    }

    //admins
    public function getadmins() {
        $query = "SELECT * FROM `admin`";
        return $this->run_query($query);
    }

    public function InsertAdmins($name,$last,$email,$corp,$password) {
        $query = "INSERT INTO `admin` (`Admin_id`, `Name`, `Email`, `Password`, `Last_name`, `Cuerpo`) 
        VALUES (NULL, '$name', '$email', '$password', '$last', '$corp')";
        return $this->run_query($query);
    }

    public function updateAdmins($id,$name,$last,$email,$corp,$password) {
        $query = "UPDATE `admin` SET `Name` = '$name', `Email` = '$email', `Password` = '$password', `Last_name` = '$last', `Cuerpo` = '$corp' 
        WHERE `admin`.`Admin_id` = $id";
        return $this->run_query($query);
    }
}
?>

