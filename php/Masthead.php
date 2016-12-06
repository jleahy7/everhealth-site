<?php
class Masthead
{
	private $page, $_info;

	function __construct($_page, $_info){

		$this->page = $_page;
		$this->info = $_info;
		echo "<a href='index.php'>";
		echo "<div id='masthead'>";
		echo "<img id='mast-logo' src=assets/weightlifting.svg>";
		echo "<p id='mast-p'>Ever Health</p>";
		echo "</div>";
		echo "</a>";
	}
}
?>
