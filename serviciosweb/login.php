<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Paul Moreno or PacManGod_MLG" />
    <link rel="stylesheet" href="assets/css/iniciosesion.css" />
    <title>Inicio sesion</title>
  </head>
  <body>
    <div class="input-container">
      <img
        class="logoC"
        src="assets/img/LogoCUN.png"
        alt="logo"
        class="logo de la CUN"
      />
      <form action="backend/controller.php" class="formulario" method="POST" id="formulario">
        <h1 class="h2">Inicio de sesión</h1>
        <!-- correo -->
        <div class="input-user">
          <h4 class="h4">Correo</h4>
          <input
            type="email"
            name="email"
            placeholder="ejemplo@ejemplo.com"
            required
          />
        </div>
        <!-- Contraseña -->
        <h4 class="h4">Contraseña</h4>
        <div class="input-group">
          <input type="password" name="password" placeholder="*******" required />
          <span class="toggle">💪</span>
          <span class="ripple"></span>
        </div>
        <div class="pass-strength">
          <div class="strength-percent"><span></span></div>
          <span class="strength-label">Nivel</span>
        </div>

        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        <p class="texto">
          ¿No tienes una cuenta? <a href="registro.php">Registrate</a>
        </p>
      </form>
    </div>
    <script src="assets/js/login.js"></script>
    <script src="assets/lib/jquery-3.6.1.min.js"></script>
  </body>
</html>
