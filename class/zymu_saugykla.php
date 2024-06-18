<?php

	class ZymuSaugykla extends Controller  {
	
		public $ar_sukurti_nauja_nuoroda = false, $ar_pasirinkta_zyma = false, $ar_pasalinti_nuoroda;	
	
		public function __construct() {
		
			$this -> zymos = new Zymos();		
		}
	
		public function tikrintiUzklausuDuomenis() {
		
			$this -> ar_sukurti_nauja_nuoroda = isset ( $_POST [ 'prideti' ] ) && ( $_POST [ 'prideti' ] == 'Pridėti žymą' )   && ( $_POST [ 'id_nuorodos' ] == '0' );
			$this -> ar_pasalinti_nuoroda = isset ( $_POST [ 'salinti' ] ) && ( $_POST [ 'salinti' ] == 'Šalinti' )   && ( intval ( $_POST [ 'id_salinamos_nuorodos' ] ) > 0 );						
			$this -> ar_pasirinkta_zyma = isset ( $_GET [ 'tag' ] ) && ( $_GET [ 'tag' ] != '' );
		}
	
		public function arYraGautaNaujaZyma() {
		
			return $this -> ar_sukurti_nauja_nuoroda;
		}
		
		public function sukurtiNaujaZyma() {
		
			$nuoroda =  new Nuoroda ( $_POST [ 'bookmark-url' ], $_POST [ 'bookmark-name' ], $_POST [ 'bookmark-tags' ] );
			$nuoroda -> issaugotiNauja();	

			$this -> zymos -> atnaujintiZymas( $_POST [ 'bookmark-tags' ] );
		}

		public function gautiDuomenis() {
		
			$this -> nuorodos = new Nuorodos();
			
			if ( $this -> ar_pasirinkta_zyma ) {
				
				// echo $_GET [ 'tag' ]; exit;
				$this -> nuorodos -> detaliosPaieskosParametrai ( $_GET [ 'tag' ] );
			}			
			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
			$this -> zymos -> gautiSarasaIsDuomenuBazes();			
		}		
	}