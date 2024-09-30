<?php
include_once("../db/db_info.php");
class frontModel extends DB
{
   
    public function get_documentos($certificationNumber, $fiscalYear, $keyword, $documentTitle,$cuerpo,$categoria,$date_created,$desde,$hasta,$paginaActual,$registros,$inicio){
        $query = "SELECT documentos.Document_id, documentos.Document_title, documentos.Fiscal_year, documentos.Certification_number, documentos.Document_path, 
        cuerpos.Cuerpo_name, categories.Category_name
        FROM documentos
        JOIN cuerpos ON documentos.Cuerpo_abbr = cuerpos.Cuerpo_abbr
        JOIN categories ON documentos.Category_abbr = categories.Category_abbr
        WHERE  documentos.Document_state = 1";
        
        if ($certificationNumber != '') {
            $query .= " AND documentos.Certification_number LIKE '%$certificationNumber%'";
        }

        if ($fiscalYear != '') {
            $query .= " AND documentos.Fiscal_year LIKE '%$fiscalYear%'";
        }

        if ($keyword != '') {
            $query .= " AND keywords.Keywords_name LIKE '%$keyword%'";
        }

        if ($documentTitle != '') {
            $query .= " AND documentos.Document_title LIKE '%$documentTitle%'";
        }

        if ($date_created != '') {
            $query .= " AND documentos.Date_created LIKE '$date_created'";
        }

        if ($desde != '' AND $hasta != '') {
            $query .= " AND documentos.Date_created BETWEEN '$desde' AND '$hasta'";
        }

        if (!empty($cuerpo)) {
            $cuerpoConditions = [];
            foreach ($cuerpo as $cuerpov) {
                $cuerpoConditions[] = "documentos.Cuerpo_abbr LIKE '%$cuerpov%'";
            }
            $cuerpoQuery = implode(" OR ", $cuerpoConditions);
            $query .= " AND (" . $cuerpoQuery . ")";
        }

        if (!empty($categoria)) {
            $categoriaConditions = [];
            foreach ($categoria as $cate) {
                $categoriaConditions[] = "documentos.Category_abbr LIKE '%$cate%'";
            }
            $cateQuery = implode(" OR ", $categoriaConditions);
            $query .= " AND (" . $cateQuery . ")";
        }
        if ($inicio != '' AND $registros != '') {
            $query .= " LIMIT $inicio, $registros";
        }
        return $this->run_query($query);
    }

    public function numPages($certificationNumber, $fiscalYear, $keyword, $documentTitle, $date_created, $desde, $hasta, $cuerpo, $categoria) {
        $query = "SELECT COUNT(*) as total FROM documentos WHERE 1 = 1";

        if ($certificationNumber != '') {
            $query .= " AND documentos.Certification_number LIKE '%$certificationNumber%'";
        }

        if ($fiscalYear != '') {
            $query .= " AND documentos.Fiscal_year LIKE '%$fiscalYear%'";
        }

        if ($keyword != '') {
            $query .= " AND documentos.Document_title LIKE '%$documentTitle%'";
        }

        if ($date_created != '') {
            $query .= " AND documentos.Date_created LIKE '$date_created'";
        }

        if ($desde != '' AND $hasta != '') {
            $query .= " AND documentos.Date_created BETWEEN '$desde' AND '$hasta'";
        }

        if (!empty($cuerpo)) {
            $cuerpoConditions = [];
        
            foreach ($cuerpo as $cuerpov) {
                $cuerpoConditions[] = "documentos.Cuerpo_abbr LIKE '%$cuerpov%'";
            }
        
            $cuerpoQuery = implode(" OR ", $cuerpoConditions);
        
            $query .= " AND (" . $cuerpoQuery . ")";
        }

        if (!empty($categoria)) {
            $categoriaConditions = [];
        
            foreach ($categoria as $cate) {
                $categoriaConditions[] = "documentos.Category_abbr LIKE '%$cate%'";
            }
        
            $cateQuery = implode(" OR ", $categoriaConditions);
        
            $query .= " AND (" . $cateQuery . ")";
        }
        
        $result = $this->run_query($query);
        return $result;
    }

    public function recientes(){
        $query = "SELECT documentos.Document_title, documentos.Fiscal_year, documentos.Certification_number, cuerpos.Cuerpo_name, documentos.Document_path
        FROM documentos
        join cuerpos on documentos.Cuerpo_abbr = cuerpos.Cuerpo_abbr
        ORDER BY documentos.Document_id DESC
        LIMIT 6";
        return $this->run_query($query);
    }

    public function getCategorias(){
        $query = "SELECT categories.Category_abbr, categories.Category_name, cuerpos.Cuerpo_name, cuerpos.Cuerpo_abbr
        FROM categories
        JOIN cuerpos ON categories.Cuerpo = cuerpos.Cuerpo_abbr"; 
        return $this->run_query($query);
    }

    public function getCuerpos(){
        $query = "SELECT * FROM cuerpos";
        return $this->run_query($query);
    }

    public function enmienda_documents($documentId){
        $query = "SELECT documentos.Certification_number, documentos.Fiscal_year, documentos.Document_path 
              FROM `enmienda` 
              JOIN `documentos` ON `enmienda`.`Document_id` = `documentos`.`Document_id`
              WHERE `documentos`.`Document_id` = $documentId";
        return $this->run_query($query);
    }

    public function derroga_documents($documentId){
        $query = "SELECT documentos.Certification_number, documentos.Fiscal_year, documentos.Document_path 
              FROM `derroga` 
              JOIN `documentos` ON `derroga`.`Document_id` = `documentos`.`Document_id`
              WHERE `documentos`.`Document_id` = $documentId";
        return $this->run_query($query);
    }

    public function contar_registros(){
        $query = "SELECT COUNT(*) as total FROM documentos";
        return $this->run_query($query);
    }

}