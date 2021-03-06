<?php
//pointer to the license file
include "../license.php";

class Head {
	private $title;

	public function Head(DBAccess $dbAccess) {
		$this->title = new Title($dbAccess);
	}

	public function printHead() {
		$return = "<div class='head'>";
		$return .= "<div class='title'><a href='".$_SERVER['PHP_SELF']."'>".$this->title->getTitle()."</a></div>";
		$return .= "<div class='tagline'>".$this->title->getTagline()."</div>";
		$return .= "</div>";
		return $return;
	}
	
	public function getTitle() {
		return $this->title->getTitle();
	}
}

?>
