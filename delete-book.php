<?php
require './functions.php';

$id_book = $_GET["id_book"];

if (deleteBook($id_book) > 0) {
    echo "
			<script>
				alert('data have been successfully deleted');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "<script>
				alert('data failed to delete');
				document.location.href = 'index.php';
			</script>
		";
	}

?>