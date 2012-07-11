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



//$argumentos_para_view= implode (',',$nodepasafotos);
    
     $viewName='element_list';
     $display_id='page';
     $myArgs=array ($node->nid);
     
     //$view for upcoming events
     $view = views_get_view($viewName);
     $view->set_display($display_id);
     $view->set_arguments($myArgs);
     $view->execute();

     $eventsIdsrelated=array();
     /**
      *Need to get the ids of all related nodes to look for all the media assets related to the project.
     */
     
     
     
     $view_pastEvents= views_get_view($viewName);
     $view_pastEvents->set_display('past_event_list');
     $view_pastEvents->set_arguments($myArgs);
     $view_pastEvents->execute();    
     $render_pastEvents=$view_pastEvents->render();
     
     foreach($view->result as $event ){
         
        array_push($eventsIdsrelated,$event->nid);
     }
     foreach($view_pastEvents->result as $event ){
         
        array_push($eventsIdsrelated,$event->nid);
     }
        array_push($eventsIdsrelated,$node->nid);
        
    $eventsIdsrelated=implode("+",$eventsIdsrelated);

     $view_opencalls = views_get_view($viewName);
     $view_opencalls->set_arguments(array($eventsIdsrelated));
     $view_opencalls->set_display("block_2");
     $view_opencalls->execute();
     $render_opencalls=$view_opencalls->render();
?>
<?php

       //print $view_assets->render();
       $view_assets = views_get_view($viewName);
    $view_assets->set_arguments(array($eventsIdsrelated));
    $view_assets->set_display("block_1");
    $view_assets->execute();
    $render_assets=$view_assets->render();
     
     
       ?>
      
      
   <?php
   $image_uri = render($node_content['field_stlab_mainimage']);
   $from_date=(isset($node->field_stlab_duration['und']['0']['value']))?sprintf ("%s %s <br />",t("From"),format_date( $node->field_stlab_duration['und']['0']['value'],"long_no_time")):"";
   $to_date=(isset($node->field_stlab_duration['und']['0']['value2']))?sprintf (" %s %s",t("to"),format_date( $node->field_stlab_duration['und']['0']['value2'],"long_no_time")):"";
   //$image_title=($node_content['field_stlab_mainimage']['#items'][0]['title']);
   
   
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
                
                 <div id="title-themes"><?php print render($node_content['field_stlab_theme']); ?> </div>
                 <br/>
                 <h1 class="project-title"> <?php print $title; ?> </h1>
                     <span class="content-type"><a href="<?php print url("projects/all");?>">Project</a></span>
                     <?php print $strand; ?>
                     <?php print $place; ?>
                     <?php print $organizer;?>
                     
                <div class="date_range">               
                <?php print $from_date?><?php print $to_date?> 
                </div>
                     <?php print $URL_associated;?>
                     <?php print $hashtag; ?>
                     <?php print $admission; ?>
                     <?php  print $service_links;  ?>
                </div>                
                <?php print $image_uri ?>
                
            </div>
             <div class="clearfix"></div>
        </div>
        <div class="project-separator">
            <div class=" centered">
                <span class="about">About this project</span>
                <span class="rss-ical">
                    <?php print $rssURL ?>
                    <?php print $icalURL ?>
               </span>
            </div>
        </div>
        <div class="full-width">
         <div class="centered">
            <div id="project-contents">
               
                <br/>
                <div class="content expandable">
                <p class="intro-text-inline"><?php print render($node_content['field_stlab_summary']); ?></p>
                <?php print render($node_content['body']); ?>
                </div>
                                  
            </div>
            <div id="project-timeline">
            <?php  print ($view->result!=NULL)?'<span class="title no-line">'.t('Upcoming events')."</span>":"";?>
              <ul>
               <?php print $view->render();  ?>
              </ul>
 
             <div id="related-assets">
             
                <?php  print ($view_assets->result!=NULL)?'<span class="title">'.t('Related assets')."</span>":"";?>
                <ul>
                <?php print $render_assets;?>
                </ul>
             </div>
             
             <div id="related-opencalls">
                 <?php  print ($view_opencalls->result!=NULL)?'<span class="title">'.t('Related open calls')."</span>":""; ?>
                 <ul>
                 <?php  print $render_opencalls;?>
                 </ul>
             </div>
             
                <div id="past-events">
                 <?php  print ($view_pastEvents->result!=NULL)?'<span class="title">'.t('Events archive')."</span>":""; ?>
                 <ul>
                 <?php  print $render_pastEvents;?>
                 </ul>
             </div>
            <div>     
        
         </div>
        </div>
    </div>
<div class="clearfix"></div>  
    
    




















