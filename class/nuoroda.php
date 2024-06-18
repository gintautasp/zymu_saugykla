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
	}