

<?php

session_start();
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

include_once("../controllers/backend/adminController.php");
setData();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Normateca</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/admin.css" />

</head>

<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
 
  <header>
    <img src="../assets/images/uprlogo.png" />
    <div>
      <h1>Administrador Normateca</h1>
      <h3><i> Universidad de Puerto Rico en Arecibo </i></h3>
    </div>
    <div class="login">
      
      <?php
        if (!empty($_SESSION['login'])) {
            $log = $_SESSION['login'];
            echo "<h2>" . $log['Nombre'] . ' ' . $log['Apellido'] . "</h2>";
        }
      ?>
      <form action="../controllers/backend/logoutController.php" method="post">
        <button type="submit">Cerrar Sesión</button>
      </form>
    </div>
   
  </header>

  <main>
    <section>

      <div id="popup" class="popup" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Documento subido exitosamente
          </div>
        </div>
      </div>

      <div id="popup2" class="popup2" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Documento enmendado exitosamente
          </div>
        </div>
      </div>

      <div id="popup1" class="popup1" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Documento Editado exitosamente
          </div>
        </div>
      </div>

      <div id="popup3" class="popup3" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Documento derrogado exitosamente
          </div>
        </div>
      </div>
      
      <div id="popup4" class="popup4" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Keyword editado exitosamente
          </div>
        </div>
      </div>


      <div id="popup5" class="popup5" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Keyword añadido exitosamente
          </div>
        </div>
      </div>

      <div id="popup6" class="popup6" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Añadido exitosamente
          </div>
        </div>
      </div>

      <div id="popup7" class="popup7" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Editado exitosamente
          </div>
        </div>
      </div>

      <div id="popup8" class="popup8" style="display: none;">
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Añadido exitosamente
          </div>
        </div>
      </div>

      <div class="buttons">
        <button type="button" name="tab" id="subirBtn" class="active">Subir Documento</button>
        <button type="button" name="tab" id="editarBtn">Editar Documento</button>
        <button type="button" name="tab" id="crearBtn">Crear Categorias</button>
        <button type="button" name="tab" id="KeywordsBtn">Keywords</button>
        <button type="button" name="tab" id="adminsBtn">Admins</button>
      </div>

      <div class="tabs">
        <div id="subir" class="subir">
        <h3>Subir Documentos</h3>
        
          <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data" onsubmit="return validateForm()">
          <input type="hidden" value="1" name="type">
            <div class="file">
              <label for="pdf"> Subir Documento: </label><input type="file" id="pdf" name="pdf" value="" required />
            </div>
            <div class="box">
              <div class="innerBox">
                <label for="filename"> Nombre: </label>
                <input type="text" name="filename" id="filename" placeholder="nombre del documento" required />

                <label for="fecha"> Fecha: </label><input type="date" name="filedate" id="fecha" />

                <label for="decripcion"> Descripcion: </label>
                <textarea type="text" name="desc" id="descripcion" rows="5" maxlength="150" placeholder="decripcion del documento. Breve oracion del tema." required></textarea>

                <label for="Numero_certificacion"> Numero_certificacion: </label>
                <input type="text" id="Numero_certificacion" name="number" placeholder="Numero_certificacion" required/>

                <label for="estado"> Estado del Documento: </label>
                <select id="estado" name="state" required>
                    <option disabled selected>Select</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>


                <label for="categorias">Categoria del Documento:</label>
                <select id="categorias" name="category" required>
                  <option disabled selected>Categorias</option>
                  <?php
                    if (!empty($_SESSION['cats'])) {
                        foreach ($_SESSION['cats'] as $cat) {
                            echo '<option value="' . htmlspecialchars($cat['cat_abbr']) . '">' . htmlspecialchars($cat['cat_name']) . '</option>';
                        }
                    } else {
                        echo '<option disabled selected>No hay categorias</option>';
                    }
                  ?>

                </select>
              </div>

              <div class="innerBox">
                <label for="lenguaje"> Lenguaje de Documento: </label>
                <select id="lenguaje" name="lenguaje" required>
                  <option disabled selected>Select</option>
                  <option value="ESP">Español</option>
                  <option value="ENG">Ingles</option>
                </select>

                

                <label for="añofiscal"> Año Fiscal : </label>
                <select id="añofiscal" name="fiscalYear" required>
                  <option disabled selected>Select</option>
                  <?php
                    $anioActual = date("Y");
                    $anioInicio = 1998;
                    for ($i = $anioActual; $i >= $anioInicio; $i--) {
                      $anioFin = $i - 1;
                      echo '<option value="' . $anioFin . '-' . $i . '">' . $anioFin . '-' . $i . '</option>';
                    }
                  ?>
                </select>
                <label for="Cuerpo">Cuerpo: </label>
                <select id="Cuerpo" name="corp" required>
                  <option selected disabled>Select</option>
                  <?php
                    if (!empty($_SESSION['corps'])) {
                        foreach ($_SESSION['corps'] as $corp) {
                            echo '<option value="' . htmlspecialchars($corp['corp_abbr']) . '">' . htmlspecialchars($corp['corp_name']) . '</option>';
                        }
                    } else {
                        echo '<option selected disabled>No hay cuerpos</option>';
                    }
                  ?>

                </select>

                <label for="dropdownMenuButton1">Keywords: </label>
                <div class="dropdown" id="dropdown1" >
                  <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" aria-haspopup="true" aria-expanded="false">
                      Select Keywords
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                      // Dynamically generate checkboxes from session data
                      if(isset($_SESSION['keywords']) && is_array($_SESSION['keywords'])) {
                          foreach ($_SESSION['keywords'] as $keyword) {
                              echo '<label><input type="checkbox" class="dropdown-checkbox" name="selected_keywords[]" value="' . $keyword['keyword_id'] . '">' . $keyword['keyword_name'] . '</label><br>';
                          }
                      }
                    ?>
                  </div>
                </div>

                <label for="firma"> Firmado por: </label>
                <input required type="text" id="firma" name="signature" value="<?php echo htmlspecialchars($log['Nombre'] . ' ' . $log['Apellido']); ?>" readonly>
              </div>
            </div>
            <?php
              //
              if (isset($_SESSION['form_success']) && $_SESSION['form_success']) {
                  // Display the success message
                  echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const popup = document.getElementById("popup");

                            // Show the popup
                            popup.style.display = "block";

                            // Hide the popup after 5 seconds
                            setTimeout(function() {
                              popup.style.display = "none";
                            }, 5000);
                          });
                        </script>';
                  
                  // Unset the session variable to avoid showing the message again on subsequent page loads
                  unset($_SESSION['form_success']);
              }
              ?>
              
             
            <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
          </form>

          <div class="backline">
            <h3>Añadir enlace a otro Documento</h3>
            <div class="search-bar">
            
            <form class="gabriel" method="POST" action="admin.php" style="display: flex;">
                <input type="hidden" value="20" name="type">
                <input type="text" id="search_query2" name="search_query2" placeholder="Buscar por nombre" />
                <button class="color" type="submit">Buscar</button>
                <button class="color" type="button" onclick="limpiar()">Limpiar</button>
            </form>

            </div>

            <table>
              <thead>
                <tr>
                  <th>Certification number</th>
                  <th>Titulo</th>
                  <th>Categoria</th>
                  <th>Relacion</th>
                  <th>Enlazar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (isset($_POST['search_query2'])) {
                    
                    $search_query2 = $_POST['search_query2'];
                    
                    
                    // Filtrar los documentos
                    $filtered_results = array_filter($_SESSION['Enlazar'], function($Enlazar) use ($search_query2) {
                  
                      return stripos($Enlazar['title'], $search_query2) !== false;
                    });

                   

                    // data filtrada por el nombre del documento
                    if (count($filtered_results) > 0) {
                        foreach ($filtered_results as $Enlazar) {
                          echo '<tr><th>' . $Enlazar['number'] .'-'. $Enlazar['fiscal'] .'</th><th>'.$Enlazar['title'] .'</th><th>'.$Enlazar['category'] .'</th>';  

                          echo '<th>';
                          if (isset($Enlazar['ammended']) && $Enlazar['ammended'] != null) {
                            echo 'Enmienda a <br>';
                              foreach ($Enlazar['ammended'] as $ammended_doc) {
                                  echo '<a href="' . $ammended_doc['Document_path'] . '" target="_blank">' . $ammended_doc['Certification_number'] . '-' . $ammended_doc['Fiscal_year'] . '</a><br>';
                              }
                          }
                          if (isset($Enlazar['derroga']) && $Enlazar['derroga'] != null) {
                            echo 'Derroga a <br>';
                              foreach ($Enlazar['derroga'] as $derroga_doc) {
                                  echo '<a href="' . $derroga_doc['Document_path'] . '" target="_blank">' . $derroga_doc['Certification_number'] . '-' . $derroga_doc['Fiscal_year'] . '</a><br>';
                              }
                          }
                          echo '</th>';
                          
                          echo '<td style="text-align: center;"><div class="Endiv"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Enmendar"
                            data-Eid="'.$Enlazar['id'].'" 
                            data-Enumber="'.$Enlazar['number'].'" 
                            data-Efiscal="'.$Enlazar['fiscal'].'" 
                            data-Etitle="'.$Enlazar['title'].'"
                            data-Ecategory="'.$Enlazar['category'].'"
                            onclick="Enmendar(this)">Enmendar</button>';
                          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#derrogar"
                            data-id="'.$Enlazar['id'].'" 
                            data-number="'.$Enlazar['number'].'" 
                            data-fiscal="'.$Enlazar['fiscal'].'" 
                            data-title="'.$Enlazar['title'].'"
                            data-category="'.$Enlazar['category'].'"
                            onclick="derrogar(this)">Derrogar</button></div></td>';
                          echo '</tr>';
                        }
                    } else { 
                      print '<tr><td colspan="5" style="text-align:center">No se encontraron documentos</td></tr>';
                    }
                  } else {
                    if (!empty($_SESSION['Enlazar'])) {
                      foreach ($_SESSION['Enlazar'] as $Enlazar) {
                          echo '<tr>';
                          echo '<th>' . htmlspecialchars($Enlazar['number']) . '-' . htmlspecialchars($Enlazar['fiscal']) . '</th>';
                          echo '<th>' . htmlspecialchars($Enlazar['title']) . '</th>';
                          echo '<th>' . htmlspecialchars($Enlazar['category']) . '</th>';
                          
                          echo '<th>';
                          if (isset($Enlazar['ammended']) && !empty($Enlazar['ammended'])) {
                              echo 'Enmienda a <br>';
                              foreach ($Enlazar['ammended'] as $ammended_doc) {
                                  echo '<a class="black" href="' . htmlspecialchars($ammended_doc['Document_path']) . '" target="_blank">' . htmlspecialchars($ammended_doc['Certification_number']) . '-' . htmlspecialchars($ammended_doc['Fiscal_year']) . '</a><br>';
                              }
                          }
                          if (isset($Enlazar['derroga']) && !empty($Enlazar['derroga'])) {
                              echo 'Derroga a <br>';
                              foreach ($Enlazar['derroga'] as $derroga_doc) {
                                  echo '<a href="' . htmlspecialchars($derroga_doc['Document_path']) . '" target="_blank">' . htmlspecialchars($derroga_doc['Certification_number']) . '-' . htmlspecialchars($derroga_doc['Fiscal_year']) . '</a><br>';
                              }
                          }
                          echo '</th>';
                  
                          echo '<td style="text-align: center;"><div class="Endiv"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Enmendar"
                            data-Eid="'. htmlspecialchars($Enlazar['id']) .'" 
                            data-Enumber="'. htmlspecialchars($Enlazar['number']) .'" 
                            data-Efiscal="'. htmlspecialchars($Enlazar['fiscal']) .'" 
                            data-Etitle="'. htmlspecialchars($Enlazar['title']) .'"
                            data-Ecategory="'. htmlspecialchars($Enlazar['category']) .'"
                            onclick="Enmendar(this)">Enmendar</button>';
                          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#derrogar"
                            data-Did="'. htmlspecialchars($Enlazar['id']) .'" 
                            data-Dnumber="'. htmlspecialchars($Enlazar['number']) .'" 
                            data-Dfiscal="'. htmlspecialchars($Enlazar['fiscal']) .'" 
                            data-Dtitle="'. htmlspecialchars($Enlazar['title']) .'"
                            data-Dcategory="'. htmlspecialchars($Enlazar['category']) .'"
                            onclick="derrogar(this)">Derrogar</button></div></td>';
                          echo '</tr>';
                      }
                  } else {
                      echo '<tr><td colspan="4" style="text-align:center">Documentos no disponibles</td></tr>';
                  }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
              
        <?php
              //
              if (isset($_SESSION['form_edit']) && $_SESSION['form_edit']) {
                  // Display the success message
                  echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const popup1 = document.getElementById("popup1");

                            // Show the popup
                            popup1.style.display = "block";

                            // Hide the popup after 5 seconds
                            setTimeout(function() {
                              popup1.style.display = "none";
                            }, 5000);
                          });
                        </script>';
                  
                  // Unset the session variable to avoid showing the message again on subsequent page loads
                  unset($_SESSION['form_edit']);
              }
              ?>


              
             <script>
                  document.addEventListener("DOMContentLoaded", function() {
                      // Get the button element
                      const addCat = document.getElementById("addCat");
              
                      // Add click event listener to the button
                      addCat.addEventListener("click", function() {
                          // Show the alert
                          const popup6 = document.getElementById("popup6");
                          popup5.style.display = "block";
              
                          // Hide the alert after 5 seconds
                          setTimeout(function() {
                              popup6.style.display = "none";
                          }, 5000);
                      });
                  });
              </script>
        
      <div id="editar" class="editar" style="display: none">
        <div class="backline">
            <h3>Editar Documento</h3>
            <div class="search-bar">
                <form class="gabriel" method="POST" action="admin.php" style="display: flex;">
                    <input type="hidden" value="21" name="type">
                    <input type="text" name="searchQuery" placeholder="Buscar por nombre">
                    <button type="submit">Buscar</button>
                    <button class ="color" type="button" onclick="limpiar1()">Limpiar</button>
                </form>
            </div>
        </div>
        
        <table>
            <thead>
              <tr>
                  <th>Certification number </th>
                  <th>Titulo</th>
                  <th>Categoria</th>
                  <th>Editar</th>
              </tr>
            </thead>
            <tbody>
            <?php
              if (isset($_SESSION['documentos']) && is_array($_SESSION['documentos'])) {
                  // Check if searchQuery is set and apply filtering if necessary
                  $filteredDocuments = $_SESSION['documentos'];
                  if (isset($_POST['searchQuery'])) {
                      $searchQuery = $_POST['searchQuery'];
                      // Filter documents based on the search query
                      $filteredDocuments = array_filter($filteredDocuments, function($documento) use ($searchQuery) {
                          return stripos($documento['Document_title'], $searchQuery) !== false;
                      });
                  }

                  // Output documents
                  foreach ($filteredDocuments as $documento) {
                      echo '<tr><th>' . htmlspecialchars($documento['certi']) . '-' . htmlspecialchars($documento['fiscal']) . '</th>';
                      echo '<th>' . htmlspecialchars($documento['Document_title']) . '</th>';
                      echo '<th>' . htmlspecialchars($documento['categoria']) . '</th>';
                      echo '<td style="text-align: center;"><div class="Endiv"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Editar"
                      data-EDid="' . htmlspecialchars($documento['Document_id']) . '" 
                      data-EDtitle="' . htmlspecialchars($documento['Document_title']) . '" 
                      data-EDcuerpo="' . htmlspecialchars($documento['cuerpo']) . '" 
                      data-EDcategory="' . htmlspecialchars($documento['category']) . '"
                      data-EDcerti="' . htmlspecialchars($documento['certi']) . '"
                      data-EDfiscal="' . htmlspecialchars($documento['fiscal']) . '" 
                      data-EDlenguaje="' . htmlspecialchars($documento['lenguaje']) . '"
                      data-EDpath="' . htmlspecialchars($documento['path']) . '" 
                      data-EDestado="' . htmlspecialchars($documento['estado']) . '" 
                      onclick="EditDocumentos(this)">Editar</button></div></td>';
                  }
              } else {
                  // Handle the case where $_SESSION['documentos'] is not set or null
                  echo '<tr><td colspan="4" style="text-align:center">No hay documentos disponibles</td></tr>';
              }
            ?>


            </tbody>
          </table>
        </div>
      
        <div id="crear" class="crear back" style="display: none">
          <h3>Categorias disponibles</h3>
          <table>
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Abreviacion</th>
                <th>Cuerpo</th>
                <th>Acccion</th>
              </tr>
            </thead>
            <tbody id="categorias">
              <?php
                if (count($_SESSION['Allcats']) > 0) {
                  foreach ($_SESSION['Allcats'] as $cat) {
                    echo '<tr>';
                    echo '<td>' . $cat['cat_name'] . '</td>';
                    echo '<td>' . $cat['cat_abbr'] . '</td>';
                    echo '<td>' . $cat['cat_corp'] . '</td>';
                    echo '<td style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditCategoria"
                    data-nombre="' . $cat['cat_name'] . '"
                    data-abreviacion="' . $cat['cat_abbr'] . '"
                    data-cuerpo="' . $cat['cat_corp_abbr'] . '" 
                    onclick="editcategori(this)">Editar</button></td>';
                    echo '</tr>';
                  }
                } else {
                  print '<tr><td colspan="2" style="text-align:center">Categorias no disponibles</td></tr>';
                }
              ?>
              <tr>
                <td colspan="4" style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCategoria">Añadir Category</button></td>
              </tr>
            </tbody>
          </table>

          <h3>Cuerpos disponibles</h3>
          <table>
            <thead>
              <tr>
                <th>Cuerpos</th>
                <th>Abreviacion</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($_SESSION['Allcorps']) > 0) {
                foreach ($_SESSION['Allcorps'] as $corp) {
                  echo '<tr>';
                  echo '<td>' . $corp['corp_name'] . '</td>';
                  echo '<td>' . $corp['corp_abbr'] . '</td>';
                  echo '<td style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Editcuerpo"
                    data-nombreCuerpo="' . $corp['corp_name'] . '"
                    data-abreviacionCuerpo="' . $corp['corp_abbr'] . '"
                    onclick="Editcuerpo(this)">Editar</button></td>';
                    echo '</tr>';
                }
              } else {
                print '<tr><td colspan="2" style="text-align:center">Categorias no disponibles</td></tr>';
              }
              ?>
              <tr>
                <td colspan="4" style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCuerpo">Añadir Cuerpo</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div id="keyword" class="keywords" style="display: none">
          <h3>Keywords</h3>
          <table>
            <thead>
              <tr>
                <th>Keyword</th>
                <th>Accion</th>
                <th>Keyword</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody id="keywords">
            <?php
              if (count($_SESSION['keywords']) > 0) {
                  $keywords = $_SESSION['keywords'];
                  for ($i = 0; $i < count($keywords); $i += 2) {
                      echo '<tr>';
                      
                      // Primer Keyword_name y botón
                      echo '<td>' . $keywords[$i]['keyword_name'] . '</td>';
                      echo '<td style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Editkeywords"
                              data-Key_name="' . $keywords[$i]['keyword_name'] . '"
                              data-Key_id="' . $keywords[$i]['keyword_id'] . '"
                              onclick="editkeywords(this)">Editar</button></td>';
                      
                      // Segundo Keyword_name y botón (si está disponible)
                      if ($i + 1 < count($keywords)) {
                          echo '<td>' . $keywords[$i + 1]['keyword_name'] . '</td>';
                          echo '<td style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Editkeywords"
                                  data-Key_name="' . $keywords[$i + 1]['keyword_name'] . '"
                                  data-Key_id="' . $keywords[$i + 1]['keyword_id'] . '"
                                  onclick="editkeywords(this)">Editar</button></td>';
                      } else {
                          // Si no hay un segundo Keyword_name, imprimir celdas vacías
                          echo '<td></td>';
                          echo '<td></td>';
                      }
                      
                      echo '</tr>';
                  }
              }
              
            ?>
              <tr>
                <td colspan="4" style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddKeyword">Añadir Keyword</button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="admins" class="admins" style="display: none">
          <h3>Admins</h3>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Cuerpo</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
            <?php
              if (isset($_SESSION['admins']) && count($_SESSION['admins']) > 0) {
                foreach ($_SESSION['admins'] as $admin) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($admin['admin_name']) . ' ' . htmlspecialchars($admin['admin_last_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($admin['admin_email']) . '</td>';
                    echo '<td>' . htmlspecialchars($admin['admin_cuerpo']) . '</td>';
                    echo '<td style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditarAdmin" 
                    data-admin_id="' . htmlspecialchars($admin['admin_id']) . '" 
                    data-admin_name="' . htmlspecialchars($admin['admin_name']) . '" 
                    data-admin_lastname="' . htmlspecialchars($admin['admin_last_name']) . '" 
                    data-admin_email="' . htmlspecialchars($admin['admin_email']) . '" 
                    data-admin_cuerpo="' . htmlspecialchars($admin['admin_cuerpo']) . '" 
                    data-admin_password="' . htmlspecialchars($admin['admin_password']) . '" 
                    onclick="editadmins(this)">Editar</button></td>';
                    echo '</tr>';
                }
              }
              ?>
              <tr>
                <td colspan="4" style="text-align: center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertAdmin">Añadir admin</button></td>
              </tr>
            </tbody>
          </table>
        </div>


      </div>
    </section>
  </main>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/admin.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    function limpiar() {
          // Get the input field
          var inputField = document.querySelector('input[name="search_query2"]');
          
          inputField.value = '';
          
          document.querySelector('.gabriel').submit();
      }

    function limpiar1() {
          var inputField = document.querySelector('input[name="searchQuery"]');
          
          inputField.value = '';
          
          document.querySelector('.gabriel').submit();
      }
  </script>
</body>
</html>

<?php
  if (isset($_POST['submit'])){
    $categoria = isset($_POST['cate']) ? $_POST['cate'] : '';
    $abbv = isset($_POST['abbv']) ? $_POST['abbv'] : '';
  }
?>

<!-- AddCategoria -->
<div class="modal" id="AddCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Añadir Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
          <input type="hidden" value="3" name="type">
          <label for="cate">Nombre de la categoria</label>
          <input type="text" class="form-control" id="cate" name="categoria">

          <label for="Abre">Abreviacion</label>
          <input type="text" class="form-control" id="Abre" min="2" max="3" name="Abreviacion">

          <label for="cuerpoCategoria">Cuerpo</label>
            <select class="form-control" id="cuerpoCategoria" name="cuerpo">
                <?php
                if (count($_SESSION['corps']) > 0) {
                  echo '<option value=""> </option>';
                  foreach ($_SESSION['corps'] as $corp) {
                    echo "<option value='" . $corp['corp_abbr'] . "'>" . $corp['corp_name'] . "</option>";
                  }
                }
                ?>
            </select>
          <br>
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- editCategoria -->
<div class="modal" id="EditCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Editar Categoria</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
          <input type="hidden" value="6" name="type">
          <input type="hidden" value="" name="oldabbr" id="oldabbr">
          <label for="nombreCategoria">Nombre de la Categoria</label>
          <input type="text" class="form-control" id="nombreCategoria" name="categoria">

          <label for="abreviacionCategoria">Abreviacion</label>
          <input type="text" class="form-control" id="abreviacionCategoria" min="2" max="3" name="Abreviacion">

          <label for="editCatCorporacion">Cuerpo</label>
          <select id="cuerpoDropdown" name="cuerpoDropdown" class="form-control">
            <?php
            if (count($_SESSION['corps']) > 0) {
              echo '<option value=""> </option>';
              foreach ($_SESSION['corps'] as $corp) {
                $value = $corp['corp_abbr'];
                $text = $corp['corp_name'];
                echo "<option value='$value'>$text</option>";
              }
            }
            ?>
          </select>

          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- AddCuerpo -->
<div class="modal" id="AddCuerpo">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Añadir Cuerpo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
          <input type="hidden" value="4" name="type">
          <label for="cuerpo">Nombre de la Cuerpo</label>
          <input type="text" class="form-control" id="cuerpo" name="cuerpo">

          <label for="Abre">Abreviacion</label>
          <input type="text" class="form-control" id="Abre" min="2" max="3" name="Abreviacion">
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- AddCuerpo -->
<div class="modal" id="Editcuerpo">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Editar Cuerpo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
          <input type="hidden" value="5" name="type">
          <input type="hidden" value="" name="oldabbr" id="oldabbr2">
          <label for="EnombreCuerpo">Nombre de la Cuerpo</label>
          <input type="text" class="form-control" id="EnombreCuerpo" name="cuerpo">

          <label for="Eabreviacioncuerpo">Abreviacion</label>
          <input type="text" class="form-control" id="Eabreviacioncuerpo" min="2" max="3" name="Abreviacion">
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

          <?php
if (isset($_SESSION['addcatt']) && $_SESSION['addcatt']) {
                  // Display the success message
                  echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const popup8 = document.getElementById("popup8");

                            // Show the popup
                            popup8.style.display = "block";

                            // Hide the popup after 5 seconds
                            setTimeout(function() {
                              popup8.style.display = "none";
                            }, 5000);
                          });
                        </script>';
                  
                  // Unset the session variable to avoid showing the message again on subsequent page loads
                  unset($_SESSION['addcatt']);
              }
              ?>
                <?php
