<h1> Hello, world </h1>

<?php //echo $name; ?>

<?php foreach ($posts as $post):  ?>
    <h3> <?= $post['title'] ?> </h3>
<?php endforeach; ?>
