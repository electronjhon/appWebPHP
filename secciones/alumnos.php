<?php

include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();


$id=isset($_POST['id']) ? $_POST['id'] : '';
$nombres=isset($_POST['nombres']) ? $_POST['nombres'] : '';
$apellidos=isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
$cursos=isset($_POST['cursos']) ? $_POST['cursos'] : '';
$accion=isset($_POST['accion']) ? $_POST['accion'] : '';


if($accion!='') {

    switch($accion) {

        case 'agregar' :

            $sql="INSERT INTO alumnos(id, nombres, apellidos)VALUE(NULL,:nombres, :apellidos)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombres',$nombres);
            $consulta->bindParam(':apellidos',$apellidos);
            $consulta->execute();
            
            $idAlumno=$conexionBD->lastInsertId();

            foreach($cursos as $curso) {
                $sql="INSERT INTO alumnos_cursos (id, id_alumno, id_curso)VALUE(NULL,:id_alumno, :id_curso)";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':id_alumno',$idAlumno);
                $consulta->bindParam(':id_curso',$curso);
                $consulta->execute();
            }

        break;

        case 'Seleccionar' :
            echo "Presionaste seleccionar";
            echo $id;
            $sql="SELECT * FROM alumnos  WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam('id',$id);
            $consulta->execute();
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombres=$alumno['nombres'];
            $apellidos=$alumno['apellidos'];

        break;
        /*case 'editar' :

            $sql="UPDATE alumnos SET nombre_curso=:nombre_curso WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
            
        break;
        case 'borrar' :

            $sql="DELETE FROM alumnos  WHERE id=$id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            
        break;*/
        

    }

}

$sql="SELECT * FROM alumnos";
$listaAlumnos=$conexionBD->query($sql);
$alumnos=$listaAlumnos->fetchAll();

foreach($alumnos as $clave => $alumno) {
    $sql="SELECT * FROM cursos
    WHERE id IN (SELECT id_curso FROM alumnos_cursos WHERE id_alumno=:id_alumno)";

    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':id_alumno',$alumno['id']);
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno;
}

$sql="SELECT * FROM cursos";
$listaCursos=$conexionBD->query($sql);
$cursos=$listaCursos->fetchAll();

?>