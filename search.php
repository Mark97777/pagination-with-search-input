<?php

	include("conn.php");
	
	$query=mysqli_query($conn,"select count(userid) from `user`");	// target ids
	$row = mysqli_fetch_row($query);

	$rows = $row[0];	//set to first row
	
	$page_rows = 10;	//set limit

	$last = ceil($rows/$page_rows);	// divides first row over page limit... results is rounded via ceil function

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	//$nquery=mysqli_query($conn,"SELECT * FROM `user` $limit");	// Bingo... the code to tweak for search functionality

	// Condition statement to tell when there is a search input made or not
	// Condition statement to tell when there is a search input made or not
	// Condition statement to tell when there is a search input made or not
	$valid = 1;
	
	if (isset($_POST['formSearch'])) {
		$valid = 0;
		$search_key = $_POST['searchKey'];
		$nquery=mysqli_query($conn,"SELECT * FROM `user` WHERE firstname LIKE '%$search_key%' $limit");	// Bingo... the code to tweak for search functionality
	}
	
	
	if ($valid) {	// Default display result
		$nquery=mysqli_query($conn,"SELECT * FROM `user` $limit");	// Bingo... the code to tweak for search functionality
	}
	// Condition statement to tell when there is a search or not
	// Condition statement to tell when there is a search or not
	// Condition statement to tell when there is a search or not
	
	
	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        //$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		//$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pagination | Cyberkodes</title>
	<link rel="stylesheet" href="css/Bootstrap-v4.1.0.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/Bootstrap-v4.1.0.min.js"></script>
	<style>
		.search-field {
			display: flex;
			height: 2.4rem;
			justify-content: flex-end;
		}
	</style>
</head>
<body>
<div class="container">
	
	<h1 class = "page-header text-center">Upgraded Pagination with search functionality | CyberKodes</h1>
	
	<section>
		<form action = "search.php" method = "POST">
			<div class = "search-field">
				<div class = "form-group">
					<input height = "100%" type = "search" required class = "form-control" name = "searchKey" value = "<?php if (isset($_POST['searchKey'])){echo $_POST['searchKey'];};?>"/>
				</div>
				<button style = "cursor: pointer;border: none;" type = "submit" name = "formSearch" class = ""><span class = "fa fa-search"></span></button>
			</div>
		</form>
	</section>
	
	<section class = "">
		<div style= "" class = "row justify-content-center">
			<?php while($crow = mysqli_fetch_array($nquery)){ ?>
				<div style = "background-color: gainsboro;margin: 0.5em;padding: 0.4em;" class = "col-sm-5">
					<img width = "100%" height = "100%" src = "pictures/therapy_img_11.jpg" />
				</div>
				<div style = "background-color: gainsboro;margin: 0.5em;padding: 0.4em;" class = "col-sm-5">
					<?php echo $crow['firstname']; ?>
					<?php echo "<br />"; ?>
					<?php echo $crow['userid']; ?>
					<?php echo "<br />"; ?>
					<?php echo $crow['lastname']; ?>
				</div>
			<?php }; ?>
		</div>
	</section>
	
	<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>

	
</div>
</body>
</html>