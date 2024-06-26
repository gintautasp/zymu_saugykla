<?php

	class Nuorodos extends  ModelDbSarasas  {
	
		public $paieskos_kriterijai = '1';
	
		public function __construct() {
		
			parent::__construct();
		}
		
		public function paieskosParametrai ( $paieskos_tekstas, $url, $pav, $zymos ) {
		
			$salygu_sujungimas = 'AND';
			
			if ( trim ( $paieskos_tekstas) != '' ) {
			
				$this -> paieskos_kriterijai .= 
						"
					" . $salygu_sujungimas . " (
						`url` LIKE '%" . $paieskos_tekstas . "%' 
					OR
						`pav` LIKE '%" . $paieskos_tekstas . "%' 
					OR
						`zymos` LIKE '%" . $paieskos_tekstas . "%' 
					)
						";
			}
			
			if ( trim ( $url ) != '' ) {
			
				$this -> paieskos_kriterijai .= 
						"
					" . $salygu_sujungimas . "
						`url` LIKE '%" . $url . "%' 
						";
			}
			
			if ( trim ( $pav ) != '' ) {
			
				$this -> paieskos_kriterijai .= 
						"
					" . $salygu_sujungimas . "
						`pav` LIKE '%" . $pav . "%' 
						";
			}			
			
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
			// echo $this -> paieskos_kriterijai; exit;
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