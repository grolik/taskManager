<?php if (!empty ($page['alerts'][0])): ?>
<?php foreach ($page['alerts'] as $notification): ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?= $notification; ?>
		</div>
<?php endforeach; ?>
<?php endif; ?>