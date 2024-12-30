<?php
    include './db.php';

    function readAllDataBooks() {
        global $mysqli;

        $result = mysqli_query($mysqli, "SELECT * FROM books");
        return $result;
    }

    function readDataBookById($id_book) {
        global $mysqli;

        $result = mysqli_query($mysqli, "SELECT * FROM books WHERE id_book = $id_book");
        return $result;
    }

    function addBook($book_data) {
        global $mysqli;

        $title = htmlspecialchars($book_data["title"]);
        $author = htmlspecialchars($book_data["author"]);
        $rating = floatval($book_data["rating"]);
        $description = htmlspecialchars($book_data["description"]);
        
        $cover = uploadCover();
        
        $query = "INSERT INTO books (title, author, cover, rating, description)
                VALUES ('$title', '$author', '$cover', '$rating', '$description')";
        
        mysqli_query($mysqli, $query);
        return mysqli_affected_rows($mysqli);
    }

    function updateBook($book_data, $id_book) {
        global $mysqli;

        $title = htmlspecialchars($book_data["title"]);
        $author = htmlspecialchars($book_data["author"]);
        $rating = floatval($book_data["rating"]);
        $description = htmlspecialchars($book_data["description"]);

        $oldCover = htmlspecialchars($book_data["oldCover"]);
        // check if user add new cover
        if ( $_FILES['cover']['error'] === 4) {
            $cover = $oldCover;
        } else {
            $cover = uploadCover();
        }

        $query = "UPDATE books
                SET title = '$title',
                author = '$author',
                cover = '$cover',
                rating = '$rating',
                description = '$description'
                WHERE id_book = '$id_book'";

        mysqli_query($mysqli, $query);
        return mysqli_affected_rows($mysqli);
    }

    function uploadCover() {
        $coverName = $_FILES['cover']['name'];
        $coverSize = $_FILES['cover']['size'];
        $err = $_FILES['cover']['error'];
        $tmpName = $_FILES['cover']['tmp_name'];

        // if there's no file uploaded
        if ($err === 4) {
            echo "<script>
				alert('image failed');
				document.location.href = 'index.php';
			</script>";
            return false;
        }

        // check for extentions file
        $coverExtentionsValid = ['jpg', 'png', 'jpeg'];
        $coverExtentions = explode('.', $coverName);
        $coverExtentions = strtolower(end($coverExtentions));

        if( !in_array($coverExtentions, $coverExtentionsValid) ) {
            echo "<script>
				alert('extentions file not valid');
				document.location.href = 'index.php';
			</script>";
            return false;
        }

        // check for cover size
        if ($coverSize > 1000000) {
            echo "<script>
				alert('image size too big');
				document.location.href = 'index.php';
			</script>";
            return false;
        }

        $targetDir = 'src/upload/';
        move_uploaded_file($tmpName, $targetDir . basename($coverName));

        return $coverName;
    }

    function deleteBook($id_book) {
        global $mysqli;

        $query = "DELETE FROM books
                WHERE id_book = $id_book";

        mysqli_query($mysqli, $query);
        return mysqli_affected_rows($mysqli);
    } 
?>