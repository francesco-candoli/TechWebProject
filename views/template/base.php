<?php

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo $titolo; ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="public/css/index.css">
</head>

<body>

  <!-- Barra di navigazione-->
  <nav class="navbar navbar-expand-lg sticky-top bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="">Nome Social</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER; ?>">Home</a>
          </li>
          <?php if (isset($_SESSION["username"])): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "profile/" . $_SESSION["username"]; ?>">Profilo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(isset($has_notifications)){if($has_notifications){echo "text-decoration-underline";}}?>" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "notifications"; ?>" <?php if(isset($has_notifications)){if($has_notifications){echo 'style="color:#8A240A"';}}?>>Notifiche</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "logout"; ?>">Logout</a>
            </li>
          <?php else:?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "login"; ?>">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "register"; ?>">Registrazione</a>
            </li>
          <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION["username"])): ?>
        <div class="d-flex">
          <label for="search_label" style="display:none">search</label>
          <input type="text" class="me-2" placeholder="Search" id="search_label">
          <button class="btn btn-outline-secondary" id="search_button">Search</button>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <main>
    <br>

      <!--Profilo-->
      <div class="container col-12 col-sm-6">
        <div class="text-center">
          <?php if (isset($profile)): ?>
            <h1 class="align-middle">@<?php echo $profile->getUsername(); ?></h1>
            <img src="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$profile->getProfileImageSrc(); ?>" class="rounded-circle col-5"  alt="profile image">
            <?php if ($canFollow): ?>
              <hr class="border border-light">
              <button class="btn btn-info text-dark border-black" id="change_follow_status_btn" data-profileId="<?php echo $profile->getId();?>"><?php if($follow) echo "Unfollow"; else echo "Follow";?></button>
            <?php endif; ?>
            <?php if ($canPost): ?>
              <hr class="border border-light">
              <a href="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."upload"?>" class="btn btn-info text-dark border-black">Post</a>
              <button class="btn btn-info text-dark border-black" id="change_profile_photo_btn">Cambia foto profilo</button>
              <div class="my-2 border border-black rounded bg-info-subtle" id="change_profile_photo_form" style="display:none">
                <form action="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."changeProfileImage" ?>" method="POST" enctype="multipart/form-data" class="my-2" >
                  <label for="profileImage">Nuova foto:</label> <input type="file" name="profileImage" id="profileImage" required><br>
                  <button type="submit" class="btn btn-outline-dark mt-2">Carica</button>
                </form>
                <button class="btn btn-danger mb-2" id="delete_profile_image_btn">Elimina</button>
              </div>
            <?php endif; ?>
            <hr class="border border-dark">
            <p><?php echo "Età: ".$profile->getAge()." - Sesso: ".strtoupper($profile->getSex()). " - Follower: ".$numberOfFollower." - Seguiti: ".$numberOfFollowing; ?>
            </p>
            <hr class="border border-dark">
          <?php endif; ?>
        </div>
      </div>

    <!--Error-->
    <div class="container col-12 col-sm-6">
      <div class="text-center">
        <?php if (isset($error_message)): ?>
          <h2>
            <?php echo $error_message; ?>
          </h2>
        <?php endif; ?>
      </div>
    </div>

    <!--Recensione-->
    <?php if (isset($recensioni)): ?>
      <?php $index=0; ?>
      <?php foreach ($recensioni as $post): ?>
        <?php $index++; ?>
        <div class="container col-12 col-sm-6">
          <div class="justify-content-sm-center">

            <div class="card mb-5">

              <!--header-->
              <div class="card-header">
                <img src="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . $post["publisher"]->getProfileImageSrc(); ?>"
                  class="rounded-circle col-2" alt="profile image">
                <a href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "profile/" . $post["publisher"]->getUsername(); ?>"
                  class="text-decoration-none text-dark">
                  <?php echo $post["publisher"]->getUsername(); ?>
                </a>
              </div>

              <?php if (isset($post["photo"][0])): ?>
                <img src="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . $post["photo"][0]->getSrc(); ?>"
                  class="card-img-center" alt="<?php echo $post["photo"][0]->getAlt(); ?>"  id="<?php echo "review_image".$index ?>">
                <div class="d-flex justify-content-center align-content-center">
                  <button type="button" class="btn btn-outline-secondary d-flex p-3 m-2" id="<?php echo "left_slider".$index; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-arrow-bar-left"
                      viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5" />
                    </svg>
                  </button>
                  <button type="button" class="btn btn-outline-secondary d-flex p-3 m-2" id="<?php echo "right_slider".$index; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-arrow-bar-right"
                      viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5" />
                    </svg>
                  </button>
                </div>
              <?php endif; ?>

              <!--body-->
              <div class="card-body">

                <!--recensione-->
                <div class="text-center mb-2">
                  <p class="text-dark mb-0">
                    <?php echo $post["restaurant"]->getName(); ?>
                  </p>
                  <?php for ($i = 0; $i < $post["review"]->getVote(); $i++): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F6831D" class="bi bi-star-fill"
                      viewBox="0 0 16 16">
                      <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                  <?php endfor; ?>
                </div>
                <div class="overflow-y-auto border border-black mb-2" style="max-height: 5em;">
                  <p class="ms-2">
                    <?php echo $post["review"]->getContent(); ?>
                  </p>
                </div>

                <!--commenti-->
                <?php if (isset($post["comments"])): ?>
                  <div class="text-center">
                    <p class="btn btn-outline-primary" id="<?php echo "comment_hider".$index ?>">Vedi Commenti</p>
                  </div>
                  <div id="<?php echo "comment_div".$index ?>" style="display: none">
                    <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                      <?php foreach ($post["comments"] as $comment): ?>
                        <p class="my-0" style="display: inline-block;">
                          <?php echo $comment->getContent(); ?>
                        </p>
                        <br>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <!--Like-->
                <?php if (isset($post["likes"])): ?>
                  <div class="text-center mt-2 mb-0">
                    <p class="btn btn-outline-danger" id="<?php echo "like_hider".$index ?>">Vedi Like</p>
                  </div>
                  <div id="<?php echo "like_div".$index ?>" style="display:none">
                    <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                      <?php foreach ($post["likes"] as $like): ?>
                        <p class="ms-2 my-0">
                          <?php echo $like->getUsername(); ?>
                        </p>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <!--pulsanti d'interazione-->
                <?php if (isset($_SESSION["user_id"])): ?>
                  <div>
                    <div class="card-footer m-2">
                      <button class="btn btn-outline-danger" style="display: inline-block;"  id="<?php echo "like_btn".$index ?>" data-userId="<?php echo $_SESSION['user_id'] ?>" data-reviewId="<?php echo $post['review']->getId() ?>">
                        <?php if ($post['liked'] == true)
                          echo "Unlike";
                        else
                          echo "Like"; ?>
                      </button>
                      <button class="btn btn-outline-primary" style="display:inline-block" id="<?php echo "comment_btn".$index ?>" data-reviewId="<?php echo $post['review']->getId() ?>">Commenta</button>
                      <label for="<?php echo "comment_label".$index ?>" style="display:none">comment</label>
                      <input type="text" id="<?php echo "comment_label".$index ?>" style="display:inline-block" >
                    </div>
                  </div>
                <?php endif; ?>

                <!--Data-->
                <div>
                  <p class="text-end mx-2"><?php echo $post["review"]->getDate() ?></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!--Notifiche-->
    <?php if (isset($notifiche)): ?>
      <?php $index=0; ?>
      <?php foreach ($notifiche as $notifica): ?>
        <?php $index++; ?>
        <div class="container col-12 col-sm-6 p-0">
          <div class="justify-content-sm-center my-1">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"> 
                  <a href="<?php echo PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . $notifica->getUrl(); ?>">Link</a>
                </h5>
                <p class="card-text">
                  <?php echo $notifica->getContent(); ?>
                </p>
                <button class="btn btn-outline-danger" id="<?php echo "notification_delete_btn".$index ?>" data-Id="<?php echo $notifica->getId() ?>">X</button>
              </div>
            </div>
          </div>
        </div>
        <br>
      <?php endforeach; ?>
    <?php endif; ?>

    <!--Form Recensione-->
    <?php if (isset($form)): ?>
      <div class="container col-12 col-sm-6 p-0">
        <div class="justify-content-sm-center my-1">
          <div class="border border-black p-4">
            <p>
              <?php echo $form; ?>
            </p>
          </div>
        </div>
      </div>
    <?php endif; ?>


  </main>

  <script>
    <?php
    $c = 0;
    $y = 0;
    if (isset($recensioni)) {
      echo "const photos=[";

      foreach ($recensioni as $post) {
        if ($c != 0) {
          echo ",";
        }
        $c++;
        echo "[";
        foreach ($post["photo"] as $photo) {
          if ($y != 0) {
            echo ",";
          }
          $y++;
          echo "'" . PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . $photo->getSrc() . "'";

        }
        echo "]";
        $y = 0;
      }
      echo "];";
      
      echo "const subfolderURL ='". PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER."';";
      echo "const profileURL = '" . PROTOCOL . SERVER . URL_ROOT . URL_SUBFOLDER . "profile/'";
    }

    ?>
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <?php 
    if(isset($script)){
      echo $script;
    }
  ?>
</body>

</html>