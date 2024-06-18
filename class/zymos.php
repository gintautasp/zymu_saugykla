<?php

	class Zymos extends  ModelDbSarasas  {
	
		public function __construct() {
		
			parent::__construct();
		}
		
		public function gautiZymuSarasa ( $zymos ) {
		
			$lst_zymos = explode ( ',', $zymos );
			
			$i = 0;
			foreach ( $lst_zymos as $zyma ) {
			
				$lst_zymos [ $i ] = trim ( $zyma );
				$i++;
			}
			return $lst_zymos;
		}
		
		public function atnaujintiZymas ( $zymos ) {
		
			$lst_zymos = $this -> gautiZymuSarasa ( $zymos );
			
			if ( ( $lst_zymos ) && ( $lst_zymos [ 0 ] != '' ) ) {
			
				$qw_iterpti_zymas =
						"
					INSERT INTO `zymos` ( `zyma` )
					VALUES (
						'" . implode ( "' ), ( '", $lst_zymos ) . "'
					)
					ON DUPLICATE KEY UPDATE `kiek_kartojasi`=`kiek_kartojasi`+1
						";
																																			// echo $qw_iterpti_zymas;						
				$this -> db -> uzklausa ( $qw_iterpti_zymas );
			}
		}
		
		public function mazintiZymuKartojimosiKieki ( $zymos ) {
		
			$lst_zymos = $this -> gautiZymuSarasa ( $zymos );
			
				$qw_mazinti_zymu_pasikartojimo_kieki =
						"
					UPDATE `zymos`
					SET `kiek_kartojasi`=`kiek_kartojasi`-1
					WHERE
						`zyma` IN('" . implode ( "', '", $lst_zymos ) . "')
						";
																																			// echo $qw_iterpti_zymas;						
				$this -> db -> uzklausa ( $qw_mazinti_zymu_pasikartojimo_kieki );

		}
		
		public function gautiSarasaIsDuomenuBazes() {

			$gw_gauti_sarasa =
					"
				SELECT 
					*
				FROM 
					`zymos`
				WHERE
					1
				ORDER BY
					`kiek_kartojasi` DESC
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