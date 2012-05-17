<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php
    $contador=0;
    foreach ($rows as $id => $row): ?>
  
    <?php
     $contador++;
    print $row;
    
    if($contador==4):
        $contador=0;
        ?>
        <div class="clearfix"></div>
<?php endif ?>
<?php endforeach; ?>
