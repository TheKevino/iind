<?php
	
	require '../includes/db.php';
	include_once('../includes/user.php');
	include_once('../includes/user_session.php');
	$userSession = new UserSession();
	$user = new User();
	$user->setUser($userSession->getCurrentUser());
	
	/* Nombre de La Tabla */
	//$sTabla = "planeaciondidactica";
	$sTabla = array('planeaciondidactica', 'carreras', 'materias');

	if($user->getTipo()==1){
		$aColumnas = array('idPlaneacion', 'idUsuario', 'carreras.nombre as carrera', 'materias.nombre as materia', 'grupo', 'aula', 'periodo');
	} else{
		$aColumnas = array('idPlaneacion', 'idUsuario', 'nombreDocente', 'carreras.nombre as carrera', 'materias.nombre as materia', 'grupo', 'aula', 'periodo');
	}

	/* columna indexada */
	$sIndexColumn = "idPlaneacion";
	
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
	
	$idUsuario = $user->getIdUsuario();

	//Filtracion
	if($user->getTipo()==1){
		$sWhere = "WHERE (planeaciondidactica.idCarrera = carreras.idCarrera AND planeaciondidactica.idMateria = materias.idMateria) AND idUsuario = $idUsuario";
		$aColumnas = array('idPlaneacion', 'carreras.nombre', 'materias.nombre', 'grupo', 'aula', 'periodo');
	} else{
		$sWhere = "WHERE (planeaciondidactica.idCarrera = carreras.idCarrera AND planeaciondidactica.idMateria = materias.idMateria)";
		$aColumnas = array('idPlaneacion', 'nombreDocente', 'carreras.nombre', 'materias.nombre', 'grupo', 'aula', 'periodo');
	}

	if ( $_GET['sSearch'] != "" )
	{
		$sWhere .= " AND(";
		
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

	if($user->getTipo()==1){
		$aColumnas = array('idPlaneacion', 'idUsuario', 'carreras.nombre as carrera', 'materias.nombre as materia', 'grupo', 'aula', 'periodo');
	} else{
		$aColumnas = array('idPlaneacion', 'idUsuario', 'nombreDocente', 'carreras.nombre as carrera', 'materias.nombre as materia', 'grupo', 'aula', 'periodo');
	}
	
	
	if($user->getTipo()==1){
		
		//Obtener datos para mostrar SQL queries
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
		FROM   ".implode(", ", $sTabla)."
		$sWhere
		$sOrder
		$sLimit
		";

	} else if($user->getTipo()==2){
		//Obtener datos para mostrar SQL queries
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
		FROM   ".implode(", ", $sTabla)."
		$sWhere
		$sOrder
		$sLimit
		";
	}
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
	FROM   ".implode(", ", $sTabla)."
	$sWhere
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

	if($user->getTipo()==1){
		$aColumnas = array('idPlaneacion', 'carrera', 'materia', 'grupo', 'aula', 'periodo');
	} else{
		$aColumnas = array('idPlaneacion', 'nombreDocente', 'carrera', 'materia', 'grupo', 'aula', 'periodo');
	}
	while ( $aRow = $rResult->fetch_array())
	{
		$row = array();
		$tamanio = count($aColumnas);
		for ( $i=0 ; $i<$tamanio ; $i++ )
		{
			if ( $aColumnas[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumnas[$i] ]=="0") ? '-' : $aRow[ $aColumnas[$i] ];
			}
			else if ( $aColumnas[$i] != ' ' )
			{
					//Ver que la columna no sea el idUsuario
					if( $aColumnas[$i] != 'idUsuario' ){
						if( $aColumnas[$i] == 'materia' ){
							$row[] = utf8_decode($aRow[ $aColumnas[$i] ]);
						} else {
							$row[] = $aRow[ $aColumnas[$i] ];
						}//fin if else
						
					} //fin if

			} //fin if else
		}//fin for

		$idUser = base64_encode($user->getIdUsuario());
		$idPlaneacion = base64_encode($aRow['idPlaneacion']);

			$row[] ='<li class="nav-item dropdown">
			<a class="nav-link nav-title drop-op" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a>
			<ul class="dropdown-menu">

				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="planeacionDidactica/views/ver_planeacion.php?id='.$idPlaneacion.'&idu='.$idUser.'" target="_blank">
						Ver y redactar
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link active" aria-current="page"  href="planeacionDidactica/editForm/edit_planeacion_didactica.php?id='.$idPlaneacion.'&idu='.base64_encode($aRow['idUsuario']).'" target="_blank">
						Editar
					</a>
				</li>

			  	<li class="nav-item">
					<a class="nav-link active" aria-current="page"  href="planeacionDidactica/controller/duplicar_planeacion.php?idplaneacion='.$idPlaneacion.'">
						Duplicar Planeacion
					</a>
				</li>

			  	<li class="nav-item">
					<a href="planeacionDidactica/controller/baja_planeacion.php?id='.$idPlaneacion.'">
						<button class="btn-dropdown nav-link" onclick="return confirmacion()">
							Borrar
						</button>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="planeacionDidactica/pdfs/planeacion_tcpdf.php?id='.$idPlaneacion.'&idu='.base64_encode($aRow['idUsuario']).'" target="_blank">
						PDF
					</a>
				</li>

			</ul>
		  </li>';
	
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>