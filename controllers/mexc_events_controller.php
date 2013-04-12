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

class MexcEventsController extends MexcEventsAppController
{
	var $name = 'MexcEvents';
	
	var $uses = array('MexcEvents.MexcEvent');
	
	var $paginate = array(
		'MexcEvent' => array(
			'limit' => 8,
			'contain' => false
		)
	);
	
/**
 * action beforeFilter
 * 
 * @access private
 * @return void 
 */
	function beforeFilter()
	{
		parent::beforeFilter();
		if (!empty($this->currentSpace))
			$this->MexcEvent->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
		else
			$this->MexcEvent->setActiveStatuses(array('display_level' => array('general')));
	}
	
	function index()
	{
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$today_mid_night = date('Y-m-d', strtotime('+1 day'));
		$current_events = $incoming_events = array();
		
		$searching = isset($this->params['named']['page']);
		
		if (!$searching)
		{
			$current_events = $this->MexcEvent->find('all', array(
				'contain' => false,
				'conditions' => array(
					'MexcEvent.start <=' => $today_mid_night,
					'MexcEvent.end >=' => $today_mid_night
				) + $conditions
			));
			$two_current_events = array_slice($current_events, 0, 2);
			$other_current_events = array_slice($current_events, 2);
		
			$incoming_events = $this->MexcEvent->find('all', array(
				'contain' => false,
				'order' => array('MexcEvent.start' => 'asc', 'MexcEvent.end' => 'asc', 'MexcEvent.created' => 'asc'),
				'conditions' => array(
					'MexcEvent.start >=' => $today_mid_night
				) + $conditions
			));
			$two_incoming_events = array_slice($incoming_events, 0, 2);
			$other_incoming_events = array_slice($incoming_events, 2);

			$this->paginate['MexcEvent']['limit'] = 4;
		}
		
		$occurred_events = $this->paginate('MexcEvent', array('MexcEvent.end <' => $today_mid_night) + $conditions);
		
		$this->set(compact('occurred_events', 'two_incoming_events', 'other_incoming_events', 'two_current_events', 'other_current_events'));
	}
	
	function read($mexc_event_id = null)
	{
		if (empty($mexc_event_id))
			$this->cakeError('error404');
		
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$event = $this->MexcEvent->find('first', array(
			'contain' => array('MexcEventItem', 'PlaceTextile', 'ParticipationTextile', 'Tag'),
			'conditions' => array(
				'MexcEvent.id' => $mexc_event_id,
			) + $conditions
		));
		
		if (empty($event))
			$this->cakeError('error404');
		
		$this->SectSectionHandler->addToPageTitleArray(array(null, null, $event['MexcEvent']['name']));
		
		$this->MexcEvent->MexcNew->contain();
		$news = $this->MexcEvent->MexcNew->findAllByMexcEventId($event['MexcEvent']['id']);
		
		$this->MexcEvent->MexcGallery->contain(array('MexcImage' => array('limit' => 1)));
		$galleries = $this->MexcEvent->MexcGallery->findAllByMexcEventId($event['MexcEvent']['id']);
		
		$this->MexcEvent->MexcDocument->contain();
		$documents = $this->MexcEvent->MexcDocument->findAllByMexcEventId($event['MexcEvent']['id']);
		
		$this->set(compact('event', 'news', 'galleries', 'documents'));
	}
}
