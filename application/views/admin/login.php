
    <form class="formm" method="post" action="/">
        <h2 class="titlee">Entrance</h2>
        <p class="error"><?= $error??null; ?></p>

        <div>
            <label class="labell">Login</label>
            <br>
            <input class="inputt" name="login" type="text" placeholder="Enter your login..." value="<?= $data??null; ?>" autocomplete="off"/>
        </div>
        
        <div>
            <label class="labell">Password</label>
            <br>
            <div class="blockk">
                <input id="password-input" class="inputt" name="password" type="password" placeholder="Enter your password..."/>
                <a href="#" onclick="return show_hide_password(this);">&#128065;</a>
            </div>
        </div>

        <button class="buttonn" type="submit">Login</button>     
    </form> 



