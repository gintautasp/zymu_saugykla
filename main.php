<?php
	
	define ( 'DIR_MAIN', __DIR__ . '/' );
	
	$dir_bendra = realpath ( __DIR__ . '/../bendram/' ) . '/';
	
	include $dir_bendra . 'duomenu_baze.class.php';
	
	$db = new DuomenuBaze ( 'zymu_saugykla' );
	
	include $dir_bendra . 'model_db.class.php';
	include $dir_bendra . 'model_db_sarasas.class.php';

	include 'class/nuoroda.php';

	require $dir_bendra . '../bendram/controller.class.php';

	include DIR_MAIN . 'class/zymu_saugykla.php';

	$zymu_saugykla = new ZymuSaugykla();
	
	$zymu_saugykla -> tikrintiUzklausuDuomenis();
	
	if ( $zymu_saugykla -> arYraGautaNaujaZyma() ) {
	
		$zymu_saugykla -> sukurtiNaujaZyma();
	}
	
	$zymu_saugykla -> gautiDuomenis();
	
	include DIR_MAIN . 'main.html.php';