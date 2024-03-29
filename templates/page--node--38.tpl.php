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
    if (arg(1)==38){
               
         $block_title=t("Partners"   );
     $viewName='element_list';
     $display_id='block_4';
     $myArgs=array ($node->nid);
     
     //$myArgs=$argumentos_para_view;
     $view = views_get_view($viewName);
     $view->set_display($display_id);
     //$view->set_arguments($myArgs);
     //$view->init_display();
     $view->execute();
     $render_partners=$view->render();
     
     }
     
       if (arg(1)==12){
               
        $block_title=t("Prototyping");
     $viewName='element_list';
     $display_id='prototyping';
     $myArgs=array ($node->nid);
     
     //$myArgs=$argumentos_para_view;
     $view = views_get_view($viewName);
     $view->set_display($display_id);
     //$view->set_arguments($myArgs);
     //$view->init_display();
     $view->execute();
     $render_prototyping=$view->render();
     
     }
    
     
?>

    
   

      
   <?php $image_uri = render($node_content['field_stlab_mainimage']);?>

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
                <article>
                <h1 class="site-page-title"> <?php print $title; ?> </h1>
                              
                <?php print render($node_content['field_stlab_theme']); ?> <?php print render($node_content['field_stlab_strand']); ?>
                <br/>
                
                <?php print render($node_content['field_stlab_hashtag']); ?>
               <p class="intro-text"><?php print render($node_content['field_stlab_summary']); ?></p>
                 <?php  print $service_links;  ?>
                </div>
                
                
                <?php print $image_uri ?>
            </div>
             <div class="clearfix"></div>
        </div>
        
        </div>
        <div class="full-width">
         <div class="centered">
            <div id="project-contents" class="site-pages partners">
               
                <br/>
                <div class="content">
                <?php print render($node_content['body']); ?>
                </div>
                </article>                   
            </div>
           <div class="clearfix"></div>
            <div id="partners">
            <?php print ($view->result!=NULL)?'<span class="title">'.$block_title."</span>":"";?>
              <ul>
               <?php print $render_partners;  ?>
               <?php print $render_prototyping;  ?>
              </ul>
            <div>     
        <div class="clearfix"></div>  
         </div>
        </div>
    </div>

    
    




















