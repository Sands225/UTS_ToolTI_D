<?php
// Include database connection
require './functions.php';

$id_book = $_GET['id_book'];

$result = readBookById($id_book);

$book_data = mysqli_fetch_assoc($result);

// Check if the form was submitted
if (isset($_POST["submit"])) {
	
	if ( updateBook($_POST, $id_book) > 0 ) {
		echo "
			<script>
				alert('data have been successfully changed');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "<script>
				alert('data failed to change');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Add Book</title>
		<link rel="stylesheet" href="style/book-actions.css" />
	</head>
	<body>
		<nav class="header">
			<div class="left-nav">
				<h1>SanReviews</h1>
			</div>
			<div class="right-nav">
				<a href="index.php">Back</a>
			</div>
		</nav>

		<div class="container">
			<h2>Update Book</h2>
			<form
				action=""
				method="post"
				enctype="multipart/form-data">
                <input type="hidden" name="oldCover" id="oldCover" value="<?php echo $book_data['cover'] ?>">
				<div>
					<label for="title">Book Title</label>
					<input
						type="text"
						id="title"
						name="title"
						placeholder="Enter book title"
                        value="<?php echo $book_data['title']?>"
						required />
				</div>
				<div>
					<label for="author">Author</label>
					<input
						type="text"
						id="author"
						name="author"
						placeholder="Enter author name"
                        value="<?php echo $book_data['author']?>"
						required />
				</div>
				<div>
					<label for="rating">Rating (out of 5)</label>
					<input
						type="number"
						id="rating"
						name="rating"
						placeholder="Enter rating"
						step="0.1"
						min="0"
						max="5"
                        value="<?php echo $book_data['rating']?>"
						required />
				</div>
				<div>
					<label for="description">Description</label>
					<textarea
						id="description"
						name="description"
						rows="5"
						placeholder="Enter book description"
						required><?php echo $book_data['description']?></textarea>
				</div>
				<div>
                    <img src="./src/upload/<?php echo $book_data['cover']?>" alt="" width="150px">
                    <br>
					<label for="cover">Book Cover Image</label>
					<input
						type="file"
						id="cover"
						name="cover"/>
				</div>
				<button type="submit" name="submit">Update Book</button>
			</form>
		</div>
	</body>
</html>
