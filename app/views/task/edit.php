<!doctype html>
<html lang="ru">
	<head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	    <title>Edit task</title>
	</head>
	<body>
<?php include (ROOT . 'views/template/navbar.php'); ?>
<!-- just for beauty -->
<?php include (ROOT . 'views/template/top_banner.php'); ?>
		<main role="main" class="container">
			<h6 class="border-bottom border-gray pb-2 mb-0">Edit task</h6>
			<div class="my-3 p-3 bg-white rounded box-shadow">
				<form method="POST" action="/taskManager/update">
					<div class="row">
						<div class="col">
							<label for="name">Name</label>
							<input type="text" class="form-control" value="<?= $page['name'] ?>" name="name" required>
						</div>
						<div class="col">
							<label for="email">Email</label>
							<input type="email" class="form-control" value="<?= $page['email'] ?>" name="email" required>
						</div>
					</div>
					<p></p>
					<div class="row">
						<div class="col">
							<label for="text">Task</label>
							<textarea class="form-control" id="text" rows="4" name="text" required><?= $page['text'] ?></textarea>
							<p></p>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customCheck1" name="done" <?php if ($page['done'] == "true") echo "checked"?>>
								<label class="custom-control-label" for="customCheck1">Task completed</label>
							</div>
							<p></p>
							<input type="hidden" name="id" value="<?= $page['id'] ?>">
							<button type="submit" class="btn btn-success btn-block" name="submit" value="submit">Save task</button>
						</div>
					</div>
				</form>
			</div>
		</main>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>