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
		
		$incoming = $this->MexcEvent->getCurrentEventsByYearAndMonth($conditions);
		$occurred = $this->MexcEvent->getPastEventsByYearAndMonth($conditions);
		
		$this->set(compact('occurred', 'incoming'));
	}
	
	function read($mexc_event_id = null)
	{
		if (empty($mexc_event_id))
			$this->redirect('/eventos');
		
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$event = $this->MexcEvent->find('first', array(
			'contain' => array('MexcEventItem', 'Tag'),
			'conditions' => array(
				'MexcEvent.id' => $mexc_event_id,
			) + $conditions
		));
		
		if (empty($event))
			$this->redirect('/eventos');
		
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
