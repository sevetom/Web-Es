<form action="#" method="POST">
    <h2>Login</h2>
    <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">username</label>
            <input type="text" name="username" id="username"/>
        </li>
        <li>
            <label for="password">password</label>
            <input type="password" name="password" id="password"/>
        </li>
        <li>
            <input type="submit" name="submit" value="Login"/>
        </li>
    </ul>
</form>