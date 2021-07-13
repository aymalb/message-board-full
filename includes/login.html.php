
<div id="reg-log">
    <div id="login">Login</div>
    <div id="register">Register</div>
    <div id="reg-log-form"></div>
</div>

<script>
    function reg() {
        let form = `<form action="" method="post" id="register-form">
                        <input type="hidden" name="reg-log" value="reg">
                        <div>
                            <label for="username">Pick a username: </label>
                            <input type="text" name="user[name]" id="username" required>
                        </div>
                        <div>
                            <label for="password">Pick a password: </label>
                            <input type="password" name="user[password]" id="password" required>
                        </div>
                        <input type="submit" value="Submit" id="submit">
                    </form>`;
        document.getElementById('reg-log-form').innerHTML = form;
        document.getElementById('register').className = "selected";
        document.getElementById('login').className = "";

    }
    document.getElementById('register').addEventListener("click", reg);
    function log() {
        let form = `<form action="" method="post" id="login-form">
                        <input type="hidden" name="reg-log" value="log">
                        <div>
                            <label for="username">Enter your username: </label>
                            <input type="text" name="user[name]" id="username" required>
                        </div>
                        <div>
                            <label for="password">Enter your password: </label>
                            <input type="password" name="user[password]" id="password" required>
                        </div>
                        <input type="submit" value="Submit" id="submit">
                    </form>`;
        document.getElementById('reg-log-form').innerHTML = form;
        document.getElementById('register').className = "";
        document.getElementById('login').className = "selected";
    }
    document.getElementById('login').addEventListener("click", log);
    log();
</script>