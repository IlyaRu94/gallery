<?php
session_start();
require 'config.php';
include 'bd.php';

$errors = [];
$messages = [];

$imageFileName = $_GET['name'];

if($_SESSION['auth'] === true){
//удаление комментария + проверка  принадлежности коммента
if(!empty($_POST['del'])) {
    $commentsFromUser=mysqli_query($link, "SELECT `id`, `login` FROM `comments` WHERE id='".$_POST["del"]."';");
    $row = mysqli_fetch_assoc($commentsFromUser);
    if($row['login']===$_SESSION['login']){
        mysqli_query($link, "DELETE FROM `comments` WHERE id='".$_POST["del"]."';");
        $messages[] = 'Комментарий удален';
    }else{
        $errors[] = 'Это не Ваш комментарий!';
    }
}

// Если коммент был отправлен
if(!empty($_POST['comment'])) {

    $comment = trim($_POST['comment']);

    // Валидация коммента
    if($comment === '') {
        $errors[] = 'Вы не ввели текст комментария';
    }

    // Если нет ошибок записываем коммент
    if(empty($errors)) {

        // Чистим текст, земеняем переносы строк на <br/>, дописываем дату
        $comment = strip_tags($comment);
        $comment = str_replace(array(["\r\n","\r","\n","\\r","\\n","\\r\\n"]),"<br/>",$comment);
        $comment = date('d.m.y H:i') . ': ' . $comment;

        // Записываем текст в БД
        mysqli_query($link, 'INSERT INTO `comments`(`login`, `picture`, `comment`) VALUES("'.$_SESSION["login"].'", "'.$imageFileName.'", "'.$comment.'");');

        $messages[] = 'Комментарий был добавлен';
    }
}
}

// Получаем список комментов
  $commentsbd = mysqli_query($link, "SELECT comments.login, comments.id, `name`, `picture`, `comment` FROM `comments` LEFT JOIN `users` ON comments.login=users.login WHERE comments.picture = '".$imageFileName."'");
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Галерея изображений | Файл <?php echo $imageFileName; ?></title>
</head>
<body>


<div class="container pt-4">

    <h1 class="mb-4"><a href="<?php echo URL; ?>">Галерея изображений</a></h1>
    <div style="text-align: right;">
    <?php if(!$_SESSION['auth'] === true){?>
    <a href="./auth.php">Войти</a>
    <?php }else{
        echo '<h4>Привет, '.$_SESSION['name'].'</h4><a href="./auth.php?exit=1"> Выйти </a>';
    } ?>
    </div>

    <!-- Вывод сообщений об успехе/ошибке -->
    <div class="updateAlert">
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <?php foreach ($messages as $message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endforeach; ?>
    </div>

    <h2 class="mb-4">Файл <?php echo $imageFileName; ?></h2>

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">

            <img src="<?php echo URL . '/' . UPLOAD_DIR . '/' . $imageFileName ?>" class="img-thumbnail mb-4"
                 alt="<?php echo $imageFileName ?>">

            <h3>Комментарии</h3>
            <div class="comments">
            <div class="commentsupdate">
            <?php
             //проверка на пустоту комментариев в базе и вывод их из базы через цикл
             if(!empty($commentsbd->num_rows)): 
             ?>
                <?php while($comment = mysqli_fetch_array($commentsbd)){ $i+=1; ?>
                    <div class="<?php echo (($i % 2) > 0) ? 'bg-light' : ''; ?>">
                        <!-- показываем кнопку удаления коммента только создателю коммента -->
                        <?php if($comment['login']===$_SESSION['login']){ ?>
                        <form method="post">
                            <input type="hidden" name="del" value="<?php echo $comment['id']; ?>">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                        <?php } ?>
                        <p><?php echo $comment['name'].'<br>'.$comment['comment']; ?></p>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="text-muted">Пока ни одного коммантария, будете первым!</div>
            <?php endif; ?>
            </div>
            </div>

            <!-- Форма добавления комментария -->
            <?php if($_SESSION['auth'] === true){?>
            <form method="post">
                <div class="form-group">
                    <label for="comment">Ваш комментарий</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <hr>
                <div type="submit" class="btn btn-primary">Отправить</div>
            </form>
            <?php } ?>
        </div>
    </div><!-- /.row -->

</div><!-- /.container -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>


<script>
    // скрипт, который отправляет на сервер коментарии без перезагрузки страницы и выводит новые, ну и подгружает ошибки
    let btn = document.querySelector('.btn');
    const text = document.querySelector('#comment');
    let comments = document.querySelector('.comments');
    let alert = document.querySelector('.updateAlert');
    btn.addEventListener('click', () => {
        let formData = new FormData();
        formData.append('comment', text.value);
        fetch("file.php?name=<?php echo $imageFileName; ?>", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.text();
        })
        .then(function (data) {
            // преобразуем полученный текст в полноценный html
            let textToHTML= function (str) {
                let dom = document.createElement('div');
                dom.innerHTML = str;
                return dom;
            };
            //затираем имеющиеся комменты и дописываем новые, то же самое делаем с ошибками комментов
            comments.innerHTML='';
            comments.appendChild(textToHTML(data).querySelector(".commentsupdate"));
            text.value='';
            let alertserver = textToHTML(data).querySelector(".alert")
            if(alertserver){
            alert.innerHTML='';
            alert.appendChild(alertserver); 
            }
            
        })
        .catch(function (error) {
            console.log(error);
        });
    });
</script>
</body>
</html>
