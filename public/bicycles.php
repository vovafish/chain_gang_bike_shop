<?php require_once('../private/initialize.php'); ?>

<?php 
$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = Bicycle::count_all();
  
$pagination = new Pagination($current_page, $per_page, $total_count);

$sql = "SELECT * FROM bicycles ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$bikes = Bicycle::find_by_sql($sql);
?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/AdobeStock_55807979_thumb.jpeg') ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Condition</th>
        <th>Price</th>
        <th>&nbsp;</th>
      </tr>

<?php

//$bikes = Bicycle::find_all();

?>
      <?php foreach ($bikes as $bike) { ?>
      
      <tr>
        <td><?php echo h($bike->brand); ?></td>
        <td><?php echo h($bike->model); ?></td>
        <td><?php echo h($bike->year); ?></td>
        <td><?php echo h($bike->category); ?></td>
        <td><?php echo h($bike->gender); ?></td>
        <td><?php echo h($bike->color); ?></td>
        <td><?php echo h($bike->weight_kg()) . ' / ' . h($bike->weight_lbs()); ?></td>
        <td><?php echo h($bike->condition()); ?></td>
        <td>$<?php echo h($bike->price); ?></td>
        <td><a href="detail.php?id=<?php echo $bike->id ?>">View</a></td>
      </tr>
      <?php } ?>
    </table>

    <?php 
        $url = url_for('/bicycles/index.php');
        echo $pagination->page_links($url);
    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
