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
          input[type="text"], select {
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
    </style>
</head>
<body>
	<div class="container">
	<h1>Mano Žymos</h1>
	<form id="bookmark-form" method="POST" action="">
		<input type="text" id="search-query" placeholder="Įveskite paieškos frazę">
		<input type="text" id="bookmark-name"  name="bookmark-name"  placeholder="Puslapio pavadinimas" required>
		<input type="text" id="bookmark-url"  name="bookmark-url" placeholder="Puslapio URL" >
		<input type="hidden" id="id_nuorodos"  name="id_nuorodos" value="0">		
		<select id="bookmark-category">
		</select>
		<div class="button-group">
			<button class="button" type="button" onclick="searchWebsites()">Ieškoti</button>
			<input type="submit" name="prideti" value="Pridėti žymą" class="button" onclick="addBookmark()">
			<button class="button" onclick="addCategory()">Pridėti kategoriją</button>
		</div>
	</form>
	<ul id="bookmarks-list" class="bookmark-list"></ul>
	<ul id="categories-list" class="categories-list"></ul>
	</div>
</body>
</html>