if (isset($_SESSION['editcatt']) && $_SESSION['editcatt']) {
                  // Display the success message
                  echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const popup7 = document.getElementById("popup7");

                            // Show the popup
                            popup7.style.display = "block";

                            // Hide the popup after 5 seconds
                            setTimeout(function() {
                              popup7.style.display = "none";
                            }, 5000);
                          });
                        </script>';
                  
                  // Unset the session variable to avoid showing the message again on subsequent page loads
                  unset($_SESSION['editcatt']);
              }
              ?>

                <?php
if (isset($_SESSION['amended_s']) && $_SESSION['amended_s']) {
                  // Display the success message
                  echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const popup2 = document.getElementById("popup2");

                            // Show the popup
                            popup2.style.display = "block";

                            // Hide the popup after 5 seconds
                            setTimeout(function() {
                              popup2.style.display = "none";
                            }, 5000);
                          });
                        </script>';
                  
                  // Unset the session variable to avoid showing the message again on subsequent page loads
                  unset($_SESSION['amended_s']);
              }
              ?>

              <?php
              if (isset($_SESSION['derrogado_s']) && $_SESSION['derrogado_s']) {
                                // Display the success message
                                echo '<script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                          const popup3 = document.getElementById("popup3");

                                          // Show the popup
                                          popup3.style.display = "block";

                                          // Hide the popup after 5 seconds
                                          setTimeout(function() {
                                            popup3.style.display = "none";
                                          }, 5000);
                                        });
                                      </script>';
                                
                                // Unset the session variable to avoid showing the message again on subsequent page loads
                                unset($_SESSION['derrogado_s']);
                            }
                ?>

