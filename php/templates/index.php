<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XING API sample</title>
  </head>

  <body>
    <div class="container">
      <div class="starter-template">
      <h1>Hello <?= $displayName ?></h1>
      <img src="<?= $photoURL ?>" class="img-rounded">
      <p>Your consumer key is <mark><?= $consumerKey ?></mark> (edit <code>config.php</code> to change)</p>
      <? if ($isLoggedIn) { ?>
        <a href="/logout" class="btn btn-danger">Logout</a>
      <? } else { ?>
        <a href="/login" class="btn btn-primary">Login</a>
      <? } ?>
      </div>
    </div>
  </body>

</html>
