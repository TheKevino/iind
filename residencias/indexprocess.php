<?php
	/*
		* Script:    Tablas de multiples datos del lado del servidor para PHP y MySQL
		* Copyright: 2016 - Marko Robles
		* License:   GPL v2 or BSD (3-point)
	*/
	
	include_once('../includes/user.php');
	include_once('../includes/user_session.php');
	require '../includes/db.php';
	$userSession = new UserSession();
	$user = new User();
	$user->setUser($userSession->getCurrentUser());
	
	/* Nombre de La Tabla */
	$sTabla = "formularios";
	
	/* Array que contiene los nombres de las columnas de la tabla*/
	$aColumnas = array('idFormulario', 'noControl', 'paternoAlumno', 'maternoAlumno', 'nombresAlumno', 'producto', 'nombreProyecto' );
	
	/* columna indexada */
	$sIndexColumn = "idFormulario";
	
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
		$sWhere = "WHERE (idAsesorInterno = ".$idUsuario." OR idRevisor1= ".$idUsuario." OR idRevisor2 = ".$idUsuario.")";
	}

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
				/* General output */
				$row[] = $aRow[ $aColumnas[$i] ];
			}
		}
		
		//$row[] = "<td><a class='btn btn-primary' href='residencias/Formularios/formulario1.php?id=".$aRow['idFormulario']."'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";

		/*Boton para ver el archivo
		$row[] = "<td>
					<a href='residencias/Formularios/formulario1.php?id=".base64_encode($aRow['idFormulario'])."'>
						<button class='btn btn-secundario'>
							<i class='fa fa-eye'></i>
						</button>
					</a>
				</td>";
		*/
		if($user->getTipo()==2){

			$row[] ='<li class="nav-item dropdown">
			<a class="nav-link nav-title dropdown-toggle drop-op" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Acciones</a>
			<ul class="dropdown-menu">

			<li class="nav-item">
				<a class="nav-link" href="residencias/Formularios/formulario1.php?id='.base64_encode($aRow["idFormulario"]).'" target="_blank">
					Ver / Firmar
		  		</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="residencias/controller/generar_word.php?id='.$aRow["idFormulario"].'" target="_blank">
					WORD
				</a>
		  	</li>

			<li class="nav-item">
			  <a href="residencias/controller/baja_formulario.php?id='.$aRow["idFormulario"].'" target="_blank">
			  	<button class="btn btn-borrar nav-link" onclick="return confirmacion()">
			  		Borrar
		  		</button>
			  </a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="residencias/Formularios/formulario_pdf.php?id='.base64_encode($aRow["idFormulario"]).'" target="_blank">
					PDF
				</a>
			</li>

			</ul>
		  </li>';

		  /*
			
			//Boton para el word
			$row[] = "<td>
						<a href='residencias/controller/generar_word.php?id=".$aRow['idFormulario']."'>
							<button class='btn btn-principal'>
								<i class='fa-solid fa-file-word' aria-hidden='true'></i>
							</button>
						</a>
					</td>";

			//Boton para Borrar
			$row[] = "<td>
						<a href='residencias/controller/baja_formulario.php?id=".$aRow['idFormulario']."'>
							<button class='btn btn-borrar' onclick='return confirmacion()'>
								<i class='fa fa-trash' aria-hidden='true'></i>
							</button>
						</a>
					</td>";

			//Boton para el Editar
			$row[] = "<td>
						<a href='residencias/views/editar_formulario.php?id=".$aRow['idFormulario']."' target='_blank'>
							<button class='btn btn-secundario'>
								<i class='fa fa-pen' aria-hidden='true'></i>
							</button>
						</a>
					</td>";

			*/
		}		

		//$row[] = "<td><a class='btn btn-primary' style='background-color:#f44336; color:white;' href='residencias/Formularios/formulario_pdf.php?id=".$aRow['idFormulario']."' target='_blank'><i class='fa fa-file-pdf-o'></i></a></td>";

		//Boton para el PDF
		$row[] = "<td>
					<a href='residencias/Formularios/formulario_pdf.php?id=".base64_encode($aRow['idFormulario'])."' target='_blank'>
						<button class='btn btn-complementario-a'>
							<i class='fa fa-file-pdf-o'></i>
						</button>
					</a>
				</td>";
		
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>