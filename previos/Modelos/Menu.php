<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 11:56
 */
class Menu
{
    function generarMenu($nGrupo){
        if($nGrupo == 1){
            $menu = array(
                array(
                    'titulo' => 'Previos',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar1',
                            'titulo' => 'Consultar Previos Asignados',
                            'enlace' => '../Vistas/consultarPrev.php',
                        )
                    ),
                    'icon' => 'fa fa-camera'
                ),
                array(
                    'titulo' => 'Glosa',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería',
                            'enlace' => '../Vistas/consultarGal.php',
                        ),
                        array(
                            'id' => 'consultar3',
                            'titulo' => 'Consultar Lo que sea',
                            'enlace' => '../Vistas/consultarGal.php'
                        )
                    ),
                    'icon' => 'fa fa-folder'
                ),
                array(
                    'titulo' => 'Clientes',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Referencias',
                            'enlace' => '../Vistas/consultarRef.php?nGrp='.$nGrupo.''
                        )
                    ),
                    'icon' => 'fa fa-users'
                )
            );
        }else if($nGrupo == 19){
            $menu = array(
                array(
                    'titulo' => 'Previos',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar1',
                            'titulo' => 'Consultar Previos',
                            'enlace' => '../Vistas/glosaBuscaReferencia.php'
                        ),
                        array(
                            'id' => 'consultar1',
                            'titulo' => 'Observaciones',
                            'enlace' => '../Vistas/controlObs.php'
                        )
                    ),
                    'icon' => 'fa fa-camera'
                ),
                array(
                    'titulo' => 'Glosa',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Partida)',
                            'enlace' => '../Vistas/consultarGal.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Contenedor)',
                            'enlace' => '../Vistas/consultarGalCon.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Sobrantes)',
                            'enlace' => '../Vistas/consultarGalSobrantes.php',
                            'icono'  => 'fa fa-folder'
                        ),
                                array(
                                    'id' => 'consultar2',
                                    'titulo' => 'Reportes por Partida',
                                    'enlace' => '../Vistas/consTodosRef.php',
                                    'icono'  => 'fa fa-folder'
                                ),
                                array(
                                    'id' => 'consultar2',
                                    'titulo' => 'Reportes Carga Contenerizada',
                                    'enlace' => '../Vistas/consultarReporteCargaContenerida.php',
                                    'icono'  => 'fa fa-folder'
                                ),
                                array(
                                    'id' => 'consultar2',
                                    'titulo' => 'Reportes Carga Suelta',
                                    'enlace' => '../Vistas/consultarReporteCargaSuelta.php',
                                    'icono'  => 'fa fa-folder'
                                )
                    ),
                    'icon' => 'fa fa-folder'
                )
            );
        }else if($nGrupo == 27){
            $menu = array(
                array(
                    'titulo' => 'Clientes',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Referencias',
                            'enlace' => '../Vistas/consultarRef.php?nGrp='.$nGrupo.''
                        )
                    ),
                    'icon' => 'fa fa-users'
                )
            );
        }else if($nGrupo == 16) {
            $menu = array(
                array(
                    'titulo' => 'Previos',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar1',
                            'titulo' => 'Consultar Previos Asignados',
                            'enlace' => '../Vistas/consultarPrev.php'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Modificar InfoReferencia',
                            'enlace' => '../Vistas/buscarRefMod.php'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Modificar Partidas',
                            'enlace' => '../Vistas/buscarPartidas.php'
                        )
                    ),
                    'icon' => 'fa fa-camera'
                ),
                array(
                    'titulo' => 'Galeria',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Partida)',
                            'enlace' => '../Vistas/consultarGal.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Contenedor)',
                            'enlace' => '../Vistas/consultarGalCon.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Galería(Sobrantes)',
                            'enlace' => '../Vistas/consultarGalSobrantes.php',
                            'icono'  => 'fa fa-folder'
                        )
                    ),
                    'icon' => 'fa fa-folder'
                ),
                array(
                    'titulo' => 'Bitácoras',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Consultar Bitácora por Partida',
                            'enlace' => '../Vistas/consultaBitacoraPartidas.php',
                            'icono'  => 'fa fa-folder'
                        )
                    ),
                    'icon' => 'fa fa-folder'
                ),
                array(
                    'titulo' => 'Reportes',
                    'subcategoria' => array(
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Reportes por Partida',
                            'enlace' => '../Vistas/consTodosRef.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Reportes Carga Contenerizada',
                            'enlace' => '../Vistas/consultarReporteCargaContenerida.php',
                            'icono'  => 'fa fa-folder'
                        ),
                        array(
                            'id' => 'consultar2',
                            'titulo' => 'Reportes Carga Suelta',
                            'enlace' => '../Vistas/consultarReporteCargaSuelta.php',
                            'icono'  => 'fa fa-folder'
                        )
                    ),
                    'icon' => 'fa fa-folder'
                ),

            );
        }
    return $menu;
    }
}