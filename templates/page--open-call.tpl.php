<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['navigation']: Items for the navigation region, below the main menu (if any).
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>

 <?php
  $image_uri = render($node_content['field_stlab_mainimage']);
  $hashtag=(isset($node_content['field_stlab_hashtag']))?sprintf ( '%s  <br/>',render($node_content['field_stlab_hashtag'])):"";;
  $strands=(isset($node_content['field_stlab_strand']))?sprintf ('<span class="date">%s</span>    <br/>  ' ,render($node_content['field_stlab_strand'])) :"" ;      
  $themes=(isset($node_content['field_stlab_theme']))?sprintf ('<span class="date">%s</span>    <br/>  ' ,render($node_content['field_stlab_theme'])) :"" ;      
  $from_date=(isset($node->field_stlab_duration['und']['0']['value']))?sprintf ("%s %s <br />",t("From"),format_date( $node->field_stlab_duration['und']['0']['value'],"long_no_time")):"";
  $to_date=(isset($node->field_stlab_duration['und']['0']['value2']))?sprintf (" %s %s",t("to"),format_date( $node->field_stlab_duration['und']['0']['value2'],"long_no_time")):"";
  
 /**
  *Beginning of logic blocks
  * - $view           Object for events variables.
  * - $view_opencalls Object with opencalls related to the project or any of the events wich belongs to it.
  * - $view_assets    Object with media assets related to the project or any of the events wich belongs to it.
  */
    $viewName='element_list';
    $display_id='page';
    $myArgs=array ($node_content['field_stlab_relproject']['#items']['0']['nid'],$node->nid);    
    //$myArgs=$argumentos_para_view;
    $view = views_get_view($viewName);
    $view->set_arguments($myArgs);
    $view->set_display($display_id);
    $view->execute();    
    $view_opencalls = views_get_view($viewName);
    $view_opencalls->set_arguments(array($node->nid));
    $view_opencalls->set_display("block_2");
    $view_opencalls->execute();
  ?>
   <div id="related-opencalls">
    <?php  print ($view_opencalls->result!=NULL)?'<span class="title">'.t('Opencalls')."</span>":"";?>
     <ul>
          <?php //print $view_opencalls->render();  ?>       
     </ul>
     </div>
<?php
    
     $viewName='element_list';
     $display_id='block_3';
     $myArgs=array($node_content['field_stlab_relproject']['#items']['0']['nid']);
     
     
     $view_event_belonged= views_get_view($viewName);
     $view_event_belonged->set_arguments($myArgs);
     $view_event_belonged->set_display($display_id);
     $view_event_belonged->execute();
     
     
     $arg_project=$view_event_belonged->result[0]->field_field_stlab_relproject[0]["raw"]['nid'];
     
     $view_project_belonged= views_get_view($viewName);
     $view_project_belonged->set_arguments($arg_project);
     $view_project_belonged->set_display($display_id);
     $view_project_belonged->execute();
     
     $eventsIdsrelated=array();
     /**
      *Need to get the ids of all related nodes to look for all the media assets related to the project.
     */
     foreach($view_event_belonged->result as $event ){
         
        array_push($eventsIdsrelated,$event->nid);
     }
        
        
        $eventsIdsrelated=implode("+",$eventsIdsrelated);
        ?>

<?php print ($is_admin)?$messages:""; ?>
<?php print render($tabs); ?>
<?php print render($page['help']); ?>
<?php if ($action_links): ?>
  <ul class="action-links"><?php print render($action_links); ?></ul>
<?php endif; ?>
    
    <div class="clearfix"></div>        
    <div id="mainBody" style="min-height:20px;width:100%; ">
        <div class="centered">
       
            <div id="project-header">
                <div id="ph-left">
                <div id="title-themes"><?php print render($node_content['field_stlab_theme']); ?> </div><br/>
                <h1 class="project-title"> <?php print $title; ?> </h1>

                     <?php print $call_type ; ?>
                     <?php print $event_type ; ?>
                     
                     <?php print $strand; ?>                
                     <?php print $place; ?>
                     <?php print $organizer; ?>
                     <div class="date_range">               
                     <?php print $from_date?><?php print $to_date?> 
                     </div>
                     <?php print $hashtag; ?>
                     <?php print $admission; ?>
                     <?php  print $service_links;  ?>

                

                </div>               
                <?php print $image_uri ?>
            </div>
            <div class="event-separator clearfix">
                </div>
            <div id="event-contents">
                <br/>
                <div class="content expandable">
                <p class="intro-text-inline"><?php print render($node_content['field_stlab_summary']); ?></p>
                <?php print render($node_content['body']); ?>
                </div>
            </div>

            <div id="project-timeline">
             <?php // print $render_opencalls;?>
                
              <div id="related-assets">
               <span class="title"><?php print t('Belongs to:')?></span>
               <ul>
               <h3><?php print l($view_project_belonged->result[0]->node_title,"node/".$arg_project); ?></h3>
               <?php print $view_event_belonged->render(); ?>
               </ul>
              </div>
              <span class="others"><?php print ($view->result!=NULL)?'<span class="title">'.t('Other related events')."</span>":""; ?>  </span>
              <ul>
             <?php print $view->render(); // Print Related events ?>       
                </ul>
            
       </div>
    </div>
    <div class="clearfix"></div> 
