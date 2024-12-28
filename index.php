<?php
require './functions.php';

$result = mysqli_query($mysqli, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Book Reviews</title>
		<link rel="stylesheet" href="style/index.css?v=1.2" />
	</head>
	<body>
		<nav>
			<div class="left-nav">
				<h1>SanReviews</h1>
			</div>
			<div class="right-nav">
				<a href="/about.php">About</a>
			</div>
		</nav>
		<div class="header">
			<h1>Books Review</h1>
		</div>
		<div class="add-button">
			<button>
				<a href="./add-book.php">+ add book</a>
			</button>
		</div>
		<div class="list-books">
			<?php while($book_data = mysqli_fetch_assoc($result)): ?>
			<div class="book">
				<div class="book-cover">
					<img 
						src="src/<?php echo $book_data['cover']?>" 
						alt="<?php echo $book_data['cover']?>" 
						width="55%" />
				</div>
				<h1 class="book-title">
					<?php echo $book_data['title']?>
				</h1>
				<h3 class="book-author">
					<?php echo "by" . $book_data['author']?>
				</h3>
				<h4 class="book-review">
					⭐ <?php echo $book_data['rating']?> / 5.0
				</h4>
				<p class="book-description">
					<?php echo $book_data['description']?>
				</p>
				<div class="book-button">
					<button class="update-button">
						<a href="./update-book.php?id_book=<?php echo $book_data['id_book']?>">update</a>
					</button>
					<button class="delete-button">
						<a href="./delete-book.php?id_book=<?php echo $book_data['id_book']?>" onclick="return deleteConfirmation()">delete</a>
					</button>
				</div>
			</div>
			<?php endwhile ?>
		</div>
		<footer>
			<div class="footer-container">
				<div class="footer-section">
					<h3>SanReviews</h3>
					<p>
						Website ini merupakan platform yang menyediakan ulasan komprehensif tentang buku dari berbagai genre, serta dilengkapi dengan fitur untuk membaca, memberikan penilaian, dan berbagi rekomendasi dalam komunitas pembaca.
					</p>
				</div>

				<div class="footer-links">
					<h4>Quick Links</h4>
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About me</a></li>
					</ul>
				</div>

				<div class="footer-social">
					<h4>Follow Us</h4>
					<ul>
						<li><a href="#">Instagram</a></li>
						<li><a href="#">Twitter</a></li>
						<li><a href="#">YouTube</a></li>
					</ul>
				</div>
			</div>

			<div class="footer-bottom">
				<p>&copy; 2024 sanReviews.</p>
			</div>
		</footer>
	<script>
		function deleteConfirmation() {
			var result = confirm("Are you sure you want to delete this book?");
			if (!result) {
				event.preventDefault();
			}
			return result;
		}
	</script>
	</body>
</html>
