<?php

drupal_add_http_header('Content-Type', 'text/xml; charset=utf-8');
//drupal_add_http_header('Content-Disposition', 'attachment; filename="calendar.ics"'); 

$myArg=arg(1);

?>
<?php
		
		$viewName='ical';
                             $display_id='rss';
                             
                             $myArgs=array ($myArg);
                             
                             //$myArgs=$argumentos_para_view;
                             $view1 = views_get_view($viewName);
                             $view1->set_display($display_id);
                             $view1->set_arguments($myArgs);
                             //$view->init_display();
                             $view1->execute();
		//$laSeleccion=new GeneradorView ("auditorio_ical",NULL,$myArgs);
		

$node=node_load($myArg);
$eventsIdsrelated=array();
foreach($view1->result as $event ){
         
        array_push($eventsIdsrelated,$event->nid);
     }
     array_push($eventsIdsrelated,$node->nid);
     $myArgs=implode("+",$eventsIdsrelated);
     $view = views_get_view($viewName);
     $view->set_display($display_id);
     $view->set_arguments(array($myArgs));
    $view->execute();
		?>
<?php print ("<?xml") ?> version="1.0" encoding="utf-8" ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title>Studiolab | <?php print ($node->title)?> </title>
    <description><?php print ($node->summary)?></description>
    <link><?php print url("",  array('absolute' => TRUE))?></link>
    <image>
      <link><?php print url("",  array('absolute' => TRUE))?></link>
      <width>146</width>
      <title>Studiolabproject.eu</title>
      <url><?php print url( $directory."/images/logoStudiolab.png",  array('absolute' => TRUE))?></url>
      <height>37</height>
    </image>
    <language>en-gb</language>
    <lastBuildDate><?= format_date(time(),"long")?></lastBuildDate>
    <webMaster><?= variable_get('site_mail', '')?></webMaster>
    <ttl>120</ttl>
    <docs><?php print url( "feeds",  array('absolute' => TRUE))?></docs>



<?php foreach($view->result as $event):

?>
<item>
 <title><?php print($event->node_title )?></title>
      <description><?php print($event->field_body[0]['raw']['summary'] ); ?></description>
      <link><?php print url( "node/".$event->nid,  array('absolute' => TRUE))?></link>
      <guid><?php print url( "",  array('absolute' => TRUE))."node/".$event->nid?></guid>
      <pubDate><?php print(format_date($event->node_changed,"long")); ?></pubDate>

</item>
<?php endforeach; ?>
</channel>
</rss>