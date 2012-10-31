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
/*
$title=$fields['title']->content ;
$image=$fields['field_stlab_mainimage']->content ;
*/
$place=(isset($fields['field_stlab_place']->content))?$fields['field_stlab_place']->content:"" ;
//$predate=explode(",",strip_tags($fields['field_stlab_eventdate']->content ));
$date="";//format_date($predate[0],"short");

//$hashtag=$fields['field_stlab_hashtag ']->content;
$theme=(isset($fields['field_stlab_theme']->content))?$fields['field_stlab_theme']->content:NULL ;

 $summary="<p>".$fields['field_stlab_summary']->content."</p>";
 $path=$fields['path']->content ;
 $city=$fields['field_trm_location']->content;
 $organizer=($fields['field_stlab_org']->content!=NULL)?$fields['field_stlab_org']->content:"" ;
 $place=(isset($fields['field_stlab_place']->content))?sprintf('<div class="data water-spot" > %s  </div> ',$place ):""; 
$predate=explode(",",strip_tags($fields['field_stlab_eventdate']->content ));
$date=format_date($predate[0],"short_notime");
 $days_length=count($predate);
     
     $final_day=str_replace(" ", "", $predate[($days_length-1)]);
     $from_date=($days_length>1)?"From ".format_date($predate[0],'short_notime'):format_date($predate[0],'short_notime');
    $organizer=($fields['field_stlab_org']->content!=NULL)?$fields['field_stlab_org']->content:"" ;
 
 $to_date=($days_length>1)?" to ".format_date( $final_day,'short_notime'):NULL;
        


?>

 <li>
     
     
              <span class="data"><?php //print $theme; ?><?php print $organizer ?></span>        
         <h3 ><a href="<?php print $path; ?>"><?php print $summary; ?></a></h3>
         <div class="taxos"><span class="data"><?php echo t("Next")." ".$from_date ?><?php echo $to_date ?> </span></div>


</li>



