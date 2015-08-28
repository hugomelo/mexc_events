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

class MexcEvent extends MexcEventsAppModel
{
	var $name = 'MexcEvent';
	
	var $order = array('MexcEvent.start' => 'desc', 'MexcEvent.end' => 'desc', 'MexcEvent.created' => 'desc');
	
	var $validate = array(
		
	);
	
	var $actsAs = array(
		'Containable', 
		'Dashboard.DashDashboardable', 
		'Tags.Taggable',
		'Status.Status' => array('publishing_status', 'display_level'),
		'JjMedia.StoredFileHolder' => array('img_id'),
		'ContentStream.CsContentStreamHolder' => array(
			'streams' => array(
				'content_stream_id' => 'event'
			)
		),
		'UnifiedSearch.Searcheable' => array(
			'contain' => array('MexcSpace')
		),
		'Temp.TempTemp' => array(
			'field' => 'is_temp',
			'modifiedBefore' => 1
		),
	);
	
	
	var $belongsTo = array(
		'ParticipationTextile' => array(
			'className' => 'MexcTextile.MexcTextileText',
			'foreignKey' => 'how_to_participate_textile_id'
		),
		'PlaceTextile' => array(
			'className' => 'MexcTextile.MexcTextileText',
			'foreignKey' => 'place_about_textile_id'
		),
		'MexcSpace' => array(
			'className' => 'MexcSpace.MexcSpace'
		)
	);
	
	var $hasMany = array(
		'MexcNew' => array(
			'className' => 'MexcNews.MexcNew',
			'order' => array('MexcNew.date' => 'desc')
		),
		'MexcGallery' => array(
			'className' => 'MexcGalleries.MexcGallery',
			'order' => array('MexcGallery.date' => 'desc')
		),
		'MexcDocument' => array(
			'className' => 'MexcDocuments.MexcDocument',
			'order' => array('MexcDocument.modified' => 'desc')
		),
		'MexcEventItem' => array(
			'className' => 'MexcEvents.MexcEventItem',
			'order' => array('MexcEventItem.start' => 'asc'),
			'dependent' => true
		)
	);
		
/** 
 * Creates a blank row in the table. It is part of the backstage contract.
 * 
 * @access public
 * @return The result of save method
 */
	function createEmpty()
	{
		$data = array();
		
		$this->ParticipationTextile->createEmpty();
		$data['MexcEvent']['how_to_participate_textile_id'] = $this->ParticipationTextile->id;
		
		$this->PlaceTextile->createEmpty();
		$data['MexcEvent']['place_about_textile_id'] = $this->PlaceTextile->id;
		$data['MexcEvent']['publishing_status'] = 'draft';
		
		return $this->save($data, false);
	}

/**
 * Find for burocrata
 * 
 * @access public
 */
	function findBurocrata($id)
	{
		$this->contain(array('ParticipationTextile', 'PlaceTextile', 'MexcSpace', 'MexcEventItem', 'Tag'));
		return $this->findById($id);
	}

/**
 * Used by burocrata form. It uses saveAll because $data came with Textiles datas.
 * 
 * @access public
 * @param array $data
 * @return boolean The result of Model::saveAll()
 */
	function saveBurocrata($data)
	{
		if (isset($data['MexcEvent']['mexc_space_id']) && $data['MexcEvent']['mexc_space_id'] == '')
			$data['MexcEvent']['mexc_space_id'] = NULL;
		return $this->saveAll($data);
	}

/** 
 * The data that must be saved into the dashboard. Part of the Dashboard contract.
 *
 * @access public
 * @return array 
 */	

	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		if (empty($data))
			return null;
		
		$dashdata = array(
			'dashable_id' => $data['MexcEvent']['id'],
			'mexc_space_id' => $data['MexcEvent']['mexc_space_id'],
			'dashable_model' => $this->name,
			'type' => 'event',
			'status' => $data['MexcEvent']['publishing_status'],
			'created' => $data['MexcEvent']['created'],
			'modified' => $data['MexcEvent']['modified'], 
			'name' => $data['MexcEvent']['name'],
			'info' => 'Desc.: ' . substr($data['MexcEvent']['summary'], 0, 60) . '...',
			'idiom' => array()
		);
		
		return $dashdata;
	}
	
	/** When data is deleted from the Dashboard. Part of the Dashboard contract.
	 *  @todo Maybe we should study how to do it from Backstage contract.
	 */
	
	function dashDelete($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		// Delete textiles entries
		$this->ParticipationTextile->delete($data['MexcEvent']['how_to_participate_textile_id']);
		$this->PlaceTextile->delete($data['MexcEvent']['place_about_textile_id']);
		
		// Unset all related Documents, Galleries and News
		foreach (array('MexcDocument', 'MexcGallery', 'MexcNew') as $related)
		{
			$this->{$related}->unbindModel(array('belongsTo' => array_keys($this->{$related}->belongsTo)));
			$this->{$related}->updateAll(
				array($related . '.mexc_event_id' => null),
				array($related . '.mexc_event_id' => $id)
			);
			$this->{$related}->resetAssociations();
		}
		return $this->delete($id);
	}
}
?>
