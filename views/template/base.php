<?php

  //mandare variabile allo script js

?>

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
        <a class="navbar-brand" href="">Nome Social</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER;?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php if(isset($_SESSION["username"])){ echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."profile/".$_SESSION["username"]; }else{ echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."login";}?>">Profilo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."notifications";?>">Notifiche</a>
            </li>
          </ul>
          <div class="d-flex">
            <input class="me-2" placeholder="Search" id="search_label">
            <button class="btn btn-outline-secondary" id="search_button">Search</button>
          </div>
        </div>
      </div>
    </nav>
    <main>
      <br/>

      <!--Profilo-->
      <div class="container col-12 col-sm-6">
        <div class="text-center">
          <?php if (isset($profile)): ?>
            <h1 class="align-middle">@<?php echo $profile->getUsername(); ?></h1>
            <img src="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$profile->getProfileImageSrc(); ?>" class="rounded-circle col-5">
            <?php if ($canFollow): ?>
              <hr class="border border-light">
              <a href="#" class="btn btn-outline-primary"><?php if($follow) echo "Unfollow"; else echo "Follow";?></a>
            <?php endif; ?>
            <hr class="border border-dark">
            <p><?php echo "Età: ".$profile->getAge()." - Sesso: ".strtoupper($profile->getSex()); ?></p>
            <hr class="border border-dark">
          <?php endif; ?>
        </div>
      </div>

      <!--Error-->
      <div class="container col-12 col-sm-6">
        <div class="text-center">
          <?php if (isset($error_message)): ?>
            <h2><?php echo $error_message; ?></h2>
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

                <?php if(isset($post["photo"][0])): ?>
                <img src="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$post["photo"][0]->getSrc(); ?>" class="card-img-center" alt="..."  id="review_image">
                  <div class="d-flex justify-content-center align-content-center" id="image-slider">
                    <button type="button" class="btn btn-outline-secondary d-flex p-3 m-2" id="left-slider">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
                      </svg>
                    </button>
                    <button type="button" class="btn btn-outline-secondary d-flex p-3 m-2" id="right-slider">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5"/>
                      </svg>
                    </button>
                  </div>
                <?php endif; ?>
                <!--body-->
                <div class="card-body">

                  <!--recensione-->
                  <div class="text-center">
                    <a href="#" class="text-decoration-none text-dark"><?php echo $post["restaurant"]->getName(); ?></a>
                  </div>
                  <div class="overflow-y-auto border border-black mb-2" style="max-height: 5em;">
                    <p class="ms-2"><?php echo $post["review"]->getContent(); ?></p>
                  </div>

                  <!--commenti-->
                  <?php if(isset ($post["comments"])): ?>
                    <div class="text-center">
                      <p class="btn btn-outline-primary" id="comment_hider">Vedi Commenti</p>
                    </div>
                    <div id="comment_div" style="display: none">
                      <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                        <?php foreach($post["comments"] as $comment): ?>
                          <p class="ms-2 my-0" style="display: inline-block;"><?php echo $comment->getPublisherId(); ?>:</p>
                          <p class="my-0" style="display: inline-block;"><?php echo $comment->getContent(); ?></p>
                          <br>
                        <?php endforeach; ?>
                      </div>
                      </div>
                  <?php endif; ?>

                  <!--Like-->
                  <?php if(isset ($post["likes"])): ?>
                    <div class="text-center mt-2 mb-0">
                      <p class="btn btn-outline-danger" id="like_hider">Vedi Like</p>
                    </div>
                    <div id="like_div" style="display:none">
                      <div class="overflow-y-auto border border-black" style="max-height: 5em; display:block">
                        <?php foreach($post["likes"] as $like): ?>
                          <p class="ms-2 my-0"><?php echo $like->getUsername(); ?></p>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endif; ?>

                  <!--pulsanti d'interazione-->
                  <?php if(isset ($_SESSION["user_id"])): ?>
                    <div>
                      <div class="card-footer m-2 align-middle ">
                        <button class="btn btn-danger mb-2" style="display: inline-block;" onclick="addLike(<?php echo $_SESSION['user_id'] ?>,<?php echo $post['publisher']->getId() ?>)">Like</button>
                        <form method="POST" style="display:inline-block">
                          <input type="submit" name="Submit" value="Commenta" class="btn btn-primary" style="display:inline-block"/>
                          <input type="text" id="commento" name="commento" required style="display:inline-block"/>
                        </form></div>
                      </div>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      
