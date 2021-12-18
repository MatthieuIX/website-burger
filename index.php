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
  <link rel="stylesheet" href="css/styles.css" />
  <!-- FONT -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container site">
    <h1 class="text-logo">
      <span class="glyphicon glyphicon-cutlery"></span> Burger Code
      <span class="glyphicon glyphicon-cutlery"></span>
    </h1>
    <?php
    // DATABASE REQUIRE
    require 'admin/database.php';

    echo '<nav>
              <ul class="nav nav-pills">';

    // CATEGORY DB REQUEST
    $db = Database::connect();
    $statement = $db->query('SELECT * FROM categories');
    $categories = $statement->fetchAll();

    // GET ALL CATEGORIES IN THE MENU
    foreach ($categories as $category) {
      if ($category['id'] == '1')
        echo '<li role="presentation" class="active">
                <a href="#' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a>
              </li>';
      else
        echo '<li role="presentation">
                <a href="#' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a>
              </li>';
    }
    echo '</ul>
      </nav>
      ';

    echo '<div class="tab-content">';

    // DYNAMIC MENU
    foreach ($categories as $category) {
      if ($category['id'] == '1')
        echo '<div class="tab-pane active" id="' . $category['id'] . '">
        ';
      else
        echo '<div class="tab-pane" id="' . $category['id'] . '">
      ';
      echo '<div class="row">
      ';

      $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
      $statement->execute(array($category['id']));

      // GET ALL ITEMS FROM DB IN CATEGORIES AND DISPLAY ON WEBPAGE
      while ($item = $statement->fetch()) {
        echo '<div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="/2021_03_20_site_burger/img/' . $item['image'] . '" alt="..." />
                  <div class="price">' . number_format($item['price'], 2, '.', '') . ' €</div>
                  <div class="caption">
                    <h4>' . $item['name'] . '</h4>
                    <p>' . $item['description'] . '
                    </p>
                    <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>
                      Commander</a>
                  </div>
                </div>
              </div>';
      }
      echo '</div>
      </div>';
    }
    Database::disconnect();
    echo '</div>';

    ?>
  </div>
</body>

</html>