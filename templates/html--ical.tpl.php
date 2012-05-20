<?php

drupal_set_header('Content-Type: text/calendar; charset=utf-8');
  drupal_set_header('Content-Disposition: attachment; filename="calendar.ics"; ');

$myArgs=arg(1);
?>
<?php
		
		$viewName='element_list';
                             $display_id='page';
                             $myArgs=array ($node->nid);
                             
                             //$myArgs=$argumentos_para_view;
                             $view = views_get_view($viewName);
                             $view->set_display($display_id);
                             $view->set_arguments($myArgs);
                             //$view->init_display();
                             $view->execute();
		//$laSeleccion=new GeneradorView ("auditorio_ical",NULL,$myArgs);
		miKrumo($view);

		?>