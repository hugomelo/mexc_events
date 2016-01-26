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
		if ($type[1] == 'form')
			echo $this->element('mexc_event_form', array('plugin' => 'mexc_events'));
		if ($type[1] == 'view')
			echo $this->Bl->h4Dry($data['MexcEvent']['name']), $this->Bl->pDry($data['MexcEvent']['summary']);
	break;
	
	case 'preview':
		switch ($type[1])
		{
			case 'box':
			case 'unified_search':
				if (isset($data['MexcEvent'])) {
					$item = $data['MexcEvent'];
					$url = array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $item['id']);
					$item['title'] = $item['name'];
				}
				else {
					$item = $data['SblSearchItem'];
					$url = array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $item['foreign_id']);
				}

				$date = "";
				if (date("m/Y", strtotime($item['start'])) == date("m/Y", strtotime($item['end'])))
					$date = date('\d\e H:m \a\t\é ', strtotime($item['start'])).date('H:m \d\e d/m/Y',strtotime($item['end']));
				else
					$date = date('\d\a\s H:m \d\e d/m/Y \a\té ', strtotime($item['start'])).date('H:m \d\e d/m/Y', strtotime($item['end']));
				echo $this->Bl->h6(array('class' => 'post-type'), array(), 'Agenda');
				if (!empty($data['MexcSpace']['FactSite'][0]['name'])) {
					echo $this->Bl->anchor(array(), array('url' => '/programas/'.$data['MexcSpace']['id']),
						$this->Bl->div(array('class' => 'project'), array(), $data['MexcSpace']['FactSite'][0]['name']));
				}
				echo $this->Bl->div(array('class' => 'post-date'), array(), $date);
				echo $this->Bl->anchor(array(), array('url' => $url),
					$this->Bl->h5(array('class' => 'title'), array(), $item['title']));
				echo $this->Bl->anchor(array(), array('url' => $url),
					$this->Bl->div(array('class' => 'post-body'), array(), $item['summary']));
				echo $this->Bl->div(array('class' => 'post-footer-hidder'));
			break;
		}
	break;

	case 'view':
		switch ($type[1])
		{
			case 'list':
				$item = $data['MexcEvent'];
				$url = array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $item['id']);

				$date = "";
				if (date('d/m/Y',strtotime($item['start'])) == date('d/m/Y',strtotime($item['end'])))
					$date = date('\d\e H:m \a\t\é ', strtotime($item['start'])).date('H:m \d\e d/m/Y',strtotime($item['end']));
				else
					$date = date('\d\a\s H:m \d\e d/m/Y \a\t\é ', strtotime($item['start'])).date('H:m \d\e d/m/Y', strtotime($item['end']));

				echo $this->Bl->div(array('class' => 'post-date'), array(), $date);
				echo $this->Bl->anchor(array(), array('url' => $url),
					$this->Bl->h5(array('class' => 'title'), array(), $item['name']));
				echo $this->Bl->div(array('class' => 'post-place'), array(), $item['place_name']);
			break;
		}
	break;
}
