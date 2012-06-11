<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

?>



<?php

 $from_date=format_date($fields['field_stlab_eventdate']->content,'short_notime');
 $to_date=($fields['field_stlab_eventdate']->content!=$fields['field_stlab_eventdate_1']->content)?" to ".format_date($fields['field_stlab_eventdate_1']->content,'short_notime'):NULL;
 
  $title=$fields['title']->content;
  $summary="<p>".$fields['field_stlab_summary']->content."</p>";
  //$hashtag=render($content['field_stlab_hashtag']);
 $image=(isset($fields['field_stlab_listimage']->content))?$fields['field_stlab_listimage']->content:$fields['field_stlab_mainimage']->content ;

  $event_type=$fields['field_stlab_eventtype']->content ;
  //$theme=field_view_value('node',$node,'field_stlab_theme');//$content['field_stlab_theme']['und'][0]['tid'];
  
$place=$fields['field_stlab_place']->content ;

?>


 <div class="assets-list">
        
        
       

        
        
       
         
          
          
                <?php print $image; ?>
                
                <div class="theme-icons"><?php print ($fields['field_stlab_theme']->content);?></div>
		<div class="taxos"><span class="data"><?= $place;?><b>//</b><?= $event_type; ?></span></div>	      
                <h2 class="list"><?php echo $title; ?>//</h2>
                <div class="taxos"><span class="data"><span class="data"><?php echo $from_date ?>
		<?php echo $to_date ?> </span></div>
                
            

 </div><!-- fin whatson -->




