<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titolo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
  </head>
  <body>

    <!-- Barra di navigazione-->
    <nav class="navbar navbar-expand-lg sticky-top bg-warning">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Nome Social</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profilo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Impostazioni</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Notifiche</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary " type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <main>
      <br/>
      <!--Profilo-->
      <div class="container col-12 col-sm-6">
        <div class="justify-content-sm-center">
          <?php if (isset($utente)): ?>
            <h1>@<?php echo $utente["nickname"]; ?></h1>
            <img src="<?php echo $utente["foto_profilo"]; ?>" class="rounded-circle col-5">
            <hr class="border border-dark">
            <p><?php echo $utente["biografia"]; ?>.</p>
          <?php endif; ?>
        </div>
      </div>

      <!--Recensione-->
      <?php if (isset($recensioni)): ?>
        <?php foreach($recensioni as $post): ?>
          <div class="container col-12 col-sm-6">
            <div class="justify-content-sm-center">

              <div class="card mb-5">

                <!--header-->
                <div class="card-header">
                  <img src="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$post["publisher"]->getProfileImageSrc(); ?>" class="rounded-circle col-2">
                  <a href="#" class="text-decoration-none text-dark"><?php echo $post["publisher"]->getUsername(); ?></a>
                </div>
                <img src="" class="card-img-center" alt="...">

                <!--body-->
                <div class="card-body">

                  <!--recensione-->
                  <div class="text-center">
                    <a href="#" class="text-decoration-none text-dark"><?php echo $post["restaurant"]->getName(); ?></a>
                  </div>
                  <div class="overflow-y-auto border border-black mb-2" style="max-height: 5em;">
                    <p><?php echo $post["review"]->getContent(); ?></p>
                  </div>

                  <!--commenti-->
                  <?php if(isset ($post["comments"])): ?>
                    <div class="text-center">
                    <p class="btn btn-outline-primary">Commenti</p>
                    </div>
                    <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                      <?php foreach($post["comments"] as $comment): ?>
                        <p class="my-0"><?php echo $comment->getPublisherId(); ?></p>
                        <p class="my-0"><?php echo $comment->getContent(); ?></p>
                        <br>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <!--Like-->
                  <?php if(isset ($post["likes"])): ?>
                    <div class="text-center mt-2 mb-0">
                    <p class="btn btn-outline-danger">Vedi Like</p>
                    </div>
                    <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                      <?php foreach($post["likes"] as $like): ?>
                        <p class="my-0"><?php echo $like->getUsername(); ?></p>
                        
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <!--pulsanti d'interazione-->
                  <div>
                    <div class="card-footer m-2 align-middle ">
                      <button class="btn btn-danger mb-2" style="display: inline-block;">Like</button>
                      <form method="POST" style="display:inline-block">
                        <input type="submit" name="Submit" value="Commenta" class="btn btn-primary" style="display:inline-block"/>
                        <input type="text" id="commento" name="commento" required style="display:inline-block"/>
                      </form></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <!--Notifiche-->
      <?php if(isset($notifiche)): ?>
        <?php foreach($notifiche as $notifica): ?>
          <div class="container col-12 col-sm-6 p-0">
            <div class="justify-content-sm-center my-1">
              <div class="border border-black">
                  <p><?php echo $notifica; ?></p>
              </div>  
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?> 
      
      <!--Form Recensione-->
      <?php if(isset($form)):?>
        <div class="container col-12 col-sm-6 p-0">
            <div class="justify-content-sm-center my-1">
              <div class="border border-black p-4">
                  <p><?php echo $form ; ?></p>
              </div>  
            </div>
          </div>
        <?php endif;?>
          
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>