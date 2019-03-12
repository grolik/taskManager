<!doctype html>
<html lang="ru">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
		<title>Task manager</title>
	</head>
	<body>
		
<?php include (ROOT . 'views/template/navbar.php'); ?>
		
<!-- just for beauty -->
<?php include (ROOT . 'views/template/top_banner.php'); ?>
		
		<main role="main" class="container">
			
<?php include (ROOT . 'views/template/info_messages.php'); ?>
<?php include (ROOT . 'views/template/errors_messages.php'); ?>

<?php if (!empty ($page['tasks'][0])): ?>
			
			<h6 class="border-bottom border-gray pb-2 mb-0">
				Sort by:
				
<?php include (ROOT . 'views/template/sorting.php'); ?>
			
			</h6>
			<div class="my-3 p-3 bg-white rounded box-shadow">
				
<?php foreach ($page['tasks'] as $task): ?>
				
				<div class="media text-muted pt-3">
					<img class="mr-2 rounded" style="width: 32px; height: 32px;" src="./app/uploads/<?= $task['done'] ?>.png">
					
					<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
						<strong class="d-block text-gray-dark"><?= $task['name'] ?></strong>
						<strong class="d-block text-gray-dark"><?= $task['email'] ?></strong>
						<?= $task['text'] ?></p>
						
<?php if ($page['isAdmin']): ?>
					
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
					
<? for ($i = 1; $i <= $page['pagesCount']; $i++): ?>
					
					<li class="page-item<?= $i == $page['pageNum'] ? " active" : "" ?>">
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
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>