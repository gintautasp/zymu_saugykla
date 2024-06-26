<?php

	$dir_bendra = realpath ( __DIR__ . '/../../projects/bendram/' ) . '/';
	
	include $dir_bendra . 'duomenu_baze.class.php';
	
	$db = new DuomenuBaze ( 'zymu_saugykla' );
	
	if ( isset ( $_GET [ 'i' ] ) && intval ( ( $_GET [ 'i' ] ) > 0 ) ) {
	
		$qw_gauti_nuoroda =
				"
			SELECT 
				*
			FROM
				`nuorodos`
			WHERE
				`id`= " . intval ( $_GET [ 'i' ] ) . "
				";
		$rs_list = $db -> uzklausa ( $qw_gauti_nuoroda );
		
		if ( $row = $rs_list -> fetch_assoc() ) {
				
			echo json_encode ( $row );
		}
	}