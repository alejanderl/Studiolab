<?php

drupal_add_http_header('Content-Type', 'text/xml; charset=utf-8');
//drupal_add_http_header('Content-Disposition', 'attachment; filename="calendar.ics"'); 

$myArg=arg(1);

?>
<?php
		
		$viewName='ical';
                             $display_id=(arg(0)=="feed")?'studiolab_rss':'rss';
			     		

                             
                             $myArgs=(arg(0)=="feed")?'':array ($myArg);
                             
                             //$myArgs=$argumentos_para_view;
                             $view1 = views_get_view($viewName);
                             $view1->set_display($display_id);
                             $view1->set_arguments($myArgs);
                             //$view->init_display();
                             $view1->execute();
		

if(arg(0)!="feed"){
		
		$node=node_load($myArg);
		$node_content=node_view($node);
		
		}
               
$eventsIdsrelated=array();
foreach($view1->result as $event ){
         
        array_push($eventsIdsrelated,$event->nid);
     }
     array_push($eventsIdsrelated,$node->nid);
     $display_id=(arg(0)=="feed")?'studiolab_rss':'rss';
     $myArgs=(arg(0)=="feed")?'':implode("+",$eventsIdsrelated);


     $view = views_get_view($viewName);
     $view->set_display($display_id);
     $view->set_arguments(array($myArgs));
    $view->execute();
		?>
<?php print ("<?xml") ?> version="1.0" encoding="utf-8" ?>

<rss version="2.0" >
  <channel>
    <title>Studiolab | <?php print ($node->title)?> </title>
    <description><?php print ($node->summary)?></description>
    <category> <?php print (render($node_content['field_stlab_theme'][0]));?>/<?php print (render($node_content['field_stlab_strand'][0]));?></category>
    <link><?php print url("",  array('absolute' => TRUE))?></link>
    <image>
      <link><?php print url("",  array('absolute' => TRUE))?></link>
      <width>146</width>
      <title>Studiolabproject.eu</title>
      <url><?php print url( $directory."/images/logoStudiolab.png",  array('absolute' => TRUE))?></url>
      <height>37</height>
    </image>
    <language>en-gb</language>
    <lastBuildDate><?php print format_date(time(),"long")?></lastBuildDate>
    <webMaster><?php print variable_get('site_mail', '')?></webMaster>
    <ttl>120</ttl>
    <docs><?php print url( "feeds",  array('absolute' => TRUE))?></docs>



<?php foreach($view->result as $event):
//miKrumo($event);
?>
<item>
 <title><![CDATA[<?php print($event->node_title )?>]]></title>
      <description><![CDATA[<?php print($event->field_field_stlab_summary[0]["rendered"]['#markup']); ?>]]></description>
      <link><?php print url( "node/".$event->nid,  array('absolute' => TRUE))?></link>
      <guid><?php print url( "",  array('absolute' => TRUE))."node/".$event->nid?></guid>
      <pubDate><?php print(format_date($event->node_changed,"long")); ?></pubDate>

</item>
<?php endforeach; ?>
</channel>
</rss>
