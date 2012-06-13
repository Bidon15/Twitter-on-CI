<h2><?php echo $title ?></h2>
<?php echo $links;
      foreach($results as $data):?>

<div id="main">
    <p>

<?php echo anchor('users/show/'.$data->id,$data->username);
      echo "<br>";
      ?></p></div>

<?php endforeach;?>