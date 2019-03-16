<!doctype html>
<html lang="ru">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="app/views/template/css/bootstrap.min.css">
		
		<title>Task manager</title>
	</head>
	<body>
		
<?php include (ROOT . 'views/template/navbar.php'); ?>
		
<!-- just for beauty -->
<?php include (ROOT . 'views/template/top_banner.php'); ?>
		
		<main role="main" class="container">
			
<?php include (ROOT . 'views/template/info_messages.php'); ?>
<?php include (ROOT . 'views/template/errors_messages.php'); ?>

<?php if (!empty($list)): ?>
			
			<h6 class="border-bottom border-gray pb-2 mb-0">
				Sort by:
				
<?php include (ROOT . 'views/template/sorting.php'); ?>
			
			</h6>
			<div class="my-3 p-3 bg-white rounded box-shadow">
				
<?php foreach ($list as $task): ?>
				
				<div class="media text-muted pt-3">
					<img class="mr-2 rounded" style="width: 32px; height: 32px;" src="./app/uploads/<?= $task['done'] ?>.png">
					
					<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
						<strong class="d-block text-gray-dark"><?= $task['name'] ?></strong>
						<strong class="d-block text-gray-dark"><?= $task['email'] ?></strong>
						<?= $task['text'] ?></p>
						
<?php if ($isAdmin): ?>
					
					<a href="/taskManager/edit/<?= $task['id'] ?>">
						<img style="width: 20px; height: 20px;" src="./app/uploads/edit.png">
					</a>
					
<?php endif; ?>
				
				</div>
				
<?php endforeach; ?>
				
			</div>
			
<?php endif; ?>
			
			<!-- Pagination -->
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					
<? for ($i = 1; $i <= $pagesCount; $i++): ?>
					
					<li class="page-item<?= $i == $pageNum ? " active" : "" ?>">
						<a class="page-link" href="/taskManager/<?= $i; ?>">
							<?= $i; ?>
						</a>
					</li>
					
<? endfor; ?>	
					
				</ul>
			</nav>
		</main>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="app/views/template/js/jquery-3.3.1.slim.min.js"></script>
		<script src="app/views/template/js/popper.min.js"></script>
		<script src="app/views/template/js/bootstrap.min.js"></script>
	</body>
</html>