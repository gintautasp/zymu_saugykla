<?php

	class ZymuSaugykla extends Controller  {
	
		public $ar_sukurti_nauja_nuoroda = false;	
	
		public function __construct() {
		
		}
	
		public function tikrintiUzklausuDuomenis() {
		
			$this -> ar_sukurti_nauja_nuoroda = isset ( $_POST [ 'prideti' ] ) && ( $_POST [ 'prideti' ] == 'Pridėti žymą' )   && ( $_POST [ 'id_nuorodos' ] == '0' );		
		}
	
		public function arYraGautaNaujaZyma() {
		
			return $this -> ar_sukurti_nauja_nuoroda;
		}
		
		public function sukurtiNaujaZyma() {
		
			$nuoroda =  new Nuoroda ( $_POST [ 'bookmark-url' ], $_POST [ 'bookmark-name' ] );
			$nuoroda -> issaugotiNauja();		
		}

		public function gautiDuomenis() {
		
		}		
	}