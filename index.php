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
                    <input type="text">
                    <button class="btn btn-primary">Ajouter</button>
                </form>
            </div>

            <div class="todo-list"></div>
        </div>
        <?php require_once 'includes/footer.php' ?>

    </div>

</body>

</html>