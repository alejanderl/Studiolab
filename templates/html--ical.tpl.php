<?php
drupal_add_http_header('Content-Type', 'text/calendar; charset=utf-8');
//drupal_add_http_header('Content-Disposition', 'attachment; filename="calendar.ics"');
?>
<?php
		$myArgs=arg(1);
		$viewName='ical';
		$display_id='page';
		$myArgs=array ($myArgs);
		
		//$myArgs=$argumentos_para_view;
		$view = views_get_view($viewName);
		$view->set_display($display_id);
		$view->set_arguments($myArgs);
		//$view->init_display();
		$view->execute();
		$resultado=$view->result;
		$node_values_themes=array(3=>33,2=>34,1=>70,5=>37,4=>35,6=>36);
    $tid_theme=array_search($myArgs,$node_values_them);
		$node=node_load($node_values_themes[arg(1)]);
		
?>
BEGIN:VCALENDAR<?php print ("\r\n");?>
VERSION:2.0<?php print ("\r\n") ?>
METHOD:PUBLISH<?php print ("\r\n") ?>
X-WR-CALNAME: StudioLab | <?php print ($node->title) ?>  <?php print ("\r\n") ?> PRODID:-//Drupal// StudioLab<?php print ("\r\n") ?>
<?php foreach($view->result as $event):
		$time=($event->field_data_field_stlab_eventdate_field_stlab_eventdate_value);
		foreach($event->field_field_stlab_eventdate as $finaltime){			
		 if ($finaltime['raw']['value']==$time){
		 $time2=($finaltime['raw']['value2']);
		 break;
		 }
		}
		
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