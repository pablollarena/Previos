<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 13/02/2017
 * Time: 05:04 PM
 */
include_once ("ImagenesPartida.php");
class CargaMultiple
{
    function cargarArchivos($imagenes = array(), $sReferencia){
        //Declaramos una bandera que retornará true en caso de que los archivos sean guardados correctamente
        //de lo contrario devolverá false
        $nRet = 0;
        $sCad1 = substr($sReferencia,0,3);
        $sCad2 = substr($sReferencia,4,5);
        $sCad3 = substr($sReferencia, 10, 4);
        $sRef = $sCad1."-".$sCad2."-".$sCad3;
        //Creación del directorio con el nombre de la referencia
        $sUrl = "../Imagenes/".$sRef;
        if(!is_dir($sUrl)){
            mkdir($sUrl,0777,true);
        }


        for($j=0;$j<count($imagenes);$j++){
            if($_FILES['FileImg']['tmp_name'][$j]){
                //var_dump($imagenes);
                //La función explode separa una cadena hasta el delimitador establecido,
                //en este caso usaremos el punto(.), de esta manera obtenemos el nombre
                //y la extensión
                $dato[$j] = explode(".", $_FILES['FileImg']['name'][$j]);
                //La función end ubica el puntero en la última posición
                //del arreglo previamente armado, esto quiere decir que nos ubicaremos en
                //la posición de la extensión del archivo
                $exten[$j] = end($dato[$j]);
                //Valida la extensión de archivo
                if($this->validaExtensión($exten[$j]) == true){
                    //Valida que el archivo exista para que este sea renombrado y/o
                    //sea eliminado
                    $_FILES['FileImg']['name'][$j] = $this->validaExiste($dato[$j],$sUrl);

                    /*$src = ImageCreateFromJPEG($_FILES['imagen']['tmp_name'][$j]);
                    $width = imagesx($src);
                    $height = imagesy($src);
                    $x = $width/2;
                    $y = $height/2;
                    $dst = ImageCreateTrueColor($x,$y);
                    //var_dump($dst);
                    ImageCopyResampled($dst, $src, 0,0,0,0,$x,$y,$width,$height);
                    //header('Content-Type: image/jpg');
                    //ImagePNG($dst);
                    */
                    $oImagen = new ImagenesPartida();
                    $oImagen->setSir60(new Sir60Referencias());
                    $oImagen->getSir60()->setReferencia($sReferencia);
                    $oImagen->setNombreArchivo($_FILES['FileImg']['name'][$j]);
                    $oImagen->setRutaArchivo($sUrl);


                    if(move_uploaded_file($_FILES['FileImg']['tmp_name'][$j],"".$sUrl."/".$_FILES['FileImg']['name'][$j])){
                        $oImagen->insertarImagenes($sRef);
                        $nRet = 1;
                    }
                }else{
                    echo "Extensión no valida";
                }
            }else{
                echo "No hay archivos";
            }
        }
        return $nRet;
    }

    function validaExtensión($sDato){
        $sExten = array("png","jpg","gif");
        if(in_array(strtolower($sDato), $sExten)){
            return true;
        }else{
            return false;
        }
    }

    function validaExiste($sArchivo, $sNombreDir){
        //Obtenemos el nombre del archivo
        $dato = $sArchivo[0] . '.' . end($sArchivo);
        $i = 0;

        while(file_exists("L:/Previos/".$sNombreDir."/".$dato)){
            $i++;
            $dato = $sArchivo[0]."(".$i.")".".".end($sArchivo);
        }
        //Retornar el nombre de la imagen en caso de haber entrado al ciclo
        //De lo contrario devolver el que se había pasado
        return $dato;
    }
}