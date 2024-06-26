<?php

	class Nuoroda extends ModelDb  {
	
		public $url, $pav, $zymos, $id;
	
		public function __construct( $url, $pav, $zymos, $id = 0 ) {
		
			parent::__construct();
			
			$this -> url = $this -> db -> ercl_db -> real_escape_string ( $url );
			$this -> pav = $this -> db -> ercl_db -> real_escape_string ( $pav );
			$this -> zymos = $this -> db -> ercl_db -> real_escape_string ( $zymos );			
			$this -> id = $id;			
		}
		
		public function issaugotiNauja() {
		
			$qw_issaugoti_nauja =
					"
				INSERT INTO `nuorodos` ( `url`, `pav`, `zymos` )
				VALUES (
					'" . $this -> url . "', '" . $this -> pav . "', '" . $this -> zymos . "'
				)
					";
																																	//	echo $qw_issaugoti_nauja;
			$this -> db -> uzklausa ( $qw_issaugoti_nauja );
		}
		
		public function pasiimtiDuomenis() {

			$qw_gauti_nuoroda =
					"
				SELECT 
					*
				FROM
					`nuorodos`
				WHERE
					`id`= " . $this -> id . "
					";
			$rs_list = $this -> db -> uzklausa ( $qw_gauti_nuoroda );
			
			if ( $row = $rs_list -> fetch_assoc() ) {
			
				$this -> url = $row [ 'url' ];
				$this -> pav = $row [ 'pav' ];
				$this -> zymos = $row [ 'zymos' ];				
			}
		}		

		public function pasalinti() {
		
			$qw_pasalinti =
					"
				DELETE FROM `nuorodos`
				WHERE
					`id`=" . $this -> id . "
					";
																																	//	echo $qw_issaugoti_nauja;
			$this -> db -> uzklausa ( $qw_pasalinti );		
		}
	}