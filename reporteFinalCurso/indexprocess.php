<?php
	/*
		* Script:    Tablas de multiples datos del lado del servidor para PHP y MySQL
		* Copyright: 2016 - Marko Robles
		* License:   GPL v2 or BSD (3-point)
	*/
	
	require '../includes/db.php';
	include_once('../includes/user.php');
	include_once('../includes/user_session.php');
	$userSession = new UserSession();
	$user = new User();
	$user->setUser($userSession->getCurrentUser());
	$meses = array(
		"01" => "enero",
		"02" => "febrero",
		"03" => "marzo",
		"04" => "abril",
		"05" => "mayo",
		"06" => "junio",
		"07" => "julio",
		"08" => "agosto",
		"09" => "septiembre",
		"10" => "octubre",
		"11" => "noviembre",
		"12" => "diciembre",
	);
	
	/* Nombre de La Tabla */
	$sTabla = "reportefinal";

	if($user->getTipo()==2){
		/* Array que contiene los nombres de las columnas de la tabla*/
		$aColumnas = array('idReporte', 'idUsuario', 'nombreDocente', 'departamento', 'inicioSemestre', 'finalSemestre', 'gruposAtendidos', 'asignaturasDiferentes');
	} else{
		/* Array que contiene los nombres de las columnas de la tabla*/
		$aColumnas = array('idReporte', 'estado', 'departamento', 'inicioSemestre', 'finalSemestre', 'gruposAtendidos', 'asignaturasDiferentes');
	}
	
	
	
	/* columna indexada */
	$sIndexColumn = "idReporte";
	
	// Paginacion
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
	}
	
	
	//Ordenacion
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumnas[ intval( $_GET['iSortCol_'.$i] ) ]."
				".$_GET['sSortDir_'.$i] .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	//Filtracion
	$sWhere = "";

	$idUsuario = $user->getIdUsuario();
	if($user->getTipo()==1){
		$sWhere = "WHERE (idUsuario = ".$idUsuario.")";
	} else if($user->getTipo()==2){
		$sWhere = "WHERE (estado='subido')";
	}//fin if else

	if ( $_GET['sSearch'] != "" )
	{
		if($user->getTipo()==1){
			$sWhere .= " AND(";
		} else{
			$sWhere = "WHERE(";
		}
		for ( $i=0 ; $i<count($aColumnas) ; $i++ )
		{
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	// Filtrado de columna individual 
	for ( $i=0 ; $i<count($aColumnas) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
		}
	}
	
	
	//Obtener datos para mostrar SQL queries
	$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
	FROM   $sTabla
	$sWhere
	$sOrder
	$sLimit
	";
	$rResult = $conn->query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "
	SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $conn->query($sQuery);
	$aResultFilterTotal = $rResultFilterTotal->fetch_array();
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
	SELECT COUNT(".$sIndexColumn.")
	FROM   $sTabla
	";
	$rResultTotal = $conn->query($sQuery);
	$aResultTotal = $rResultTotal->fetch_array();
	$iTotal = $aResultTotal[0];
	
	/*
		* Output
	*/
	$output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $iTotal,
	"iTotalDisplayRecords" => $iFilteredTotal,
	"aaData" => array()
	);
	
	while ( $aRow = $rResult->fetch_array())
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumnas) ; $i++ )
		{
			if ( $aColumnas[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumnas[$i] ]=="0") ? '-' : $aRow[ $aColumnas[$i] ];
			}
			else if ( $aColumnas[$i] != ' ' )
			{
				//Condicion para no mostrar dicha columna en la tabla
				if($aColumnas[$i] != 'idUsuario' && $aColumnas[$i] != 'inicioSemestre' && $aColumnas[$i] != 'finalSemestre'){
					/* General output */
					$row[] = $aRow[ $aColumnas[$i] ];
				}

				if($aColumnas[$i] == 'inicioSemestre'){
					$fecha = explode("-", $aRow['inicioSemestre']);
					/* General output */
					$row[] = $fecha[2]." ". $meses[$fecha[1]]." ". $fecha[0];
				}

				if($aColumnas[$i] == 'finalSemestre'){
					$fecha = explode("-", $aRow['finalSemestre']);
					/* General output */
					$row[] = $fecha[2]." ". $meses[$fecha[1]]." ". $fecha[0];
				}
			
			}
		}

		$reporte = base64_encode($aRow['idReporte']);
		$usuario = base64_encode($idUsuario);
		
		if($user->getTipo()==1){

			if($aRow['estado'] == 'pendiente'){

				$row[] = "
							<li class='nav-item dropdown'>
								<a class='nav-link nav-title drop-op' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></a>
								<ul class='dropdown-menu'>

									<li class='nav-item'>
										<a class='nav-link active' href='reporteFinalCurso/views/ver_reporte.php?id=".$reporte."&idUs=".$usuario."' target='_blank'>
											Ver
										</a>
									</li>
							
									<li class='nav-item'>
										<a class='nav-link active' href='reporteFinalCurso/editForm/editar_reporte.php?id=".$reporte."'>
											Editar info.
										</a>
									</li>
									
									<li class='nav-item'>
										<a class='nav-link active' href='reporteFinalCurso/views/agregar_asignatura.php?id=".$reporte."&idUs=".$usuario."'>
											Agregar Asignatura
										</a>
									</li>
									
									<li class='nav-item'>
										<a class='nav-link active' href='reporteFinalCurso/controller/baja_reporte.php?id=".$aRow['idReporte']."'>
											<button class='btn btn-borrar' onclick='return confirmacion()'>
												Borrar
											</button>
										</a>
									</li>
									
									<li class='nav-item'>
										<a class='nav-link active' href='reporteFinalCurso/pdfs/reporte_final.php?id=".$reporte."&idUs=".$usuario."' target='_blank'>
											PDF
										</a>
									</li>
								</ul>
							</li>";
			} else {

				$row[] = "
							<li class='nav-item dropdown'>
								<a class='nav-link nav-title drop-op' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></a>
								<ul class='dropdown-menu'>

								<li class='nav-item'>
									<a class='nav-link active' href='reporteFinalCurso/views/ver_reporte.php?id=".$reporte."&idUs=".$usuario."' target='_blank'>
										Ver
									</a>
								</li>
									
								<li class='nav-item'>
									<a class='nav-link active' href='reporteFinalCurso/pdfs/reporte_final.php?id=".$reporte."&idUs=".$usuario."' target='_blank'>
										PDF
									</a>
								</li>

								</ul>
							</li>";

			}

		}	else{

				$row[] = "<li class='nav-item dropdown'>
							<a class='nav-link nav-title drop-op' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></a>
							<ul class='dropdown-menu'>
				
								<li class='nav-item'>
									<a class='nav-link active' href='reporteFinalCurso/controller/baja_reporte.php?id=".$aRow['idReporte']."'>
										<button class='btn btn-borrar' onclick='return confirmacion()'>
											Borrar
										</button>
									</a>
								</li>
					
								<li class='nav-item'>
								<a class='nav-link active' href='reporteFinalCurso/pdfs/reporte_final.php?id=".$reporte."&idUs=".base64_encode($aRow['idUsuario'])."' target='_blank'>
										PDF
									</a>
								</li>

							</ul>
						</li>";
		}

		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>