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
 

   

    <?php if ($site_name || $site_slogan): ?>
      <hgroup id="name-and-slogan">
        <?php if ($site_name): ?>
          <h1 id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup><!-- /#name-and-slogan -->
    <?php endif; ?>

  
 




    <header id="header" role="banner">
        <div id="header-centered" class="centered">
            <div id="top-menu">
                
                
                <ul id="menu-globes" class="ubuntu-400">
                   
                    
                </ul>
                
                
                <ul id="menu-static" class="ubuntu-400">
                    <li>
                        studiolab/
                    </li>
                    <li>
                        themes/
                    </li>
                    <li>
                        strands/
                    </li>
                    <li>
                        blogs/
                    </li>
                    <li>
                        contact/
                    </li>
                     <li>
                        what's on/
                    </li>
                    <li>
                        community/
                    </li>
                </ul>
                
    
                
                <div class="clearfix"></div>
            </div><!-- //top-menu -->
            
            <div id="topmid-menu">
            
                <div id="logo">
                    <img src="<?= $base_path.$directory; ?>/images/logoStudiolab.png" height="74" width="293"/>
                </div>
                <div id="big-menu">
                    <ul id="all">
                        <li><a href="#">ALL</a></li>
                    </ul>
                    <br/>
                      <ul id="blue-menu">
                        <li><a href="#" class="big-blue-menu">WATER</a></li>
                        <li><a href="#" class="big-blue-menu">BIOLOGY</a></li>
                        <li><a href="#" class="big-blue-menu">SOCIAL INTERACTION</a></li>
                    </ul>
                    
                      <?php if ($secondary_menu): ?>
      <nav id="secondary-menu" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => $secondary_menu_heading,
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>
    <?php endif; ?>

                   
                                       
                </div>
                
                <div class="clearfix"></div>                 
                
            </div>
        
        </div>
           <?php print render($page['header']); ?>
    </header>  <!-- header -->
    
      <div id="big-slider">
        <div id="big-slider-centered"  >
              <ul id="big-slide-list">
                   <?php //$argumentos_para_view= implode (',',$nodepasafotos);
                $viewName='home_page';
                $display_id='default';
                $myArgs="";
                //$myArgs=$argumentos_para_view;
                print views_embed_view($viewName, $display_id, $myArgs);               
                ?>
              </ul>
        </div>
      </div>
      
    <div id="search-twitter">
        <div class="centered">
            <form action="#" method="post" class="floatLeft">
                <input type="text" id="search-text"><INPUT type="submit" value="Send">
            </form> 
            <div id="socialIcons" class="floatRight">
             <a href="http://twitter.com/" alt="Twitter Auditorio Tenerife" title="Twitter Auditorio de Tenerife"  id="logotwitterPortada" target="_blank" > <span> Twitter </span></a>
             <a href="http://www.facebook.com/" alt="Facebook Auditorio de Tenerife" title="Facebook Auditorio de Tenerife"  id="logoFacebookPortada" target="_blank"> <span> Facebook </span></a>
             <a href="http://www.flickr.com/photos/" alt="Flickr Auditorio de Tenerife" title="Flickr Auditorio de Tenerife"  id="logoFlickrPortada" target="_blank" > <span> Flickr </span></a>
             <a href="http://www.youtube.com/user/" alt="YouTube  Auditorio de Tenerife" title="YouTube  Auditorio de Tenerife"  id="logoYouTubePortada" target="_blank" > <span> YouTube </span></a>
             <a href="/rss.xml" alt="RSS" title="RSS"  id="logoRssPortada" target="_blank"> <span> RSS </span></a>
           </div> 
        </div>
          <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
    </div>
    <div class="clearfix"></div>        
    <div id="mainBody" style="min-height:20px;width:100%; ">
        <div class="centered">
        
        
        </div>
    </div>
    <div class="clearfix"></div>  
    <div id="footer">
        <div id="studioLabText" class="centered">
         <img src="images/logoStudiolab.png" height="37" width="146"/> For Information: Science Gallery, Trinity College Dublin, Pearse St, Dublin 2, Ireland+353 1 896 4091	     info@sciencegallery.com	        www.sciencegallery.com
        </div>
        <div id="sevencapacitiesText" class="centered">
             <img src="images/7capacities.png" height="46" width="59"/> For Information: Science Gallery, Trinity College Dublin, Pearse St, Dublin 2, Ireland+353 1 896 4091	     info@sciencegallery.com	        www.sciencegallery.com
        
        </div>
    </div>
    



















