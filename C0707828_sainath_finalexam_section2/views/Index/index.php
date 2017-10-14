<?php

?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8"/>
    
        <title>Mi mvc en php</title>
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css"/>
        <script src="<?php echo URL; ?>public/js/jquery-1.11.0.min.js"></script>
</head>
<body>
    <?php if(!Session::exist()) { ?>    
    <div id="formWrapper">
        <div class="formWrapper">
            <div class="formTitle">Iniciar sesión</div>
            <form action="<?php URL ?>User/signIn" name='signIn' method="post">
                <input name="username" type="text" placeholder="Usuario" required/>
                <input name="password" type="password" placeholder="Clave" required/>
                <input id="signInBtn" name="signInBtn" type="submit" value='Entrar' required/>
                <div class="smallText">
                    <span>¿No estas registrado? <div class="button" id="signUpButton">Registrate aquí</div></span>
                    <span>¿olvidaste tu clave? <a href="">Recordar clave</a></span>
                </div>
            </form>
        </div>

        <div class="formWrapper hidden">
            <div class="formTitle">Registrarse</div>
            <form action="<?php URL ?>User/signUp" name='signUp' method="post">
                <input name="name" type="text" placeholder="Nombre" required/>
                <input name="email" type="email" placeholder="Email" required/>
                <input name="username" type="text" placeholder="Usuario" required/>
                <input name="password" type="password" placeholder="Clave" required/>
                <input id="signUpBtn" name="signUpBtn" type="submit" value='Registrarme' required/>
                <div class="smallText">
                    <span>¿estas registrado? <div class="button" id="signInButton">Inicia sesión</div></span>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $('#signUpButton').click(function() {
                $('form[name=signIn]').parent().hide();
                $('form[name=signUp]').parent().fadeToggle();
            });

            $('#signInButton').click(function() {
                $('form[name=signUp]').parent().hide();
                $('form[name=signIn]').parent().fadeToggle();
            });

            $('#signUpBtn').click(function(e) {
                e.preventDefault();
                signUp();
            });

            $('#signInBtn').click(function(e) {
                e.preventDefault();
                signIn();
            });
        });

        function signUp() {

            var name = $('form[name=signUp] input[name=name]')[0].value;
            var email = $('form[name=signUp] input[name=email]')[0].value;
            var username = $('form[name=signUp] input[name=username]')[0].value;
            var password = $('form[name=signUp] input[name=password]')[0].value;

            $.ajax({
                type: "POST",
                url: "<?php URL ?>User/signUp",
                data: {name: name, username: username, email: email, password: password}
            }).done(function(response) {
                if (response == true) {
                    alert("Registro existoso!");
                }else{
                    alert(response);
                }
            });
        }
        
        function signIn() {
            var username = $('form[name=signIn] input[name=username]')[0].value;
            var password = $('form[name=signIn] input[name=password]')[0].value;
            
            $.ajax({
                type: "POST",
                url: "<?php URL ?>User/signIn",
                data: {username: username, password: password}
            }).done(function(response) {
                if (response == 1) {
                    location.reload();
                }else{
                    alert("Usuario o clave incorrecta");
                }
            });
        }
    </script>
    <?php }else{ ?>
    <div class="formWrapper">
        <?php echo 'Hola '.Session::getValue('U_NAME').'!<br/>'; ?>
        <button id="closeSessionBtn">Cerrar Session</button>
    </div>
    
    <script>
        $(function(){
            $('#closeSessionBtn').click(function(){
                document.location = "<?php echo URL ?>User/destroySession";
            });
        });
    </script>
    <?php } ?>
</body>
</html>