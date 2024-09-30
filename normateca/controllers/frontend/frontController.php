<?php
    session_start();

    // Initialize session variables with default values if they are not already set
    $_SESSION['certificationNumber'] ??= '';
    $_SESSION['fiscalYear'] ??= '';
    $_SESSION['keyword'] ??= '';
    $_SESSION['documentTitle'] ??= '';
    $_SESSION['categoria'] ??= '';
    $_SESSION['cuerpo'] ??= '';
    $_SESSION['dateCreated'] ??= '';
    $_SESSION['desde'] ??= '';
    $_SESSION['hasta'] ??= '';
    $_SESSION['paginaActual'] ??= '1';
    $_SESSION['registros'] ??= '10';

    include_once("../models/front/frontModel.php");

    function doc(){

        $model = new frontModel("localhost", "normateca", "root", "");
        $model->start_connection();
        
        $categorias = [];
        $cuerpos = [];
        $recientes = [];
        $documentos = [];
        $paginas =[];

        // Define the mapping between $_POST keys and $_SESSION keys
        $postToSessionMap = [
        'certification_number' => 'certificationNumber',
        'Fiscal_year' => 'fiscalYear',
        'Keywordnames' => 'keyword',
        'Document_title' => 'documentTitle',
        'categoria' => 'categoria',
        'cuerpo' => 'cuerpo',
        'Date_created' => 'dateCreated',
        'desde' => 'desde',
        'hasta' => 'hasta',
        'selectedRecords' => 'registros'
        ];

        // Loop through the mapping and set session variables if corresponding POST values exist
        foreach ($postToSessionMap as $postKey => $sessionKey) {
            if (isset($_POST[$postKey]) && $_POST[$postKey] !== '') {
                $_SESSION[$sessionKey] = $_POST[$postKey];
            }
        }

        // Set paginaActual session variable if pagina is set in GET
        if (isset($_GET['pagina'])) {
            $_SESSION['paginaActual'] = (int)$_GET['pagina'];
        }

        // Opcional: puedes también definir variables adicionales para simplificar el código
        $certificationNumber = $_SESSION['certificationNumber'];
        $fiscalYear = $_SESSION['fiscalYear'];
        $keyword = $_SESSION['keyword'];
        $documentTitle = $_SESSION['documentTitle'];
        $categoria = $_SESSION['categoria'];
        $cuerpo = $_SESSION['cuerpo'];
        $date_created = $_SESSION['dateCreated'];
        $desde = $_SESSION['desde'];
        $hasta = $_SESSION['hasta'];
        $paginaActual = $_SESSION['paginaActual'];
        $registros = $_SESSION['registros'];
        $inicio = ($paginaActual - 1) * $registros;

        $contar = $model->contar_registros();
        $total_registros_row = $contar->fetch_assoc();
        $total_registros = $total_registros_row['total'];

        if ($inicio >= $total_registros) {

            $inicio = max(0, $total_registros - $registros);
        }
        
        $result = $model->get_documentos($certificationNumber, $fiscalYear, $keyword, $documentTitle,$cuerpo,$categoria,$date_created,$desde,$hasta,$paginaActual,$registros,$inicio);
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

                $values = array(
                    "id" => $row['Document_id'],
                    "title" => $row['Document_title'],
                    "cuerpo" => $row['Cuerpo_name'],
                    "categoria" => $row['Category_name'],
                    "certi" => $row['Certification_number'],
                    "fiscal" => $row['Fiscal_year'],
                    "path" => $row['Document_path'],
                    "ammended" => $ammended_values, // Guardar los valores devueltos por ammended_documents()
                    "derroga" => $derroga_values // Guardar los valores devueltos por derroga_documents()
                );

                array_push($documentos, $values);
            }
        } else {
            $cuerpos = array();
        }

        $result = $model->getCategorias();
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

        $result = $model->getCuerpos();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values = array(
                    "corp_abbr" => $row['Cuerpo_abbr'],
                    "corp_name" => $row['Cuerpo_name']
                );
                array_push($cuerpos, $values);
            }
        } else {
            $cuerpos = array();
        }

        $result = $model->recientes();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $values = array(
                    "title" => $row['Document_title'],
                    "cuerpo" => $row['Cuerpo_name'],
                    "number" => $row['Certification_number'],
                    "fiscal" => $row['Fiscal_year'],
                    "path" => $row['Document_path']
                );
                array_push($recientes, $values);
            }
        } else {
            $recientes = null;
        }

        $result = $model->numPages($certificationNumber, $fiscalYear, $keyword, $documentTitle, $date_created, $desde, $hasta, $cuerpo, $categoria);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalPaginas = ceil($row['total'] / $registros);
                $values = array(
                    "pag" => $totalPaginas,
                    "registros" => $registros,
                    "total" => $row['total']
                );
                array_push($paginas, $values);
            }
        }

 
        $_SESSION['cats'] = $categorias;
        $_SESSION['corps'] = $cuerpos;
        $_SESSION['recientes'] = $recientes;
        $_SESSION['doc'] = $documentos;
        $_SESSION['paginas'] = $paginas;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpiar']) && $_POST['limpiar'] === 'true') {
        // Set session variables
        $_SESSION['certificationNumber'] = '';
        $_SESSION['fiscalYear'] = '';
        $_SESSION['keyword'] = '';
        $_SESSION['documentTitle'] =  '';
        $_SESSION['categoria'] = '';
        $_SESSION['cuerpo'] = '';
        $_SESSION['dateCreated'] = '';
        $_SESSION['desde'] = '';
        $_SESSION['hasta'] =  '';
        $_SESSION['paginaActual'] = '1';
        $_SESSION['registros'] = '10';
    
        // Redirect
        header("Location: ../../views/search.php");
        exit; // Stop further execution
    }

?>