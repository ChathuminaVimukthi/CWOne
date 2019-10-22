<!DOCTYPE html>
<html>
<body>
<?php

echo "<h2>Terminator movies released in $searchyr</h2>";

if (count($moviesFound) > 0) {
	foreach ($moviesFound as $value){
		echo "<div>";
		echo $value->getTitle();
		echo "</div>";
	}
	echo "<br><a href='../views/movie.php'>Go back</a>";
}else{
	echo "No movie found";
	echo "<br><a href='../views/movie.php'>Go back</a>";
}
?>
</body>
</html>