<!-- Enlazar -->
<div class="modal" id="Enmendar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Enmendar documento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
        <input type="hidden" value="7" name="type">
          <section class="Ensection">
            <h3 id="EnTitulo"></h3>
            <div>
              <h3 id="EnNumber"></h3>
              <h3>-</h3>
              <h3 id="EnFiscal"></h3>
            </div>
          </section>
          <input type="hidden" value="" name="MainDoc" id="EnId">
          <div class="Endocs">
            <h3>Enmienda al documento</h3>
            <select  name="amendedDoc">
              <?php
                if (count($_SESSION['Enlazar']) > 0) {
                  echo "<option selected disabled>Documentos</option>";
                  foreach ($_SESSION['Enlazar'] as $docs) {
                    $value = $docs['id'];
                    $text = $docs['title'];
                    echo "<option value='$value'>$text</option>";
                  }
                }
              ?>
            </select>
          </div>
          
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="derrogar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Derrogar documento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
        <input type="hidden" value="8" name="type">
          <section class="Ensection">
            <h3 id="DerTitle"></h3>
            <div>
              <h3 id="DerNumber"></h3>
              <h3>-</h3>
              <h3 id="DerFiscal"></h3>
            </div>
          </section>
          <input type="hidden" value="" name="MainDoc" id="DerId">
          <div class="Endocs">
            <h3>Enmienda al documento</h3>
            <select  name="derrogaDoc">
              <?php
                if (count($_SESSION['Enlazar']) > 0) {
                  echo "<option selected disabled>Documentos</option>";
                  foreach ($_SESSION['Enlazar'] as $docs) {
                    $value = $docs['id'];
                    $text = $docs['title'];
                    echo "<option value='$value'>$text</option>";
                  }
                }
              ?>
            </select>
          </div>
          
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Editar Documento -->
<div class="modal" id="Editar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Editar Documento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">
          <input type="hidden" value="2" name="type">

          <input type="hidden" value="" id="EDid" name="documentoId">
          <input type="hidden" value="" id="EDcuerpo" name="Cuerpo">
          
          <label for="nombreDocumento">Nombre del Documento</label>
          <input type="text"  id="EDtitle" name="nombreDocumento">

          <label for="fechaDocumento">Categoria del Documento</label>
          <select id="EDcategory" name="categoria">
            <option selected disabled>Select</option>
            <?php
              if (count($_SESSION['cats']) > 0) {
                foreach ($_SESSION['cats'] as $cat) {
                  echo '<option value="' . $cat['cat_abbr'] . '">' . $cat['cat_name'] . '</option>';
                }
              }
            ?>
          </select>

          <label for="certi">Numero de certificacion </label>
          <input type="number" class="form-control" id="EDcerti" name="certi">
           
          <label for="fiscal">Año Fiscal</label>
          <select id="EDfiscal" name="fiscalYear">
            <option disabled>Select</option>
            <?php
              $anioActual = date("Y");
              $anioInicio = 1998;
              for ($i = $anioActual; $i >= $anioInicio; $i--) {
                $anioFin = $i - 1;
                echo '<option value="' . $anioFin . '-' . $i . '">' . $anioFin . '-' . $i . '</option>';
              }
            ?>
          </select>

          <label for="lenguaje"> Lenguaje de Documento: </label>
          <select id="EDlenguaje" name="lenguaje" class="form-control">
            <option selected disabled>Select</option>
            <option value="ESP">Español</option>
            <option value="ENG">Ingles</option>
          </select>

          <label for="estado"> Estado del Documento: </label>
          <select id="EDestado" name="estado" class="form-control">
            <option selected disabled>Select</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>

          <input type="hidden" value="" id="EDpath" name="OldPath">

          <label for="path">Subir Documento:</label>
          <input type="file" id="path" name="path" value="" />
          
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>
    <?php
      if (isset($_SESSION['key_edit']) && $_SESSION['key_edit']) {
      // Display the success message
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                  const popup4 = document.getElementById("popup4");

                  // Show the popup
                  popup4.style.display = "block";

                  // Hide the popup after 5 seconds
                  setTimeout(function() {
                    popup4.style.display = "none";
                  }, 5000);
                });
              </script>';
        
        // Unset the session variable to avoid showing the message again on subsequent page loads
        unset($_SESSION['key_edit']);
      }
    ?>

