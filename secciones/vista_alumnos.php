<?php include ('../templates/cabecera.php'); ?>
<?php include ('../secciones/alumnos.php'); ?>

<div class="row">
<div class="col-5">
      
      <form action="" method="post">
      <div class="card">
            <div class="card-header">
                  Alumnos
            </div>
            <div class="card-body">
                  <div class="mb-3">
                        <label for="" class="form-label">ID</label>
                        <input type="text"
                        class="form-control" 
                        name="id" 
                        value="<?php echo $id;?>"
                        id="id" 
                        aria-describedby="helpId" placeholder="ID">
                  </div>
                  <div class="mb-3">
                        <label for="nombres" class="form-label">Nombre</label>
                        <input type="text"
                        class="form-control" 
                        name="nombres" 
                        value="<?php echo $nombres;?>"
                        id="nombres" 
                        aria-describedby="helpId" placeholder="Escriba el nombre">
                  </div>
                  <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text"
                        class="form-control" 
                        name="apellidos" 
                        value="<?php echo $apellidos;?>"
                        id="apellidos" 
                        aria-describedby="helpId" placeholder="Escriba el apellido">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Cursos del alumno:</label>
                    <select multiple placeholder="Seleccione de la lista" class="form-control" name="cursos[]" id="listaCursos">
                      <?php foreach($cursos as $curso){ ?>
                        <option value="<?php echo $curso['id']; ?>"><?php echo $curso['id']; ?> - <?php echo $curso['nombre_curso']; ?> </option>

                      <?php } ?>
                      
                    </select>
                  </div>
                  <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                        <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                  </div>
            </div>
      </div>
      </form>
      

      
</div>
<div class="col-7">
     <table class="table">
      <thead>
            <tr>
                  <th>ID</th>
                  <th>Alumno</th>
                  <th>Acciones</th>
            </tr>
      </thead>
      <tbody>
            
      <?php foreach($alumnos as $alumno){?>
            <tr>
                  <td>
                         <?php echo $alumno ['id'];?> 
                  </td>
                  <td> 
                        <?php echo $alumno ['nombres'];?> <?php echo $alumno ['apellidos'];?> 
                        <br/>
                        <?php foreach($alumno['cursos'] as $curso){ ?> 
                              - <a href="#"> <?php echo $curso['nombre_curso']; ?></a><br/>
                        <?php } ?>
                  </td>
                  
                  <td> 
                     <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $alumno ['id'];?>">
                        <input type="submit" name="accion" class="btn btn-info" value="Seleccionar">
                     </form>   
                  </td>
            </tr>
            <?php }?>
            
      </tbody>
     </table>
     
</div>
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/js/tom-select.complete.min.js"></script>

<script>
      new TomSelect('#listaCursos');
</script>

<?php include ('../templates/pie.php'); ?> 