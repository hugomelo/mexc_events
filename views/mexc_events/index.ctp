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

if (!empty($two_current_events))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
		
		echo $this->Bl->h2(array('class' => 'section_title'), array(), 'Eventos acontecendo agora');
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6), 'type' => 'column_container'));
			foreach ($two_current_events as $event)
			{
				echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('column'), $event);
				echo $this->Bl->ebox();
			}
		echo $this->Bl->eboxContainer();
		
		if (!empty($other_current_events))
		{
			echo $this->Bl->hr();
			foreach ($other_current_events as $event)
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('line',6), $event);
		}
		
	echo $this->Bl->ebox();
}

if (!empty($two_incoming_events))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
	
		echo $this->Bl->h2(array('class' => 'section_title'), array(), 'eventos planejados para o futuro');
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6), 'type' => 'column_container'));
			foreach ($two_incoming_events as $event)
			{
				echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('column'), $event);
				echo $this->Bl->ebox();
			}
		echo $this->Bl->eboxContainer();
		
		if (!empty($other_incoming_events))
		{
			echo $this->Bl->hr();
			foreach ($other_incoming_events as $event)
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('line',6), $event);
		}
		
	echo $this->Bl->ebox();
}

if ($currentSpace && (!empty($two_current_events) || !empty($two_incoming_events)) && !empty($occurred_events))
	echo $this->Bl->hr(array('class' => 'double'));

if (!empty($occurred_events))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));

		echo $this->Bl->h2(array('class' => 'section_title'), array(), 'Arquivo de eventos ocorridos');
		
		echo $this->element('pagination', array('top' => true));
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
			foreach ($occurred_events as $n => $event)
			{
				echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('column'), $event);
				echo $this->Bl->ebox();
				if (($n+1)%4 == 0)
					echo $this->Bl->floatBreak(), $this->Bl->verticalSpacer();
			}
			echo $this->Bl->floatBreak();
			if (count($occurred_events)%4 != 0)
				echo $this->Bl->verticalSpacer();
		
		echo $this->Bl->eboxContainer();
		
		echo $this->element('pagination');
		
	echo $this->Bl->ebox();
}
