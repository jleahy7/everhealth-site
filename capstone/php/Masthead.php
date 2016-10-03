<?php
class Masthead
{
	private $page;

	function __construct($__page){

		$this->page = $__page;
		
		echo "<div id='masthead'>";
		echo "<img id='mast-logo' src=assets/weightlifting.svg>";
		echo "<p id='mast-p'>Ever Health</p>";
		echo "</div>";
	}
}
?>
