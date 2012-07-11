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

$title=$fields['title']->content ;
$image=(isset($fields['field_stlab_listimage']->content))?$fields['field_stlab_listimage']->content:$fields['field_stlab_mainimage']->content ;
$theme=(isset($fields['field_stlab_theme']->content))?$fields['field_stlab_theme']->content:NULL ;
$strand=(isset($fields['field_stlab_strand']->content))?$fields['field_stlab_strand']->content:NULL ;
$summary="<p>".$fields['field_stlab_summary']->content."</p>";
$place=$fields['field_stlab_place']->content ;


$event_type=($fields['field_stlab_eventtype']->content!=NULL)?' // '.$fields['field_stlab_eventtype']->content:"" ;
$predate=explode(",",strip_tags($fields['field_stlab_eventdate']->content ));

 //Check if the result is type open call or Project.
 $type=($fields['type']->content);
 $types_special=array("Open Call","Project");
 if (in_array($type,$types_special)):
     $predate=explode(",",strip_tags($fields['field_stlab_duration']->content ));
    
     $special_type='// <span class="blue-title ">'.$type.'</span>';
     
 endif;

$organizer=($fields['field_stlab_org']->content!=NULL)?$fields['field_stlab_org']->content:"" ;
     $days_length=count($predate);
     
     $final_day=str_replace(" ", "", $predate[($days_length-1)]);
     $from_date=format_date($predate[0],'short_notime');
    
 $to_date=($days_length>1)?" to ".format_date( $final_day,'short_notime'):NULL;
 

?>

    
    
    
    
    
          <div class="assets-list">
         
          
               <?php print $image; ?>  
                <div class="theme-icons">
                
               <?php print $theme; ?>  
               
               </div>
              <div class="taxos"><span class="data"><?php print $organizer;?><?php print $special_type;?><?php print $event_type; ?></span></div>	      
                
                <h2 class="list"> <?php print $title; ?>  </h2>
                <div class="taxos"><span class="data"><span class="data"><?php echo $from_date ?>
		<?php echo $to_date ?> </span></div>
               
                
            </div>
