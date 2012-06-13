<h2><?php echo $title ?></h2>
<?php foreach ($username as $row): ?>

<div id="main">
    <p>

<?php echo anchor('users/show/'.$row['id'],$row['username']);?></p></div>

<?php endforeach ?>