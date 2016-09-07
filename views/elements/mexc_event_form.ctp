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

echo $this->Buro->sform(array(), array(
	'model' => $fullModelName,
	'callbacks' => array(
		'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
		'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
		'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
		'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");'),
	)
));
	
	echo $this->Buro->input(
		array(), 
		array('fieldName' => 'id', 'type' => 'hidden')
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'mexc_space'
		)
	);
	
	// Display Level
	//echo $this->Buro->input(
		//array(),
		//array(
			//'fieldName' => 'display_level',
			//'type' => 'select',
			//'label' => __d('mexc_event', 'form - display level label', true),
			//'instructions' => __d('mexc_event', 'form - display level instructions', true),
			//'options' => array('options' => array (
				//'general' => 'Geral',
				//'fact_site' => 'Só no espaço',
				//'private' => 'Privado'
			//))
		//)
	//);
	
	// Event name
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'name',
			'label' => __d('mexc_event', 'form - name label', true),
			'instructions' => __d('mexc_event', 'form - name instructions', true)
		)
	);
	
	// Event tags
	echo $this->Buro->input(array(), 
		array(
			'type' => 'tags',
			'fieldName' => 'tags',
			'label' => __d('mexc_event', 'form - tags input label', true),
			'instructions' => __d('mexc_event', 'form - tags input instructions', true),
			'options' => array(
				'type' => 'comma'
			)
		)
	);
	
	
	// Event image
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'img_id',
			'type' => 'image',
			'label' => __d('mexc_event', 'form - img_id (upload) label', true),
			'instructions' => __d('mexc_event', 'form - img_id (upload) instructions', true),
			'options' => array(
				'version' => 'backstage_preview'
			)
		)
	);
	
	echo $this->Buro->sinput(array(),array('type' => 'super_field', 'label' => __d('mexc_event', 'form - dates superfield label', true)));
	
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
				'label' => __d('mexc_event', 'form - start (date) label', true),
				'instructions' => __d('mexc_event', 'form - start (date) instructions', true)
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
				'label' => __d('mexc_event', 'form - end (date) label', true),
				'instructions' => __d('mexc_event', 'form - end (date) instructions', true)
			)
		);
	
	echo $this->Buro->einput();
	
	
	echo $this->Buro->sinput(array(), array('type' => 'super_field', 'label' => __d('mexc_event', 'form - about place superfield label', true)));
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'place_name',
				'label' => __d('mexc_event', 'form - place_name label', true),
				'instructions' => __d('mexc_event', 'form - place_name instructions', true)
			)
		);
		
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'place_url',
				'label' => __d('mexc_event', 'form - place_url label', true),
				'instructions' => __d('mexc_event', 'form - place_url instructions', true)
			)
		);
		
	echo $this->Buro->einput();
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'summary',
			'type' => 'textarea',
			'label' => __d('mexc_event', 'form - summary label', true),
			'instructions' => __d('mexc_event', 'form - summary instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'content_stream',
			'label' => __d('mexc_event', 'form - content_stream label', true),
			'instructions' => __d('mexc_event', 'form - content_stream instructions', true),
			'options' => array(
				'foreignKey' => 'content_stream_id'
			)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_event', 'form - List of event items (relational) label', true),
			'instructions' => __d('mexc_event', 'form - List of event items (relational) instructions', true),
			'options' => array(
				'type' => 'many_children',
				'model' => 'MexcEvents.MexcEventItem',
				'texts' => array(
					'confirm' => array(
						'delete' => __d('mexc_event', 'form - confirm delete a event item', true)
					),
					'title' => __d('mexc_event', 'form - event item title', true)
				)
			)
		)
	);
	
	echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
