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

echo $this->Buro->sform(
		array(), 
		array(
			'model' => 'MexcEvents.MexcEventItem'
		)
	);
	
	echo $this->Buro->input(
			array(), 
			array('fieldName' => 'id', 'type' => 'hidden')
		);
	
	echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'name',
				'label' => __d('mexc_event_item', 'form - name label', true),
				'instructions' => __d('mexc_event_item', 'form - name instructions', true),
				'error' => __d('mexc_event_item', 'form - name error: Required and maxLength 250 chars', true)
			)
		);
	
	echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'description',
				'type' => 'textarea',
				'label' => __d('mexc_event_item', 'form - description label', true),
				'instructions' => __d('mexc_event_item', 'form - description instructions', true),
				'error' => __d('mexc_event_item', 'form - description error: maxLength 3000 chars', true)
			)
		);
	
	echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'start',
				'type' => 'datetime',
				'options' => array(
					'dateFormat' => 'DMY',
					'timeFormat' => '24',
					'minYear' => date('Y')-50,
					'maxYear' => date('Y')+5
				),
				'label' => __d('mexc_event_item', 'form - start (date) label', true),
				'instructions' => __d('mexc_event_item', 'form - start (date) instructions', true),
				'error' => __d('mexc_event_item', 'form - start (date) error: valid date', true)
			)
		);
	
	echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'end',
				'type' => 'datetime',
				'options' => array(
					'dateFormat' => 'DMY',
					'timeFormat' => '24',
					'minYear' => date('Y')-50,
					'maxYear' => date('Y')+5
				),
				'label' => __d('mexc_event_item', 'form - end (date) label', true),
				'instructions' => __d('mexc_event_item', 'form - end (date) instructions', true),
				'error' => __d('mexc_event_item', 'form - end (date) error: valid date', true)
			)
		);
	
	echo $this->Buro->submit(
			array(),
			array(
				'label' => __d('mexc_event_item', 'save form', true),
				'cancel' => array(
					'label' => __d('mexc_event_item', 'cancel form', true)
				)
			)
		);
	
echo $this->Buro->eform();
echo $this->Bl->floatBreak();
