<?php

//drupal_add_http_header('Content-Type', 'text/calendar; charset=utf-8');
//drupal_add_http_header('Content-Disposition', 'attachment; filename="calendar.ics"');

$myArgs=arg(1);

?>
<?php
		
		$viewName='ical';
                             $display_id='page';
                             $myArgs=array ($myArgs);
                             
                             //$myArgs=$argumentos_para_view;
                             $view = views_get_view($viewName);
                             $view->set_display($display_id);
                             $view->set_arguments($myArgs);
                             //$view->init_display();
                             $view->execute();
		//$laSeleccion=new GeneradorView ("auditorio_ical",NULL,$myArgs);
		
$resultado=$view->result;
$node=node_load($myArgs);

		?>
		

BEGIN:VCALENDAR<?php print ("\r\n") ?>
VERSION:2.0<?php print ("\r\n") ?>
METHOD:PUBLISH<?php print ("\r\n") ?>
X-WR-CALNAME: <?php

//$term=taxonomy_get_term($myArgs);

print ($node->title) ?> | StudioLab <?php print ("\r\n") ?>
PRODID:-//Drupal// StudioLab<?php print ("\r\n") ?>
<?php foreach($view->result as $event):
		$time=($event->field_field_stlab_eventdate[0]['raw']['value']);
		$time2=($event->field_field_stlab_eventdate[0]['raw']['value2']);
		$fecha2=date('Ymd\THis', $time2);
		$fecha=date('Ymd\THis', $time);
		$fechaZ=date('Ymd\THis', $time).Z;  
?>BEGIN:VEVENT<?php print ("\r\n") ?>
UID:<?php print($event->nid . "\r\n") ?>
SUMMARY:<?php print($event->node_title. "\r\n"); ?>
DTSTAMP:<?php print($fecha. "\r\n"); ?>
DTSTART:<?php print($fecha. "\r\n"); ?>
DTEND:<?php print($fecha2. "\r\n");?>
URL:<?php print(url("node/".$event->nid,array('absolute' => TRUE)). "\r\n");?>
LOCATION:<?php print($event->field_field_stlab_place[0]['rendered']['#markup']." - ". $event->field_field_trm_location[0]['rendered']['#location']['street'].", ". $event->field_field_trm_location[0]['rendered']['#location']['city'].", ".$event->field_field_trm_location[0]['rendered']['#location']['country']."\r\n");?>
<?php if (!empty($event->fields['field_pr_abstract_value'])) : ?>
DESCRIPTION:<?php print($event->field_body[0]['raw']['summary'] . "\r\n"); ?>
<?php endif; ?>
END:VEVENT<?php print ("\r\n") ?>
<?php endforeach; ?>
END:VCALENDAR<?php print ("\r\n") ?>


	<?php print($icalURL);?>	