<?php
require_once './header.php';

function parseInput($field)
{
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field;
}
?>

    <body>

        <?php
            $errors = [];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                if(!empty($_POST))
                {
                    if(empty( $_POST['email']))
                    {
                        $errors['email'] = 'Поле email не заполнено';
                    }
                    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                    {
                        $errors['email'] = 'Не верно введен электронный адрес';
                    }
                    if(empty( $_POST['password']))
                    {
                        $errors['password'] = 'Поле password не заполнено';
                    }

                    $name =  parseInput($_POST['email']);
                    $password =  parseInput($_POST['password']);

                }

            }



        ?>

        <div class="container w-50 mt-4">
            <?php if(count($errors) && !isset($_SESSION['data'])):?>
                <?php foreach ($errors as $error):?>
                    <div class="alert alert-danger" role="alert">
                        <?=$error?>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email"  name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </body>
<?php
require_once "./footer.php";
?>