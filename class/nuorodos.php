<?php

	class Nuorodos extends  ModelDbSarasas  {
	
		public $paieskos_kriterijai = '1';
	
		public function __construct() {
		
			parent::__construct();
		}
		
		public function detaliosPaieskosParametrai ( $zymos ) {
		
			$salygu_sujungimas = 'AND';
			
			if ( $zymos == 'be žymų' ) { 
		
				$this -> paieskos_kriterijai .= 
						"
					" . $salygu_sujungimas . "
						`zymos`='' 
						";
						
			} elseif ( $zymos != '' ) {
			
				$this -> paieskos_kriterijai .= 
						"
					" . $salygu_sujungimas . "
						`zymos` LIKE '%" . $zymos . "%' 
						";
			}		
		}

		public function gautiSarasaIsDuomenuBazes() {
		
			$gw_gauti_sarasa =
					"
				SELECT 
					`id`, `url`, `pav`, `data`
				FROM 
					`nuorodos`
				WHERE
					" . $this -> paieskos_kriterijai . "
					";
			
			// print_r( $_POST );
			// echo $this -> paieskos_kriterijai . ' --- ';
			// echo $gw_gauti_sarasa;
		
			$rs_list = $this -> db -> uzklausa ( $gw_gauti_sarasa );
			
			while ( $row = $rs_list -> fetch_assoc() ) {
					
				$this -> sarasas[] = $row;
			}
		}
	}