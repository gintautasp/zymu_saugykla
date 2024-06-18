<?php

	class Nuorodos extends  ModelDbSarasas  {
	
		public function __construct() {
		
			parent::__construct();
		}

		public function gautiSarasaIsDuomenuBazes() {
		
			$gw_gauti_sarasa =
					"
				SELECT 
					`id`, `url`, `pav`
				FROM 
					`nuorodos`
				WHERE
					1
					";
			/*
			print_r( $_POST );
			echo $gw_gauti_sarasa;
			*/
			$rs_list = $this -> db -> uzklausa ( $gw_gauti_sarasa );
			
			while ( $row = $rs_list -> fetch_assoc() ) {
					
				$this -> sarasas[] = $row;
			}
		}
	}