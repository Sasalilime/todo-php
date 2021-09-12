<?php

const ERROR_REQUIRED = 'Veuillez indiquer une todo.';
const ERROR_TOO_SHORT = 'Veuillez indiquer au moins 5 caractères.';

$filename = __DIR__ . "/data/todos.json";
$error = '';
$todos = [];

if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Ne prend pas en compte les accents $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST = filter_input_array(INPUT_POST, [
        "todo" => [
            "filter" => FILTER_SANITIZE_STRING,
            "flags" => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK
        ]
    ]);
    $todo = $_POST['todo'] ?? '';

    if (!$todo) {
        $error = ERROR_REQUIRED;
    } else if (mb_strlen($todo) < 5) {
        $error = ERROR_TOO_SHORT;
    }

    if (!$error) {
        $todos = [...$todos, [
            'name' => $todo,
            'done' => true,
            'id' => time()
        ]];
        //ne prend pas en compte les accents file_put_contents($filename, json_encode($todos));
        file_put_contents($filename, json_encode($todos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <title>Todo</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="todo-container">
                <h1>Todo List</h1>
                <form class="todo-form" method="post" action="/">
                    <input name="todo" type="text">
                    <button class="btn btn-primary">Ajouter</button>
                </form>
                <?php if ($error) : ?>
                    <p class="text-danger"><?= $error ?></p>
                <?php endif; ?>
                <div class="todo-list"></div>
            </div>

        </div>
        <?php require_once 'includes/footer.php' ?>

    </div>

</body>

</html>