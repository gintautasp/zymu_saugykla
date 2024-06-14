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
}
    </style>
</head>
<body>

    <div class="container">
        <h1>Mano Žymos</h1>
        <form id="bookmark-form">
	<input type="text" id="search-query" placeholder="Įveskite paieškos frazę" required>
            <input type="text" id="bookmark-name"  placeholder="Puslapio pavadinimas" required>
	     <input type="text" id="bookmark-url" placeholder="Puslapio URL" >
            <select id="bookmark-category">
            </select>
        </form>
        <div class="button-group">
              <button class="button" type="button" onclick="searchWebsites()">Ieškoti</button>
	    <input type="submit" value="Pridėti žymą" class="button" onclick="addBookmark()">
            <button class="button" onclick="addCategory()">Pridėti kategoriją</button>
        </div>
        <ul id="bookmarks-list" class="bookmark-list"></ul>
	<ul id="categories-list" class="categories-list"></ul>
    </div>

    <script>
    
        document.getElementById('bookmark-form').addEventListener('submit', addBookmark);
	

  function addBookmark() {
    const name = document.getElementById('bookmark-name').value;
    let url = document.getElementById('bookmark-url').value;
    let category = document.getElementById('bookmark-category').value;

    if (!url.startsWith('http://') && !url.startsWith('https://')) {
        url = 'http://' + url;
    }

    if (!category) {
        category = "Bendra kategorija";
    }

    const bookmark = {
        name: name,
        url: url,
        category: category
    };

    let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
    bookmarks.push(bookmark);
    localStorage.setItem('bookmarks', JSON.stringify(bookmarks));

    document.getElementById('bookmark-form').reset();
    fetchBookmarks();
}



        function fetchBookmarks() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
            const bookmarksList = document.getElementById('bookmarks-list');
            bookmarksList.innerHTML = '';

            bookmarks.forEach((bookmark, index) => {
                const li = document.createElement('li');
                li.className = 'bookmark-item';

                const link = document.createElement('a');
                link.href = bookmark.url;
                link.target = '_blank';
                link.textContent = `${bookmark.name} (${bookmark.category})`;

                const delButton = document.createElement('button');
                delButton.textContent = 'Šalinti';
                delButton.onclick = () => deleteBookmark(index);

                li.appendChild(link);
		                li.appendChild(delButton);  
                bookmarksList.appendChild(li);
            });
        }

        function deleteBookmark(index) {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
            bookmarks.splice(index, 1);
            localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            fetchBookmarks();
        }

        function searchWebsites() {
    const query = document.getElementById('search-query').value;
    if (query.startsWith('http://') || query.startsWith('https://')) {
        window.open(query, "_blank"); 
    } else {
        window.location.href = `https://www.google.com/search?q=${encodeURIComponent(query)}`;
    }
}
  function addCategory() {
    const newCategory = prompt("Įveskite naujos kategorijos pavadinimą:");
    if (newCategory) {
        const categories = JSON.parse(localStorage.getItem('categories')) || [];
        categories.push(newCategory);
        localStorage.setItem('categories', JSON.stringify(categories));
        updateCategoryDropdown();
        fetchCategories(); 
    }
}

        function deleteCategory(categoryName) {
            const categories = JSON.parse(localStorage.getItem('categories')) || [];
            const updatedCategories = categories.filter(category => category !== categoryName);
            localStorage.setItem('categories', JSON.stringify(updatedCategories));
            updateCategoryDropdown();
            fetchBookmarks();
            fetchCategories();
        }

        function updateCategoryDropdown() {
            const categories = JSON.parse(localStorage.getItem('categories')) || [];
            const categoryDropdown = document.getElementById('bookmark-category');
            categoryDropdown.innerHTML = '';
	    const defaultOption = document.createElement('option');
    defaultOption.value = "Bendra kategorija";
    defaultOption.textContent = "Bendra kategorija";
    categoryDropdown.appendChild(defaultOption);
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                categoryDropdown.appendChild(option);
            });
        }

        function fetchCategories() {
            const categories = JSON.parse(localStorage.getItem('categories')) || [];
            const categoriesList = document.getElementById('categories-list');
            categoriesList.innerHTML = '';

            categories.forEach(category => {
                const li = document.createElement('li');
                li.textContent = category;
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Ištrinti';
                deleteButton.setAttribute('data-category', category);
                deleteButton.onclick = () => deleteCategory(category);
                li.appendChild(deleteButton);
                categoriesList.appendChild(li);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCategoryDropdown();
            fetchBookmarks();
            fetchCategories();
        });
    </script>
</body>
</html>

