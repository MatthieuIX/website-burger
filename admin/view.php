<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, items.category, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?
    ');

$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Burger code</title>
    <script src="https://code.jquery.com/jquery-1.11.3.js" integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/styles.css" />
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet" />
</head>

<body>
    <h1 class="text-logo">
        <span class="glyphicon glyphicon-cutlery"></span> Burger Code
        <span class="glyphicon glyphicon-cutlery"></span>
    </h1>
    <div class="container-admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un item</strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label for="">Nom :</label><?php echo ' ' . $item['name']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Description :</label><?php echo ' ' . $item['description']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Prix :</label><?php echo ' ' . number_format((float)$item['price'], 2, '.', ''); ?> €
                    </div>
                    <div class="form-group">
                        <label for="">Catégorie :</label><?php echo ' ' . $item['category']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Image :</label><?php echo ' ' . $item['image']; ?>
                    </div>
                </form>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </div>
            <div class="col-sm-6 site">
                <div class="thumbnail">
                    <img src="<?php echo '../img/' . $item['image']; ?>" alt="..." />
                    <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''); ?> €</div>
                    <div class="caption">
                        <h4><?php echo $item['name']; ?></h4>
                        <p><?php echo $item['description']; ?></p>
                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>
                            Commander</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>