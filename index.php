<?php include('pagination.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	
	<h1 class = "page-header text-center">Upgraded Pagination with search functionality | CyberKodes</h1>
	
	<section>
		<form action = "search.php" method = "POST">
			<div class = "form-group col-md-4">
				<input type = "search" required class = "form-control" name = "searchKey" value = "<?php if (isset($_POST['searchKey'])){echo $_POST['searchKey'];};?>"/>
			</div>
			<input type = "submit" value = "search" name = "formSearch" class = "" />
		</form>
	</section>
	
	<section class = "row">
		<div class = "col-md-12">
			<?php while($crow = mysqli_fetch_array($nquery)){ ?>
				<div style = "background-color: gainsboro;margin: 0.3em;padding: 0.4em;" class = "col-md-2">
					<?php echo $crow['userid']; ?>
				</div>
				<div style = "background-color: gainsboro;margin: 0.3em;padding: 0.4em;" class = "col-md-4">
					<?php echo $crow['firstname']; ?>
				</div>
				<div style = "background-color: gainsboro;margin: 0.3em;padding: 0.4em;" class = "col-md-4">
					<?php echo $crow['lastname']; ?>
				</div>
			<?php }; ?>
		</div>
	</section>
	
	<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>

	
</div>
</body>
</html>