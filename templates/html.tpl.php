<?php
/**
 * @file
 * Zen theme's implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation. $language->dir
 *   contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $html_attributes: String of attributes for the html element. It can be
 *   manipulated through the variable $html_attributes_array from preprocess
 *   functions.
 * - $html_attributes_array: Array of html attribute values. It is flattened
 *   into a string within the variable $html_attributes.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $default_mobile_metatags: TRUE if default mobile metatags for responsive
 *   design should be displayed.
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $skip_link_anchor: The HTML ID of the element that the "skip link" should
 *   link to. Defaults to "main-menu".
 * - $skip_link_text: The text for the "skip link". Defaults to "Jump to
 *   Navigation".
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can contain one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a Blog entry, this would be "node-type-blog".
 *     Note that the machine name of the content type will often be in a short
 *     form of the human readable label.
 *   The following only apply with the default sidebar_first and sidebar_second
 *   block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see zen_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>

  <?php if ($default_mobile_metatags): ?>
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width">
  <?php endif; ?>
  <meta http-equiv="cleartype" content="on">

  <?php print $styles; ?>
  <?php print $scripts; ?>
 
  <?php $is_front_page=drupal_is_front_page(); ?>

  <?php if ($add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5-respond.js"></script>
    <![endif]-->
  <?php elseif ($add_html5_shim): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5.js"></script>
    <![endif]-->
  <?php endif; ?>
     <script src="<?php print $base_path .$directory; ?>/css/Studiolab-css/FullScreenSlider.css"></script> 

<link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
<?php if($is_front_page): ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="<?php print $base_path .$directory; ?>/js/FullScreenSlider.js?random=<?php echo rand(3,89898);?>"></script>
  <script type="text/javascript" >
    $(document).ready (function (){
								 //div afected, transitiontime, stop time
        themainID=new sliderFront ("#big-slider-centered",1000,2000);
         });
</script>
<?php endif; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<div id="top-menu">
  <div class="centered">

                
                <?php
        $block = module_invoke('superfish', 'block_view', 1);
        print render($block['content']);
        //print render($block);
      ?>
      </div>
      
      
    
    
    
                
                <div class="clearfix"></div>
</div><!-- //top-menu -->



<header id="header" role="banner">
        <div id="header-centered" class="centered">
            
            
            <div id="topmid-menu">
            
                <div id="logo">
                    <a href="<?= $base_path; ?>"><img src="<?= $base_path.$directory; ?>/images/logoStudiolab.png" height="74" width="293"/></a>
                </div>
                <div id="big-menu">
                <nav>
                <ul class="oswald-bold">
                <li><a href="<?= $base_path; ?>projects/food"><div class="theme menu theme-food "></div><span>Food </span></a></li>
                <li><a href="<?= $base_path; ?>projects/water"><div class="theme menu theme-water "></div><span>Water </span></a></li>
                <li><a href="<?= $base_path; ?>projects/biology"><div class="theme menu theme-biology "></div><span>Biology </span></a></li>
                <li><a href="<?= $base_path; ?>projects/social-interaction"><div class="theme menu theme-social-interaction "></div><span>Social Interaction </span></a></li>
                <li><a href="<?= $base_path; ?>projects/all"><span>All</span></a>
                </ul>
                    
                      <?php
                          /*
                          $block2 = module_invoke('menu', 'block_view', 'menu-projects-menu');
                          print render($block2['content']);
                          //print render($block);//*/
                        ?>
                    </nav>
                      


                   
                                       
                </div>
                
                <div class="clearfix"></div>                 
                
            </div>
        
        </div>
           <?php //print render($page['header']); ?>
    </header>  <!-- header -->

  <?php if(!$is_front):?>
     <div id="search-twitter">
        <div class="centered">

            <div id="socialIcons" class="floatRight">
             <a href="http://twitter.com/" alt="Twitter Auditorio Tenerife" title="Twitter Auditorio de Tenerife"  id="logotwitterPortada" target="_blank" > <span> Twitter </span></a>
             <a href="http://www.facebook.com/" alt="Facebook Auditorio de Tenerife" title="Facebook Auditorio de Tenerife"  id="logoFacebookPortada" target="_blank"> <span> Facebook </span></a>
             <a href="http://www.flickr.com/photos/" alt="Flickr Auditorio de Tenerife" title="Flickr Auditorio de Tenerife"  id="logoFlickrPortada" target="_blank" > <span> Flickr </span></a>
             <a href="http://www.youtube.com/user/" alt="YouTube  Auditorio de Tenerife" title="YouTube  Auditorio de Tenerife"  id="logoYouTubePortada" target="_blank" > <span> YouTube </span></a>
             <a href="/rss.xml" alt="RSS" title="RSS"  id="logoRssPortada" target="_blank"> <span> RSS </span></a>
           </div>
                   <div id="search-block">
             <?php  print drupal_render(drupal_get_form('search_form'));?>
              </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endif;?>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <div id="footer">
        <div id="studioLabText" class="centered">
         <img src="<?= $base_path.$directory; ?>/images/logoStudiolab.png" height="37" width="146"/> <p>For Information: Science Gallery, Trinity College Dublin, Pearse St, Dublin 2, Ireland+353 1 896 4091	     info@sciencegallery.com	        www.sciencegallery.com</p>
        </div>
        <div id="sevencapacitiesText" class="centered">
             <img src="<?= $base_path.$directory; ?>/images/7capacities.png" height="46" width="59"/> <p>For Information: Science Gallery, Trinity College Dublin, Pearse St, Dublin 2, Ireland+353 1 896 4091 info@sciencegallery.com   www.sciencegallery.com</p>
        
        </div>
    </div>
</body>
</html>
