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

switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'view':
				echo $this->element('mexc_event_item_view', array('plugin' => 'mexc_events', 'data' => $data));
			break;
			
			case 'form':
				echo $this->element('mexc_event_item_form', array('plugin' => 'mexc_events'));
			break;
		}
	break;
}
