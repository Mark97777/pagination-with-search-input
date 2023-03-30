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
		if($i >= 4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}

?>