<div class="modal" id="Editkeywords">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Editar keyword</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">

        <input type="hidden" value="9" name="type">
        <input type="hidden" value="" id="key_id" name="key_id">
        
          <label for="key_nombre">Keyword</label>
          <input type="text" id="key_nombre" name="key" value="" />
          
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>
      <?php
  if (isset($_SESSION['key_add']) && $_SESSION['key_add']) {
      // Display the success message
      echo '<script>
              document.addEventListener("DOMContentLoaded", function() {
                const popup5 = document.getElementById("popup5");

                // Show the popup
                popup5.style.display = "block";

                // Hide the popup after 5 seconds
                setTimeout(function() {
                  popup5.style.display = "none";
                }, 5000);
              });
            </script>';
      
      // Unset the session variable to avoid showing the message again on subsequent page loads
      unset($_SESSION['key_add']);
  }
    ?>
<div class="modal" id="AddKeyword">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Añadir keyword</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">

        <input type="hidden" value="10" name="type">
        
          <label for="key_nombre">Keyword</label>
          <input type="text" id="key_nombre" name="key" value="" />
          
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="EditarAdmin">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Editar Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">

          <input type="hidden" value="11" name="type">

          <input type="hidden" id="Adminpassword" name="oldpassword" value="">
          <input type="hidden" id="Adminid" name="Adminid" value="">
        
          <label for="Adminname">Nombre</label>
          <input type="text" id="Adminname" name="adminname" value="" />

          <label for="key_nombre">Apellido</label>
          <input type="text" id="Adminlastname" name="adminlast" value="" />

          <label for="key_nombre">Email</label>
          <input type="text" id="Adminemail" name="adminEmail" value="" />

          <label for="fechaDocumento">Cuerpo</label>
          <select id="Admincuerpo" name="admincorp">
            <option selected disabled>Select</option>
            <?php
              if (count($_SESSION['Allcorps']) > 0) {
                foreach ($_SESSION['Allcorps'] as $corp) {
                  echo '<option value="' . $corp['corp_abbr'] . '">' . $corp['corp_name'] . '</option>';
                }
              }
            ?>
          </select>

          <label for="key_nombre">password</label>
          <input type="text" id="key_nombre" name="newpassword" value="" />

          <label for="key_nombre">confirm password</label>
          <input type="text" id="key_nombre" name="newpassword2" value="" />
            
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="insertAdmin">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Cabecera del modal -->
      <div class="modal-header" >
          <h4 class="modal-title">Añadir Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body editar form">
        <form method="POST" action="../controllers/backend/adminController.php" enctype="multipart/form-data">

          <input type="hidden" value="12" name="type">
        
          <label for="Adminname">Nombre</label>
          <input type="text" id="Adminname" name="adminname" value="" />

          <label for="key_nombre">Apellido</label>
          <input type="text" id="Adminlastname" name="adminlast" value="" />

          <label for="key_nombre">Email</label>
          <input type="text" id="Adminemail" name="adminEmail" value="" />

          <label for="fechaDocumento">Cuerpo</label>
          <select id="Admincuerpo" name="admincorp">
            <option selected disabled>Select</option>
            <?php
              if (count($_SESSION['Allcorps']) > 0) {
                foreach ($_SESSION['Allcorps'] as $corp) {
                  echo '<option value="' . $corp['corp_abbr'] . '">' . $corp['corp_name'] . '</option>';
                }
              }
            ?>
          </select>

          <label for="key_nombre">password</label>
          <input type="text" id="key_nombre" name="newpassword" value="" />

          <label for="key_nombre">repeat password</label>
          <input type="text" id="key_nombre" name="newpassword2" value="" />
            
          <input class ="btn btn-primary" type="submit" name="submit" value="Guardar" />
        </form>
      </div>
    </div>
  </div>
</div>


<script>
 function validateForm() {
  var filename = document.getElementById("filename").value;
  var filedate = document.getElementById("fecha").value;
  var desc = document.getElementById("descripcion").value;
  var numeroCertificacion = document.getElementById("Numero_certificacion").value;
  var estado = document.getElementById("estado").value;
  var categoria = document.getElementById("categorias").value;

  // Check if any of the required fields are empty
  if (filename == "" || filedate == "" || desc == "" || numeroCertificacion == "" || estado == "" || categoria == "") {
    alert("Please fill out all required fields.");
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}
        </script>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>