<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 *///miKrumo($variables['view']->result);
?>

<?php foreach ($rows as $id => $row): ?>

    <?php print $row;   ?>
 
<?php endforeach; ?>
