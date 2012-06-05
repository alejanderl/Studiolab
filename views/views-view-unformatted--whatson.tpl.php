<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<style>

#lateral {
display:none;	
}
#content {
width:100%;	
}


</style>

<?php
  $diacomparar_antes="";
  $diacomparar_antes2="";
  $puntitos=0;
  $separacion=3;
  $filas=$variables['view']->result;

  foreach ($rows as $id => $row): 
  $separacion++;
  if($separacion%4==0): ?>
    <div class="clearfix"></div>
    
    
 

<?php
  /**
   *$filas is an array with the results of the view
   */
  for ($n=0;$n<4;$n++): 

 $diacomparar=date ("z",$filas[$puntitos+$n]->field_field_stlab_eventdate[0]['raw']['value']);?>

<?php

if($diacomparar!=$diacomparar_antes&&$diacomparar): ?>
<div class="separar"></div>
    <div class="whatson-vacio">
                                <div class="whatson-dia"><?= format_date($filas[$puntitos+$n]->field_field_stlab_eventdate[0]['raw']['value'],'custom',"l, j"); ?></div>
    
    </div>
<?php else: ?>
<div class="whatson-vacio"></div>

<?php endif; ?>
<?php $diacomparar_antes = $diacomparar;?>
<?php endfor;?>
   
    <div class="clearfix"></div>
<?php endif; ?>
<?php $diacomparar2=date("z",$filas[$puntitos]->field_field_stlab_eventdate[0]['raw']['value']);
if($diacomparar2!=$diacomparar_antes2):?>

<div class="separador-dias separar"></div>
<?php endif; ?>
    <?php
	$puntitos++;
	$diacomparar_antes2=$diacomparar2;
	
	print $row;
	?>

<?php endforeach; ?>
<div class="clearfix"></div>

 
