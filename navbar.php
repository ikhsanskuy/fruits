<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Eatee.Cereal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header>Eatee.Cereal</header>
  <ul>
    <li><a href="index.php"><i class="fas fa-shopping-cart"></i>Cereal</a></li>

    <?php if (isset($_SESSION["pelanggan"])): ?>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>

    <?php else:  ?>
    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i>Login</a></li>
    <li><a href="daftar.php"><i class="fas fa-user-plus"></i>Daftar</a></li>
    <?php endif ?>

  </ul>
</div>
 <section></section>

  </body>
</html>
