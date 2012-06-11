<?php
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
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php

$pre_type=ContentType2Print($fields['type']->content);
$type=($pre_type!=NULL) ? "<span>". $pre_type." </span> ":NULL ;
$title=$fields['title']->content ;
$image=$fields['field_stlab_mainimage']->content ;
$place=$fields['field_stlab_place']->content ;
$predate=explode(",",strip_tags($fields['field_stlab_eventdate']->content ));
$date="";
$hashtag=(isset($fields['field_stlab_hashtag']))?sprintf(' <strong>/</strong> <span class="hash">%s</span>',$fields['field_stlab_hashtag']->content) :"";
$theme=(isset($fields['field_stlab_theme']->content))?$fields['field_stlab_theme']->content:NULL ;
 $city=$fields['field_trm_location']->content;
?>

 <li>
            
      <?= $image; ?>
     <div class="inner-text">
     <?php print ($fields['promote_node']->content);?>   
     <?php // print flag_create_link('preomoto_to_frontpage', $fields['nid']->raw); ?>
         <div class="theme-home" ><?= $theme; ?> </div></h2> <h2 ><?= $title; ?></h2><br/>
          
   
         
         <div class="dates water-spot" ><?= $type; ?> <?= $place; ?> <?= $city; ?> <?= $date; ?> </div>
     </div>
</li>



