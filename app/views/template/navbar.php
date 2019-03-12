		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="/taskManager">
				<img src="https://getbootstrap.com/docs/4.2/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
				Task manager
			</a>
			
		<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#newTaskModal">+ New task</button>
		<div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" action="/taskManager/new">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">New message</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Your name:</label>
								<input type="text" class="form-control" id="recipient-name" name="name" required>
							</div>
							<div class="form-group">
								<label for="recipient-email" class="col-form-label">Your email:</label>
								<input type="email" class="form-control" id="recipient-email" name="email" required>
							</div>
							<div class="form-group">
									<label for="message-text" class="col-form-label">Task text:</label>
									<textarea class="form-control" id="message-text" name="text" required></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" name="submit" value="submit">Add task</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			
<?php if ($page['isAdmin']): ?>
			<div class="dropleft my-2 my-sm-0 ">
			<button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    admin
			</button>
				<div class="dropdown-menu dropleft" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="/taskManager/logout">Выйти</a>
				</div>
			</div>
<?php else: ?>
			<div class="btn-group" role="group" aria-label="Basic example">
					<button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-info my-2 my-sm-0">
						Войти
					</button>
			</div>

			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Admin login</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action = "/taskManager/login">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Login:</label>
									<input type="text" class="form-control" id="recipient-name" name="login">
								</div>
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Password:</label>
									<input type="password" class="form-control" id="recipient-name" name="password">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Войти</button>
							</div>
							</form>
					</div>
				</div>
			</div>
<?php endif; ?>
		</nav>