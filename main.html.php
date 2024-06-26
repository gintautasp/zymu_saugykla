<!DOCTYPE html>
<html lang="lt">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mano Žymos</title>
	<style>
          body {
		font-family: Arial, sans-serif;
		background-color: #f4f4f4;
		margin: 0;
		padding: 0;
         }
	 #side_left {
		width: calc(( 100% - 900px ) / 2); 
		margin-left: 20px;
		/* border: 1px solid black; */
		float: left;
	 }
	 #side_right {
		width: calc(( 100% - 900px ) / 2); 
		margin-right: 20px;
		text-align: right;
		/* border: 1px solid black; */	
		float: right;
	 }	 
          .container {
		max-width: 800px;
		margin: 50px auto;
		background: white;
		padding: 20px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}
	h1 {
		text-align: center;
          }
          form {
		margin-bottom: 20px;
         }
          input[type="text"], input[type="url"], select {
		width: calc(100% - 22px);
		padding: 10px;
		margin-bottom: 10px;
          }
	input[type="submit"], button {
		font-size: 16px;
		width: calc(33.33% - 8px);
		padding: 10px;
		background-color: #4CAF50;
		color: white;
		border: 2px solid #000;
		cursor: pointer;
		transition: background-color 0.3s;
		border-radius: 20px;
		margin-left: 10px; 
		margin-bottom: 10px;
          }
	input[type="submit"]:hover, button:hover {
                  background-color: #45a049;
	        border: 2px solid #000;
         }
          .bookmark-list {
		list-style: none;
		padding: 0;
         }
        .bookmark-item {
		display: flex;
		justify-content: space-between;
		background: #fff;
		padding: 10px;
		margin-bottom: 10px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}
          .bookmark-item button {
		background: red;
		color: white;
		cursor: pointer;
          }
          .bookmark-item button:hover {
		background: darkred;
         }
	.button-group {
		display: flex;
		justify-content: space-between;
		margin-bottom: 20px;
	}
	.button-group button {
		border: 2px solid black;
		border-radius: 20px;
		margin-right: 10px; 
		color: white;
        }
        .button-group button:last-child {
		margin-left: 20;
		margin-top: 20;
		margin-right: 0;
        }
	.button {
		padding: 10px 20px;
		border: 2px solid #000;
		color: #4CAF50;
		font-size: 16px;
		cursor: pointer;
		transition: background-color 0.3s, color 0.3s;
		background-image: linear-gradient(to right, #4CAF50, #45a049, #008CBA, #f44336); 
		background-size: 5000% 5000%; 
		border-radius: 20px;
		animation: changeColor 2s infinite alternate;
	}
	@keyframes changeColor {
		0% {
			background-position: 0% 0%; 
		}
		100% {
			background-position: 100% 100%; 
		}
	}

	.button:hover {
		background-position: right bottom;
		color: white;
	}
	.data {
		color: grey;
		font-size: 10px;
	}
	.iraso_mygtukai {
		width: auto;
		margin: 1px 2px;
		border-radius: 20px;		
	}
    </style>
    <script>
		function salinti( id ) {
		
			 if ( confirm( "Ar tikrai norite pašalinti šį įrašą" ) == true ) {
			 
				id_salinamos_nuorodos = document.getElementById ( 'id_salinamos_nuorodos' );
				id_salinamos_nuorodos.value = id;
				salinimo_forma = document.getElementById ( 'salinimo-forma' );
				salinimo_forma.submit();
			} 
		}
    </script>
</head>
<body>
	<aside id="side_left">
		<a class="zyma" href="/zymu-saugykla/">visos</a>
<?php	
		
		for ( $i = 0; $i < count ( $zymu_saugykla -> zymos -> sarasas ); $i +=2 ) {
?>			
			<a class="zyma" href="?tag=<?= $zymu_saugykla -> zymos -> sarasas [ $i ] [ 'zyma' ]?>"><?= $zymu_saugykla -> zymos -> sarasas [ $i ] [ 'zyma' ]?></a>
<?php
		}
?>
	</aside>
	<aside id="side_right">
		<a class="zyma" href="/zymu-saugykla/?tag=be žymų">be žymų</a>	
<?php	
		
		for ( $i = 1; $i < count ( $zymu_saugykla -> zymos -> sarasas ); $i +=2 ) {
?>			
			<a class="zyma" href="?tag=<?= $zymu_saugykla -> zymos -> sarasas [ $i ] [ 'zyma' ]?>"><?= $zymu_saugykla -> zymos -> sarasas [ $i ] [ 'zyma' ]?></a>
<?php
		}
?>
	</aside>	
	<div class="container">
	<h1>Mano Žymos</h1>
	<form id="bookmark-form" method="POST" action="">
		<input type="text" id="search-query" placeholder="Įveskite paieškos frazę">
		<input type="text" id="bookmark-name"  name="bookmark-name"  placeholder="Puslapio pavadinimas" required>
		<input type="url" id="bookmark-url"  name="bookmark-url" placeholder="Puslapio URL" >
		<input type="text" id="zymu_zymos" name="bookmark-tags" placeholder="Žymos atskirtos kableliais">
		<input type="hidden" id="id_nuorodos"  name="id_nuorodos" value="0">
		<div class="button-group">
			<button class="button" type="button" onclick="searchWebsites()">Ieškoti</button>
			<input type="submit" name="prideti" value="Pridėti žymą" class="button" onclick="addBookmark()">
			<button class="button" onclick="addCategory()">Pridėti kategoriją</button>
		</div>
	</form>
	<form id="salinimo-forma" method="POST" action="">
		<input type="hidden" name="salinti" value="salinti">
		<input type="hidden" id="id_salinamos_nuorodos"  name="id_salinamos_nuorodos"value="0">
	</form>
	<ul id="bookmarks-list" class="bookmark-list">
<?php
		foreach ( $zymu_saugykla -> nuorodos -> sarasas as $nuoroda ) {
?>
		<li class="bookmark-item">
			<a href="<?= $nuoroda [ 'url' ] ?>" target="_blank"><?= $nuoroda [ 'pav' ]  ?></a><br>
			<span class="data"><?= $nuoroda [ 'data' ] ?></span>
			<button class="iraso_mygtukai">&#9998;</button>
			<button class="iraso_mygtukai" onClick="salinti(<?= $nuoroda [ 'id' ] ?>)">&#10006;</button>			
		</li>
<?php
		}
?>
	</ul>
	<ul id="categories-list" class="categories-list"></ul>
	</div>
</body>
</html>

