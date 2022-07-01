<form class="formm" action="/admin/add" method="post">
	<h2 class="titlee">Add user</h2>
	<p class="error"><?= $error['success']??null; ?></p>
	<p class="error"><?= $error['DB']??null; ?></p>
	<p class="error"><?= $error['all']??null; ?></p>
	<div>
        <label class="labell">Login</label>
        <br>
        <input class="inputt <?= isset($error['login'])?err:null; ?>" name="login" type="text" placeholder="Enter login..." value="<?= $data['login']??null; ?>"/>
        <p class="error"><?= $error['login']??null; ?></p>
    </div>

    <div>
        <label class="labell">Password</label>
        <br>
        <div class="blockk">
            <input id="password-input" class="inputt <?= isset($error['password'])?err:null; ?>" name="password" type="password" placeholder="Enter password..." value="<?= $data['password']??null; ?>"/>
            <a href="#" onclick="return show_hide_password(this);">&#128065;</a>
        </div>
        <p class="error"><?= $error['password']??null; ?></p>
    </div>

    <div>
        <label class="labell">Name</label>
        <br>
        <input class="inputt <?= isset($error['name'])?err:null; ?>" name="name" type="text" placeholder="Enter name..." value="<?= $data['name']??null; ?>"/>
        <p class="error"><?= $error['name']??null; ?></p>
    </div>

    <div>
        <label class="labell">Surname</label>
        <br>
        <input class="inputt <?= isset($error['surname'])?err:null; ?>" name="surname" type="text" placeholder="Enter Surname..." value="<?= $data['surname']??null; ?>"/>
        <p class="error"><?= $error['surname']??null; ?></p>
    </div>

    <div>
        <label class="labell">Gender</label>
        <br>
        <select class="inputt" name="gender">
			<option <?= (isset($data['gender']) && $data['gender'] == 'male')?'selected':null;  ?>>male</option>
			<option <?= (isset($data['gender']) && $data['gender'] == 'female')?'selected':null;  ?>>female</option> 
		</select>
    </div>

    <div>
        <label class="labell">Date of Birth</label>
        <br>
        <input class="inputt <?= isset($error['DOB'])?err:null; ?>" name="DOB" type="date" value="<?= $data['DOB']??date("Y-m-d"); ?>" required oninvalid="this.setCustomValidity('Error!!!')" oninput="setCustomValidity('')" min="1900-01-01"/>
        <p class="error"><?= $error['DOB']??null; ?></p>
    </div>

    <button class="buttonn" type="submit">Add</button>
</form> 

