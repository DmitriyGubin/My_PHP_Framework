<h2 class="titlee">The list of users</h2>

<div class='users-list-header'>
		<div class="line1">
			<div class="block">
				<h3>
					Name
					<a href="/admin/posts/name/ASC/1"><!--for sorting-->
						&#9650;
					</a>
					<a href="/admin/posts/name/DESC/1">
						&#9660;
					</a>
				</h3>	
			</div>

			<div class="block">
				<h3>
					Surname
					<a href="/admin/posts/surname/ASC/1">
						&#9650;
					</a>
					<a href="/admin/posts/surname/DESC/1">
						&#9660;
					</a>
				</h3>	
			</div>

			<div class="block">
				<h3>
					Gender
					<a href="/admin/posts/gender/ASC/1">
						&#9650;
					</a>
					<a href="/admin/posts/gender/DESC/1">
						&#9660;
					</a>
				</h3>	
			</div>

			<div class="block">
				<h3>
					DOB
					<a href="/admin/posts/DOB/ASC/1">
						&#9650;
					</a>
					<a href="/admin/posts/DOB/DESC/1">
						&#9660;
					</a>
				</h3>	
			</div>

			<div class="block">
				<h3>Delete user</h3>	
			</div>

			<div class="block">
				<h3>Edit user</h3>	
			</div>
		</div>				
</div>


<?php if (empty($list)): ?>
	<p class="titlee">User list is empty!!!</p>
<?php else: ?>
	<?php foreach ($list as $val): ?>
	<div class="users-list">
		<div class="line1">
			<div class="block">
				<h3>
					<a href="/admin/post/<?= $val['id']; ?>"><?= $val['name']; ?></a>
				</h3>	
			</div>

			<div class="block">
				<h3>
					<?= $val['surname']; ?>
				</h3>	
			</div>

			<div class="block">
				<h3>
					<?= $val['gender']; ?>
				</h3>	
			</div>

			<div class="block">
				<h3>
					<?= $val['DOB']; ?>
				</h3>	
			</div>

			<div class="block">
				<h3>
					<a href="/admin/delete/<?= $val['id']; ?>">Delete</a>
				</h3>	
			</div>

			<div class="block">
				<h3>
					<a href="/admin/edit/<?= $val['id']; ?>">Edit</a>
				</h3>	
			</div>

		</div>				
	</div>		
	<?php endforeach; ?>
	<div class="pag">
		<?php echo $pagination; ?>
	</div>
<?php endif; ?> 

 