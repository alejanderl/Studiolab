<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   STARTERKIT_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: STARTERKIT_field()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
}
// */


 function user_is_admin(){
	global $user;
	$adminRoles= array('administrador','administrator');
	$check = array_intersect($adminRoles, array_values($user->roles));
	
	//krumo($user);
	
	$adminAble = empty($check) ? FALSE : TRUE;
	return $adminAble;

    } 
 function miKrumo($var){
	if(!user_is_admin()) return false;
		
		if (!function_exists('krumo')){
			
	 include_once  drupal_get_path('module', 'devel'). '/krumo/class.krumo.php';
			}
	krumo($var);
	
  }//*/


/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */

function Studiolab_preprocess_html(&$variables, $hook) {
  
  if(arg(0)=="feed"||arg(0)=="term-feeds"){
    //miKrumo($variables);
     $variables['theme_hook_suggestions'][]='html__rss';
    
  }
  if(arg(0) == 'node' ) {
  $variables['node'] = node_load(arg(1));
  
}
 if(arg(0) != 'node' ){$variables['index_follow'] = '<meta name="robots" content="noindex,follow">';}


  

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

function search_form_alter (&$form, &$form_state, $form_id){
    miKrumo($form);
    
}

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function Studiolab_preprocess_page(&$variables) {
  $nid = arg(1);
  
  if(arg(0)=="taxonomy"){
    drupal_goto($base_path);
  }
  if (arg(0) == 'node' && is_numeric($nid)) {
    
   if (isset($variables['page']['content']['system_main']['nodes'][$nid])) {
     $variables['node_content'] = & $variables['page']['content']['system_main']['nodes'][$nid];
     $node_content=$variables['node_content'];
     $variables['call_type']=sprintf ( '<p class="event-pre-title"><span class="content-type"><a href="/opencalls/all">%s</a></span>  %s  </p>',t("Open call"),"");
     $variables['related_project']=(isset($node_content['field_stlab_relproject']))?sprintf ( '<p class="project-related"><span class="title">%s</span>:%s  </p>',t("Project"),render($node_content['field_stlab_relproject'])):"";
     $variables['event_type']=(isset($node_content['field_stlab_eventtype']))?sprintf ( '<p class="event-pre-title"><span class="content-type"><a href="/events/all")>Event</a></span> / %s  </p>',render($node_content['field_stlab_eventtype'])):"";
     $variables['place']=(isset($node_content['field_stlab_place']))?sprintf ( '<p class="place"><span class="title">%s</span>:%s  </p>',t("Venue"),render($node_content['field_stlab_place'])):"";
     $variables['strand']=(isset($node_content['field_stlab_strand'][0]))?sprintf ( '<p class="place"><span class="title">%s</span>:%s  </p>',t("Strands"),render($node_content['field_stlab_strand'])):"";
     $variables['organizer']=(isset($node_content['field_stlab_org']))?sprintf ( '<p class="place"><span class="title">%s</span>:%s  </p>',t("Organizer"),render($node_content['field_stlab_org'])):"";
     $variables['URL_associated']=(isset($node_content['field_stlab_link']))?sprintf ( '<p class="place">%s  </p>',render($node_content['field_stlab_link'])):"";
     $variables['hashtag']=(isset($node_content['field_stlab_hashtag']))?sprintf ( '%s  <br/>',render($node_content['field_stlab_hashtag'])):"";;
     $variables['admission']=(isset($node_content['field_stlab_admission']))?sprintf ( '<span class="admission">%s</span><br/>     <br/>',render($node_content['field_stlab_admission'])):"";
     //$variables['call_type']=(isset($node_content['field_stlab_calltype']))?sprintf ( '<p class="event-pre-title"><span class="content-type">%s</span> / %s  </p>',t("Open call"),render($node_content['field_stlab_calltype'])):"";
     
    }
  }
  
  
    /*
	  Funcion para pintar la url al iCal y al RSS de las taxonomias
	  
	   */
	   $laURL=arg();
        if (1){
        //$vars['language']->language;
            $attributes = array('attributes' => array('title' => t('Add to my agenda')), 'html' => TRUE);
            $attributes_rss = array('attributes' => array('title' => t("Suscribe to this project's RSS")), 'html' => TRUE);
            $image_path= $variables['base_path'].path_to_theme()."/cssimgs/ical.png";
            $image_rss_path= $variables['base_path'].path_to_theme()."/cssimgs/rss.png";
            $variables['icalURL']=l('<img src="'.$image_path.'" alt="'.t('Add to my agenda').'">', 'webcal://studiolabproject.eu/project-ical/'.arg(1), $attributes);
            $variables['rssURL']=l('<img src="'.$image_rss_path.'" alt="'.t('Suscribe to RSS').'">', 'http://studiolabproject.eu/rss/'.arg(1), $attributes_rss);
        };
}

function Studiolab_form_alter(&$form, &$form_state, $form_id) {
    
    
    if ($form_id == 'search_form') {
    $form['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['basic']['keys'] = array(
        '#type' => 'textfield', 
        '#title' => "", 
        '#default_value' => t('Search'), 
        '#size' => 20, 
        '#maxlength' => 255,
        '#onfocus'=>'this.value = &#039;&#039;',
  );
                  $form['basic']['keys']['#attributes']=array (
                    'onfocus'=>'this.value = "";',
                  );
        
    }
    
    
}
error_reporting(E_ALL); 
ini_set( 'display_errors','1');
function Studiolab_process_page(&$variables) {
  
	if (isset($variables['node'])&&isset($variables['theme_hook_suggestions'])&&!in_array("page__node__38",$variables['theme_hook_suggestions'])){
    $variables['theme_hook_suggestions'][] = 'page__'. $variables['node']->type;
       }
       // Need print standard ations.
       $page_content=array("promote","toggle");
       $intersect=count(array_intersect($page_content,arg()));
        if($intersect>0){        
         $variables['theme_hook_suggestions'] = 'page';
       }
       // TPL for lists. Need to control de menu for upcoming or past results.
       $page_lists=array("opencalls","events","projects","all");
       
       if(in_array(arg(0),$page_lists)){
       
         $variables['theme_hook_suggestions'][] = 'page__lists';
          
       }
       
       
       
   if (($variables['is_front'])){
   
    $variables['theme_hook_suggestions'][] = 'page__'. "front" ;
   
   }
    
    
    // NO trailing slash!
    $nid = arg(1);
  if (arg(0) == 'node' && is_numeric($nid)) {
    if (isset($variables['page']['content']['system_main']['nodes'][$nid])) {
	
    
      $variables['node_content'] =$variables['page']['content']['system_main']['nodes'][$nid];
      $block = module_invoke('service_links', 'block_view', 'service_links');
      $variables['service_links']=$block['content'];
      if ($variables['node']->type!="site_pages"){
      //$variables['stdlab_theme']=$variables['node_content']['field_stlab_theme'][0]['#title'];
      //$variables['stdlab_strand']=$variables['node_content']['field_stlab_strand'][0]['#title'];
      //$variables['stdlab_startdate']=$variables['node_content']['field_stlab_strand'][0]['#title'];
      }
    }
  }
}

// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
function DateRange($dates,$format_date){
     $first_date=$dates[0]['#markup'];
    if(count($dates['#items'])>1){
       
        $last_date=$dates[count($dates['#items'])-1]['#markup'];
        $date=sprintf("%s %s <br/> %s %s",t('from'),$first_date,t('to'),$last_date);
          return $date ;
    }else{
        return $first_date;
    }

}

function DateRangeWhatson($dates,$format_date,$specific_month){
    $found_first_date=false;
    foreach ($dates as $date){
        print date("m",$date['value']);
        if ($specific_month==date("m",$date['value'])&&!$found_first_date){
            $first_date=format_date($date['value'],$format_date);
            $found_first_date=true;
        }else{
            $last_date=format_date($date['value'],$format_date);
        }      
    }
}

function ContentType2Print($content_type,$event_type){
   
     $allowed_content= array("Project","Media Asset","Prototyping","Open Call");
     if (in_array($content_type,$allowed_content)){
          return $content_type;
     }else if ($content_type=="Event"){
        return $event_type; 
     }else{
          return NULL;
     }
};

function Studiolab_date_all_day_label() {
  return '';
}

function Studiolab_html_head_alter(&$head_elements) {
  foreach ($head_elements as $key => $element) {
  	if (isset($element['#attributes']['rel']) && $element['#attributes']['rel'] == 'canonical') {
            unset($head_elements[$key]);  
          } 
     }
}