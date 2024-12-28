<?php
// Include database connection
require './functions.php';

// Check if the form was submitted
if (isset($_POST["submit"])) {
	
	if ( addBook($_POST) > 0 ) {
		echo "
			<script>
				alert('data have been successfully added');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "<script>
				alert('data failed to added');
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
				<a href="/index.php">Back</a>
			</div>
		</nav>

		<div class="container">
			<h2>Add a New Book</h2>
			<form
				action=""
				method="post"
				enctype="multipart/form-data">
				<div>
					<label for="title">Book Title</label>
					<input
						type="text"
						id="title"
						name="title"
						placeholder="Enter book title"
						required />
				</div>
				<div>
					<label for="author">Author</label>
					<input
						type="text"
						id="author"
						name="author"
						placeholder="Enter author name"
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
						required />
				</div>
				<div>
					<label for="description">Description</label>
					<textarea
						id="description"
						name="description"
						rows="5"
						placeholder="Enter book description"
						required></textarea>
				</div>
				<div>
					<label for="cover">Book Cover Image</label>
					<input
						type="file"
						id="cover"
						name="cover"
						accept="image/*"
						required />
				</div>
				<button type="submit" name="submit">Add Book</button>
			</form>
		</div>
	</body>
</html>
