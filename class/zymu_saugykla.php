<?php

	class ZymuSaugykla extends Controller  {
	
		public $ar_sukurti_nauja_nuoroda = false, $ar_pasirinkta_zyma = false, $ar_pasalinti_nuoroda;	
	
		public function __construct() {
		
			$this -> zymos = new Zymos();		
		}
	
		public function tikrintiUzklausuDuomenis() {
		
			$this -> ar_sukurti_nauja_nuoroda = isset ( $_POST [ 'atlikti' ] ) && ( $_POST [ 'atlikti' ] == 'Pridėti žymą' )   && ( $_POST [ 'id_nuorodos' ] == '0' );
			$this -> ar_pasalinti_nuoroda = isset ( $_POST [ 'salinti' ] ) && ( $_POST [ 'salinti' ] == 'salinti' )   && ( intval ( $_POST [ 'id_salinamos_nuorodos' ] ) > 0 );
			$this -> ar_pakeisti_esama_nuoroda = isset ( $_POST [ 'atlikti' ] ) && ( $_POST [ 'atlikti' ] == 'Pakeisti žymą' )   && ( intval ( $_POST [ 'id_nuorodos' ] ) > 0 );
			$this -> ar_vykdoma_paieska = isset ( $_POST [ 'atlikti_paieska' ] ) && ( $_POST [ 'atlikti_paieska' ] == 'ieskoti' );			
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
		
		public function arSalinamaZyma() {
			
			return $this -> ar_pasalinti_nuoroda;
		}
		
		public function salintiZyma() {
		
			$salinama_nuoroda = new Nuoroda ( '', '', '', $_POST [ 'id_salinamos_nuorodos' ] );
			$salinama_nuoroda -> pasiimtiDuomenis() ;
			
			$this -> zymos = new Zymos();	
			$this -> zymos -> mazintiZymuKartojimosiKieki ( $salinama_nuoroda -> zymos );			
			
			$salinama_nuoroda -> pasalinti();		
		}		
		
		public function arPakeistiEsamaNuoroda()  {

			return $this -> ar_pakeisti_esama_nuoroda;
		}		
		
		public function pakeistiEsamaNuoroda() {
		
			$sena_nuoroda = new Nuoroda ( '', '', '', $_POST [ 'id_nuorodos' ] );
			$sena_nuoroda -> pasiimtiDuomenis() ;
			
			$nuoroda =  new Nuoroda ( $_POST [ 'bookmark-url' ], $_POST [ 'bookmark-name' ],  $_POST [ 'bookmark-tags' ], $_POST [ 'id_nuorodos' ] );
			$nuoroda -> pakeistiDuomenis();
			
			$this -> zymos -> mazintiZymuKartojimosiKieki ( $sena_nuoroda -> zymos );
			$this -> zymos -> atnaujintiZymas( $_POST [ 'bookmark-tags' ] );			
		}			

		public function gautiDuomenis() {
		
			$this -> nuorodos = new Nuorodos();
			
			if ( $this -> ar_pasirinkta_zyma ) {
				
				// echo $_GET [ 'tag' ]; exit;
				$this -> nuorodos -> paieskosParametrai ( '', '', '', $_GET [ 'tag' ] );
			}
			
			if ( $this -> ar_vykdoma_paieska ) {
			
				$this -> nuorodos -> paieskosParametrai ( $_POST [ 'search-query' ], $_POST [ 'bookmark-url' ], $_POST [ 'bookmark-name' ],  $_POST [ 'bookmark-tags' ] );
			}

			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
			$this -> zymos -> gautiSarasaIsDuomenuBazes();			
		}		
	}