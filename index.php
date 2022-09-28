<?php

    session_start();

    // a variável global $_SESSION define variáveis de sessão
    // isset vai verificar se a variável de sessão 'tasks' não existe, caso não exista, irá criá-la
    if ( !isset($_SESSION['tasks']) ) {
        $_SESSION['tasks'] = [];
    }


    // verifica se a variável task_description existe e é diferente de nula
    if ( isset($_POST['task_description']) ) {

        if ($_POST['task_description'] != ''){
            array_push($_SESSION['tasks'], $_POST['task_description']);

            // resolver problema depois (recarrega a página e a task é duplicada)
            unset($_POST['task_description']);
        } else {
            $_SESSION['message'] = 'O campo não pode ficar vazio!! ';
        }

    }

    if ( isset($_GET['clear']) ) {
        // libera todas as variáveis de sessão
        session_unset();

        // unset($_SESSION['tasks']);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container">
        <div class="header">
            <header>
                <h1>Gerenciador de Tarefas</h1>
            </header>
        </div>
        <div class="form">
            <form action="" method="POST">
                <label for="task_description">Task:</label>
                <input type="text" id="task_description" name="task_description" placeholder="Descrição da tarefa">

                <button type="submit">Anexar tarefa</button>
            </form>
            <?php

                if ( isset($_SESSION['message']) ) {
                    echo "<p class='alert_message' style='color: red;'>" . $_SESSION['message'] . "</p>";
                }

            ?>

        </div>
        <div class="separator"></div>
        <div class="list-tasks">
            <?php
                if ( isset($_SESSION['tasks']) ){
                    echo "<ul>";

                    foreach ($_SESSION['tasks'] as $key => $task) {
                        echo "<li>$task</li>";
                    }
                    echo "</ul>";
                }
            ?>

            <form action="" method="get">
                <input type="hidden" name="clear" value="clear">
                <button class="btn-clear" type="submit">Limpar Tarefas</button>
            </form>

        </div>
        <div class="separator"></div>
        <div class="footer">
            <footer>
                <p>
                    Developed by izadora ©  - 2022
                </p>
            </footer>
        </div>
    </div>


    <script>
        // limpa o parametro de clear na url
        url = new URL( window.location.href );
        if (url.search.trim() !== ''){
            window.location = '/';
        }

    </script>
</body>
</html>
