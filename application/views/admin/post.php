<h2 class="titlee">User</h2>

<?php foreach ($data as $key => $value): ?>
	<?php if($key == 'password') continue; ?>
	<span class="record"><?= "$key: "; ?></span>
	<span class="record modify"><?= $value; ?></span>
	<br>
<?php endforeach; ?> 