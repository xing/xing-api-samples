<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
  </head>

  <body>
    <div class="container">
      <div class="starter-template">
        <h1>Error: Something went wront with the OAuth handshake</h1>
        <p>
          Please make sure that your consumer key is correct.
          Your current consumer key is <span class="text-warning"><?= $consumerKey ?></span> (edit <code>config.php</code> to change)
          <pre class="pre-scrollable"><? print_r($error) ?></pre>
        </p>
        <a href="/" class="btn btn-primary">back</a>
      </div>
    </div>
  </body>

</html>
