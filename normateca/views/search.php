<?php
  include_once("../controllers/frontend/frontController.php");
  doc();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Normateca - Certificaciones</title>
    <link rel="stylesheet" href="../assets/css/main.css" />
  </head>

  <body>
    <header>
      <img src="../assets/images/arecibo.png" />
      <div>
        <h1>Normateca</h1>
        <h3><i> Universidad de Puerto Rico en Arecibo </i></h3>
      </div>
    </header>
    <div class="titulo">
      <h2>Busqueda de Certificaciones</h2>
    </div>

    <main>
      <section>
        <div class="firstBox">
          <div>
            <h2>Parámetros de Búsqueda</h2>
            <form class="search" action="search.php" method="POST">

              <label for="certification_number">Numero de Certificación</label>
              <input type="search" id="certification_number" name="certification_number" placeholder="Buscar documento..." />
              
          
              <label for="Fiscal_year">Año Fiscal</label>
              <input type="search" id="Fiscal_year" name="Fiscal_year" placeholder="Buscar documento..." />

              <label for="Document_title">Titulo</label>
              <input type="search" id="Document_title" name="Document_title" placeholder="Buscar documento..." />

              <label>Cuerpo</label>
              <div class="filters">
                  <?php
                    if (isset($_SESSION['corps']) && !empty($_SESSION['corps'])) {
                        foreach ($_SESSION['corps'] as $corp) {
                            $checked = (isset($_POST['cuerpo']) && in_array($corp['corp_abbr'], $_POST['cuerpo'])) ? 'checked' : '';
                            echo '<input type="checkbox" id="' . $corp['corp_abbr'] . '" name="cuerpo[]" value="' . $corp['corp_abbr'] . '" ' . $checked . ' />';
                            echo '<label for="' . $corp['corp_abbr'] . '"> ' . $corp['corp_abbr'] . ' - ' . $corp['corp_name'] . ' </label><br />';
                        }
                    }else{
                      echo '<p>No hay cuerpos disponibles</p>';
                    }
                  ?>
              </div>

              <label>Categoria</label>
              <div class="filters">
                  <?php
                    if (isset($_SESSION['cats']) && !empty($_SESSION['cats'])) {
                        foreach ($_SESSION['cats'] as $cat) {
                            echo '<input type="checkbox" id="' . $cat['cat_abbr'] . '" name="categoria[]" value="' . $cat['cat_abbr'] . '" />';
                            echo '<label for="' . $cat['cat_abbr'] . '"> ' . $cat['cat_abbr'] . ' - ' . $cat['cat_name'] . '</label><br />';
                        }
                    }else{
                      echo '<p>No hay cuerpos disponibles</p>';
                    }
                  ?>
              </div>

              <label for="Date_created">Fecha</label>
              <input type="date" id="Date_created" name="Date_created" placeholder="Buscar documento..." />

              <label>Rango de Fecha</label>
              <div class="dates">
                <label for="desde">Desde</label>
                <input type="date" id="desde" name="desde" placeholder="Buscar documento..." />
                <br /><label for="hasta">Hasta</label>
                <input type="date" id="hasta" name="hasta" placeholder="Buscar documento..." />
              </div>
              <button type="button" onclick="Formulariolimpiar()">Limpiar</button>
              <button type="submit">Buscar</button>
            </form>
          </div>
        </div>
             <div class="lastBox">
               <div>
                <hr>
                 <h2>Certificaciones Recientes</h2>
                 
                 <div class="recents">
                   <div class="JA">
                    <?php
                      if (isset($_SESSION['recientes']) && !empty($_SESSION['recientes'])) {
                        foreach ($_SESSION['recientes'] as $rec) {
                          echo '<tr>';
                          echo '<li><a href="'.$rec['path'].'" target="_blank">'.$rec['cuerpo'].' - '.$rec['number'].'-'.$rec['fiscal'].'</a> - '.$rec['title'].'</li>';
                          echo '</tr>';
                        }
                      }else{
                        echo '<p>No hay documentos disponibles</p>';
                      }
                    ?>
                   </div>
                 </div>
               </div>
     
               <div class="results">
                 <label for="records">Records:</label>
                 <form id="myForm" method="post" action="search.php">
                    <select id="records" name="records" onchange="updateRecords()">
                      <option value="10" <?php if ($_SESSION['registros'] == 10) echo 'selected'; ?>>10</option>
                      <option value="25" <?php if ($_SESSION['registros'] == 25) echo 'selected'; ?>>25</option>
                      <option value="50" <?php if ($_SESSION['registros'] == 50) echo 'selected'; ?>>50</option>
                        
                    </select>
                    <input type="hidden" id="selectedRecords" name="selectedRecords" value="10">
                  </form>
                  <table>
                    <thead>
                      <tr>
                        <th>Cuerpo</th>
                        <th>Numero</th>
                        <th>Año Fiscal</th>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Relaciones</th>
                        <th>Descargar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      if (empty($_SESSION['doc'])) {
                        echo '<tr><td colspan="7">No documents available</td></tr>';
                      }else{
                        foreach ($_SESSION['doc'] as $doc) {
                          echo '<tr>';
                          echo '<td>'.$doc['cuerpo'].'</td>'; 
                          echo '<td>'.$doc['certi'].'</td>';
                          echo '<td>'.$doc['fiscal'].'</td>';
                          echo '<td>'.$doc['title'].'</td>';
                          echo '<td>'.$doc['categoria'].'</td>';

                          echo'<td>';
                          if (isset($doc['ammended']) && $doc['ammended'] != null) {
                            echo 'Enmienda a <br>';
                              foreach ($doc['ammended'] as $ammended_doc) {
                                  echo '<a class="black" href="' . $ammended_doc['Document_path'] . '" target="_blank">' . $ammended_doc['Certification_number'] . '-' . $ammended_doc['Fiscal_year'] . '</a><br>';
                              }
                              echo '<br>';
                          }
                          if (isset($doc['derroga']) && $doc['derroga'] != null) {
                            echo 'Derroga a <br>';
                              foreach ($doc['derroga'] as $derroga_doc) {
                                  echo '<a href="' . $derroga_doc['Document_path'] . '" target="_blank">' . $derroga_doc['Certification_number'] . '-' . $derroga_doc['Fiscal_year'] . '</a><br>';
                              }
                          }
                          echo '</td>';

                          echo '<td><a href="' . $doc['path'] . '" target="_blank">ver</a></td>';
                        }
                      }
                    ?>
                    </tbody>
                  </table>

                  <?php

                    // Función para generar la interfaz de paginación
                    function generarPaginacion($current_page, $totalPaginas) {
                        $html = '';

                        if ($totalPaginas > 1) {
                            $html .= '<div class="pagination">';
                            
                            if ($current_page > 1) {
                                $html .= '<a href="?pagina=1">&laquo;</a>';
                            }

                            $range = 3; // Número de páginas antes y después de la página actual
                            $start = max(1, $current_page - $range);
                            $end = min($totalPaginas, $current_page + $range);

                            if ($start > 1) {
                                $html .= '<span>...</span>';
                            }

                            for ($i = $start; $i <= $end; $i++) {
                                $class = ($i == $current_page) ? 'active' : '';
                                $html .= '<a href="?pagina=' . $i . '" class="' . $class . '">' . $i . '</a>';
                            }

                            if ($end < $totalPaginas) {
                                $html .= '<span>...</span>';
                            }

                            if ($current_page < $totalPaginas) {
                                $html .= '<a href="?pagina=' . $totalPaginas . '">&raquo;</a>';
                            }

                            $html .= '</div>';
                        }

                        return $html;
                    }

                    // Obtener la página actual desde la URL
                    $current_page = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

                    // Obtener el número de registros por página
                    $registros_por_pagina = isset($_GET['registros']) ? (int)$_GET['registros'] : 10;

                    // Mostrar la paginación si existen datos de paginación en la sesión
                    if (isset($_SESSION['paginas'])) {
                        foreach ($_SESSION['paginas'] as $pagina) {
                            $totalPaginas = $pagina['pag'];
                            $registros = $pagina['registros'];
                            $total = $pagina['total'];

                            // Calcular el número de página actual basado en el número de registros por página
                            $current_page = min($current_page, ceil($total / $registros_por_pagina));

                            // Calcular el rango de registros a mostrar en la página actual
                            $first = ($current_page - 1) * $registros_por_pagina + 1;
                            $last = min($current_page * $registros_por_pagina, $total);

                            echo '<div class="table-aditional">';
                            echo '<p>Mostrando ' . $first . ' a ' . $last . ' de ' . $total . ' registros</p>';
                            echo generarPaginacion($current_page, $totalPaginas);
                            echo '</div>';
                        }
                    }
                    ?>

          </div>
        </div>
      </section>
    </main>
    <script src="../assets/js/front.js"></script>
  </body>
</html>