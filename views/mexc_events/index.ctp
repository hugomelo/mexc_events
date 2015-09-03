<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_events.git Mexc Events public repository
 */

echo $this->element('header-index', array('title' => 'Agenda', 'slug'=>'events'));


echo $this->Bl->sdiv(array('class' => 'agenda'));
	echo $this->Bl->srow(array('class' => 'agenda menu'));
		echo $this->Bl->sdiv(array('class' => 'projects col-xs-12'));
			$events = $this->Bl->anchor(array('class' => 'newer active'), array(
				'url' => array()), 'Eventos a seguir');
			$events .= $this->Bl->anchor(array('class' => 'older'), array(
				'url' => array()), 'Eventos passados');
			echo $this->Bl->div(array('class' => 'project-select'), array(), $events);
		echo $this->Bl->ediv();
	echo $this->Bl->erow();

	$active = ' active ';
	foreach(array('incoming', 'occurred') as $state) {
		echo $this->Bl->sdiv(array('class' => $state.$active));
			foreach(${$state} as $year => $eventsByMonth) {
				echo $this->Bl->srow(array('class' => 'agenda'));
					echo $this->Bl->sdiv(array('class' => ' col-xs-2'));
						echo $this->Bl->h1(array('class' => 'year'), array(), $year);
					echo $this->Bl->ediv();
					echo $this->Bl->sdiv(array('class' => ' col-xs-10'));
						echo $this->Bl->srow(array('class' => 'event-list'));
							foreach($eventsByMonth as $month => $events) {
								echo $this->Bl->sdiv(array('class' => ' col-xs-2'));
									echo $this->Bl->h2(array('class' => 'month'), array(), $month);
								echo $this->Bl->ediv();
								echo $this->Bl->sdiv(array('class' => 'posts-list col-xs-10'));
									foreach($events as $event) {
										echo $this->Bl->sdiv(array('class' => 'event'));
											echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('view', 'list'), $event);
										echo $this->Bl->ediv();
									}
								echo $this->Bl->ediv();
							}
						echo $this->Bl->erow();
					echo $this->Bl->ediv();
				echo $this->Bl->erow();
				$active = '';
			}
		echo $this->Bl->ediv();
	}
echo $this->Bl->ediv();
