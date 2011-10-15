<?php

include "framework/includes.php"; //include all listed classes. If you make custom classes, please ensure that they are already listed in the file.

$dbAccess = new DBAccess(); //core model layer
$janitor = new Janitor($dbAccess); //core controller layer

//Never forget to sanitize all input! Use the Janitor class for every input accordingly! (that's one of the purpose of MVC architecture)
$id = ($janitor->validateID($_GET['id'])) ? $_GET['id'] : NULL; //..................................... sanitize $_GET['id']
$folder = ($janitor->validateFolder($_GET['folder'])) ? $_GET['folder'] : NULL; //..................... sanitize $_GET['folder']
$archive = ($janitor->validateArchive($_GET['archive'])) ? $_GET['archive'] : NULL; //................. sanitize $_GET['archive']
$page = ($janitor->validatePage($_GET['page'], $id, $folder, $archive)) ? $_GET['page'] : NULL; //..... sanitize $_GET['page']
$tab = ($janitor->validateTab($_GET['tab'])) ? $_GET['tab'] : NULL; //................................. sanitize $_GET['tab']
//I use conditional operator to shorten the sanitization code above. To learn about conditional operator, just google "conditional operator php".

$head = new Head($dbAccess); //head view
$book = new Book($dbAccess, $id, $folder, $archive); //book view
$sidebar = new Sidebar($dbAccess); //sidebar view

//getting view results
$headResult = $head->printHead();
$bookResult = $book->printBook(NULL, $page, ($id!=NULL)?true:false, $id, $tab); //contain the book span HTML in a string
$sidebarResult = $sidebar->printSidebar(); //contain the sidebar span HTML in a string

?>

<html>
<head>
<script type="text/JavaScript" src="framework/javascript/jquery-1.5.2.js"></script>
<?php
echo"<script type='text/JavaScript'>
function loadBook() {
	$('#book').load('index/book.php?id=$id&page=$page&archive=$archive&folder=$folder&tab=$tab');
}";
?>
</script>
<link rel="stylesheet" type="text/css" href="framework/stylesheet/default.css" />
</head>
<body>  
	<table id='site'>
		<tr>
			<td colspan=2 id='head'><?php echo $headResult; ?></td>
		</tr>
		<tr>
			<td id='book'><? echo $bookResult; ?></td>
			<td id='sidebar'><? echo $sidebarResult; ?></td>
		</tr>
	</table>
	<script type="text/JavaScript">
		loadBook();
	</script> <? //For timezone detection (not yet implemented) ?>
</body>
</html>
