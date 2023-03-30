<?php include('pagination.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pagination | Cyberkodes</title>
	<style>
		
	</style>
	<link rel="stylesheet" href="css/Bootstrap-v4.1.0.min.css" />
	<script src="js/Bootstrap-v4.1.0.min.js"></script>
</head>
<body>
<div class="container">
	
	<h1 class = "page-header text-center">Upgraded Pagination with search functionality | CyberKodes</h1>
	
	<section class = "container">
		<form action = "search.php" method = "POST">
			<div class = "form-group col-md-4">
				<input type = "search" required class = "form-control" name = "searchKey" value = "<?php if (isset($_POST['searchKey'])){echo $_POST['searchKey'];};?>"/>
			</div>
			<input type = "submit" value = "search" name = "formSearch" class = "" />
		</form>
	</section>
	
	<section class = "">
		<div class = "row">
			<?php while($crow = mysqli_fetch_array($nquery)){ ?>
				<div style = "background-color: gainsboro;margin: 0.3em;padding: 0.4em;" class = "col-md-5">
					<img width = "100%" height = "100%" src = "pictures/therapy_img_11.jpg" />
				</div>
				<div style = "background-color: gainsboro;margin: 0.3em;padding: 0.4em;" class = "col-md-5">
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