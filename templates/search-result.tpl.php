<?php

/**
 * @file
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Default keys within $info_split:
 * - $info_split['type']: Node type (or item type string supplied by module).
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 *
 * Other variables:
 * - $classes_array: Array of HTML class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $title_attributes_array: Array of HTML attributes for the title. It is
 *   flattened into a string within the variable $title_attributes.
 * - $content_attributes_array: Array of HTML attributes for the content. It is
 *   flattened into a string within the variable $content_attributes.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for its existence before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 * @code
 *   <?php if (isset($info_split['comment'])): ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 * @endcode
 *
 * To check for all available data within $info_split, use the code below.
 * @code
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 * @endcode
 *
 * @see template_preprocess()
 * @see template_preprocess_search_result()
 * @see template_process()
 */
?>
<?php
$node=$result['node'];

$title= '<a href="'. $url.'">'.$title.'</a>';
$image=(isset($fields['field_stlab_listimage']->content))?$fields['field_stlab_listimage']->content:$fields['field_stlab_mainimage']->content ;
$theme=(isset($fields['field_stlab_theme']->content))?$fields['field_stlab_theme']->content:NULL ;
$strand=(isset($fields['field_stlab_strand']->content))?$fields['field_stlab_strand']->content:NULL ;
$summary="<p>".$snippet."</p>";
$place=$fields['field_stlab_place']->content ;
$predate=explode(",",strip_tags($fields['field_stlab_eventdate']->content ));
$date=format_date($predate[0],"short");
 $image_uri=image_style_url('225x90imagelist', $node->field_stlab_mainimage['und'][0]['uri']);
  $image_list=theme('image-style', array('style_name' => '225x90imagelist', 'path' => file_build_uri($image_uri )));
 ?>

    
    
    
    
    
          <div class="assets-list">
         
          
               <a href="<?= $url ?>"><img src="<?= $image_uri; ?>" /></a>
               
                <div class="theme-icons">
                
               <?= $theme; ?>  
               
               </div>
              
                <h2 class="list"> <?= $title; ?>  </h2>
                <?= $summary ?>
                <?= $place ?>
                
            </div>