<!--Notifiche-->
<?php if (isset($notifiche)): ?>

  <?php foreach ($notifiche as $notifica): ?>
    
    <div class="container col-12 col-sm-6 p-0">
      <div class="justify-content-sm-center my-1">
      <div class="card" >
      <div class="card-body">
        <h5 class="card-title"> <a href="<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$notifica->getUrl(); ?>">Link</a> 
                </h5>
                <p class="card-text">
                  <?php echo $notifica->getContent(); ?>
                </p>                               
                <a class="btn btn-danger" onclick="deleteNotification(<?php echo $notifica->getId()?>)">X</a>
              </div>
            </div>
          </div>
        </div>
    <br>
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
    <script>
      function deleteNotification(id){
        // 1. Crea un nuovo oggetto XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // 2. Lo configura: richiesta GET per l'URL /article/.../load
        xhr.open('GET', '<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER; ?>notifications/delete/'+id);
        // 3. Invia la richiesta alla rete
        xhr.send();
        // 4. Questo codice viene chiamato dopo la ricezione della risposta
        xhr.onload = function() {
          if (xhr.status != 200) { // analizza lo status HTTP della risposta
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // ad esempio 404: Not Found
          } else { // mostra il risultato
            alert(`Done, ${xhr.response}`); // response contiene la risposta del server
          }
        };
        xhr.onerror = function() {
          alert("Request failed");
        };
        window.location.assign(window.location.href);
      }

      function deleteLike(id){
        // 1. Crea un nuovo oggetto XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // 2. Lo configura: richiesta GET per l'URL /article/.../load
        xhr.open('GET', '<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER; ?>like/delete/'+id);
        // 3. Invia la richiesta alla rete
        xhr.send();
        // 4. Questo codice viene chiamato dopo la ricezione della risposta
        xhr.onload = function() {
          if (xhr.status != 200) { // analizza lo status HTTP della risposta
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // ad esempio 404: Not Found
          } else { // mostra il risultato
            alert(`Done, ${xhr.response}`); // response contiene la risposta del server
          }
        };
        xhr.onerror = function() {
          alert("Request failed");
        };
      }

      function addLike(user_id, review_id){
        console.log(user_id+"_"+review_id);
        // 1. Crea un nuovo oggetto XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // 2. Lo configura: richiesta GET per l'URL /article/.../load
        xhr.open('GET', '<?php echo PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER; ?>like/add/'+user_id+"_"+review_id);
        // 3. Invia la richiesta alla rete
        xhr.send();
        // 4. Questo codice viene chiamato dopo la ricezione della risposta
        xhr.onload = function() {
          if (xhr.status != 200) { // analizza lo status HTTP della risposta
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // ad esempio 404: Not Found
          } else { // mostra il risultato
            alert(`Done, ${xhr.response}`); // response contiene la risposta del server
          }
        };
        xhr.onerror = function() {
          alert("Request failed");
        };
      }

    </script>

    <script>
      <?php
      $c=0;
      $y=0;

      echo "const photos=[";

      foreach($recensioni as $post){ 
        if($c!=0){
          echo ",";
        }
        $c++;
        echo "[";
        foreach($post["photo"] as $photo){
          if($y!=0){
            echo ",";
          }
          $y++;
          echo "'". PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER.$photo->getSrc()."'";
          
        }
        echo "]";
        $y=0;
      }
      echo "];";
      echo "const profileURL = '".PROTOCOL.SERVER.URL_ROOT.URL_SUBFOLDER."profile/'";
      ?>

    const leftSliders = document.querySelectorAll("#left-slider");
    const rightSliders = document.querySelectorAll("#right-slider");
    const image = document.querySelectorAll("#review_image");

    for (let i = 0; i < leftSliders.length; i++) {
        leftSliders[i].addEventListener("click", function () {
            let index = photos[i].indexOf(image[i].getAttribute("src"));
            if (index > 0) {
                index = (index - 1);
                image[i].setAttribute("src", photos[i][index]);
            }
        })

        rightSliders[i].addEventListener("click", function () {
            let index = photos[i].indexOf(image[i].getAttribute("src"));
            if (index < (photos[i].length - 1)) {
                index = index + 1;
                image[i].setAttribute("src", photos[i][index]);
            }
        })
    }

    // COMMENTI
    const comment_hiders = document.querySelectorAll("#comment_hider");
    const comment_divs = document.querySelectorAll("#comment_div");
    for (let i = 0; i < comment_hiders.length; i++) {
        comment_hiders[i].addEventListener("click", function () {
            if (comment_divs[i].getAttribute("style") == "") {
                comment_divs[i].setAttribute("style", "display:none");
                comment_hiders[i].setAttribute("class", "btn btn-outline-primary");
            } else {
                comment_divs[i].setAttribute("style", "");
                comment_hiders[i].setAttribute("class", "btn btn-primary");
            }
        })
    }

    // LIKE
    const like_hiders = document.querySelectorAll("#like_hider");
    const like_divs = document.querySelectorAll("#like_div");
    for (let i = 0; i < like_hiders.length; i++) {
        like_hiders[i].addEventListener("click", function () {
            if (like_divs[i].getAttribute("style") == "") {
                like_divs[i].setAttribute("style", "display:none");
                like_hiders[i].setAttribute("class", "btn btn-outline-danger");
            } else {
                like_divs[i].setAttribute("style", "");
                like_hiders[i].setAttribute("class", "btn btn-danger");
            }
        })
    }

    //SEARCH BUTTON
    const search_button = document.getElementById("search_button");
    const search_label = document.getElementById("search_label");
    search_button.addEventListener("click",function() {
      window.location.assign(profileURL.concat(search_label.value))
    });

 
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>