<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/header.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/main.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/footer.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/style.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/topic.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/post.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/profile.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/login.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/register.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/admin.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>css/login.css">
        <title>FORUM</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header>
                    <nav>
                        <div id="nav">
                            <?php
                                $user = App\Session::getUser();
                                if($user)
                                {
                                    if (App\Session::isAdmin())
                                    { ?>
                                        <a href="index.php?ctrl=security&action=manageUsers"><?= $user ?></a>
                                    <?php }
                                    else 
                                    { ?>
                                        <a href="index.php?ctrl=security&action=profile"><?= $user ?></a>
                                    <?php } ?>
                                    <a href="index.php?ctrl=forum&action=index">
                                        <img src="public/img/logo1.png" alt="logo site">
                                    </a>
                                    <a href="index.php?ctrl=security&action=logout">Log out</a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <span class="sign">
                                        <a href="index.php?ctrl=security&action=register">Sign in</a>
                                    </span>
                                    <a href="index.php?ctrl=forum&action=index">
                                        <img src="public/img/logo1.png" alt="logo site">
                                    </a>
                                    <span class="log">
                                        <a href="index.php?ctrl=security&action=login">Log in</a>
                                    </span>
                                    
                                <?php
                                }
                            ?>
                        </div>
                    </nav>
                    <div class="goku">
                        <img src="public/img/goku-removebg.png" alt="">
                    </div>
                </header>
                <div id="main-parent">
                    <main id="forum">
                        <div class="date-top">
                            <?php $date = new DateTime(); 
                            $date->setTimezone(new DateTimeZone('Europe/Paris'));?>
                            <?= $date->format('d F Y \à H\hi') ?>
                        </div>
                        <?= $page ?>
                    </main>
                </div>
            </div>
            <footer>
                <div class="date-bot">
                    &copy; <?= date_create("now")->format("Y") ?> - 
                </div>
                <div class="footer-main">
                    <div class="reglement">
                        <a href="#">Règlement du forum</a>
                    </div>
                    <div class="logo-bot">
                    <a href="index.php?ctrl=forum&action=index">
                        <img src="public/img/logo1.png" alt="logo site">
                    </a>
                    </div>
                    <div class="mentions">
                        <a href="#">Mentions légales</a>
                    </div>
                </div>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>