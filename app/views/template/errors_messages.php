<?php if (!empty ($page['errors'][0])): ?>
<?php foreach ($page['errors'] as $notification): ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?= $notification; ?>
		</div>
<?php endforeach; ?>
<?php endif; ?>