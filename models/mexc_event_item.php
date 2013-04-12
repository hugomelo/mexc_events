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

class MexcEventItem extends MexcEventsAppModel
{
	var $name = 'MexcEventItem';

	var $order = array(
		'MexcEventItem.start' => 'asc'
	);
	
	var $actsAs = array(
		'Containable'
	);
	
	var $belongsTo = array(
		'MexcEvents.MexcEvent'
	);

	var $validate = array(
		'name' => array(
			'rule' => array('maxLength', 250),
			'required' => true,
			'allowEmpty' => false
		),
		'description' => array(
			'rule' => array('maxLength', 300),
			'required' => true,
			'allowEmpty' => true
		)
	);
}
