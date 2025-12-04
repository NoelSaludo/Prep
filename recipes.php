<?php
// sample server data (replace with DB query)
$recipes = [
  ['id'=>1,'title'=>'Spicy Tomato Pasta','image'=>'/images/pasta.jpg','time'=>'25 min','difficulty'=>'Easy','tags'=>['pasta','vegetarian']],
  ['id'=>2,'title'=>'Honey Garlic Salmon','image'=>'/images/salmon.jpg','time'=>'30 min','difficulty'=>'Medium','tags'=>['fish','gluten-free']],
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Recipes</title>
  <link rel="stylesheet" href="./css/recipes.css">
</head>
<body>
  <main class="container">
    <h1>Recipes</h1>
    <div id="recipe-grid" class="recipe-grid" aria-live="polite"></div>
  </main>

  <script>
    window.recipes = <?php echo json_encode($recipes, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
  </script>
  <script src="./js/recipes.js"></script>
</body>
</html>