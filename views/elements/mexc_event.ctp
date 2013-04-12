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
	
	case 'column':
		$factSite = isset($type[1]) && $type[1] == 'fact_site';
		$date = $this->Bl->date(array(), 
			array(
				'begin' => $data['MexcEvent']['start'], 
				'end' => $data['MexcEvent']['end'], 
				'from' => true,
				'format' => 'event'
		));
		
		$class = (isset($type[1]) && $type[1] == 'related_content') ? 'light' : 'column_date';
		echo $this->Bl->div(compact('class'), array(), $date);
		
		if ($currentSpace != $data['MexcEvent']['mexc_space_id'])
			echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcEvent']['mexc_space_id']));
		
		echo $this->Bl->sh4();
			echo $this->Bl->anchor(
					array('class' => 'visitable'), 
					array(
						'url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $data['MexcEvent']['id']),
						'space' => $data['MexcEvent']['mexc_space_id']
					),
					$data['MexcEvent']['name']
				);
		echo $this->Bl->eh4();
		echo $this->Bl->br();
		
		if (!empty($data['MexcEvent']['img_id']))
		{
			$options['id'] = $data['MexcEvent']['img_id'];
			$options['version'] = 'preview_column';
			if ($factSite)
				$options['version'] = 'preview_column_fact';
			
			echo $this->Bl->img(array(), $options);
		}
		echo $this->Bl->paraDry(explode("\n", $data['MexcEvent']['summary']));
		
	break;
	
	case 'column_grande_desafio':
		$extended = isset($type[1]) && $type[1] == 'extended';
		
		$date = $this->Bl->date(array(), 
			array(
				'begin' => $data['MexcEvent']['start'], 
				'end' => $data['MexcEvent']['end'], 
				'from' => false,
				'format' => 'gd'
		));
		
		$class = 'column_date';
		echo $this->Bl->div(compact('class'), array(), $date);
		
		
		echo $this->Bl->sh4();
			echo $this->Bl->anchor(
					array('class' => 'link_texto link_em_nuvem'), 
					array(
						'url' => array('plugin' => 'grandedesafio', 'edicao' => $edicao['Edicao']['id'], 'controller' => 'calendario', 'action' => 'read', $data['MexcEvent']['id'])
					),
					$data['MexcEvent']['name']
				);
		echo $this->Bl->eh4();
		echo $this->Bl->br();
		if ($extended)
		{
			if (!empty($data['MexcEvent']['img_id']))
			{
				$options['id'] = $data['MexcEvent']['img_id'];
				$options['version'] = 'preview_column_fact';
				echo $this->Bl->img(array(), $options);
			}
		}
		echo $this->Bl->paraDry(explode("\n", $data['MexcEvent']['summary']));
		
	break;
	
	case 'column_grande_desafio_small':
		$date = $this->Bl->date(array(), 
			array(
				'begin' => $data['MexcEvent']['start'], 
				'end' => $data['MexcEvent']['end'], 
				'from' => false,
				'format' => 'gd'
		));
		
		$class = 'column_date';
		echo $this->Bl->div(compact('class'), array(), $date);
		
		
		echo $this->Bl->sh4();
			echo $this->Bl->anchor(
					array('class' => 'link_texto link_em_nuvem'), 
					array(
						'url' => array('plugin' => 'grandedesafio', 'edicao' => $edicao['Edicao']['id'], 'controller' => 'calendario', 'action' => 'read', $data['MexcEvent']['id'])
					),
					$data['MexcEvent']['name']
				);
		echo $this->Bl->eh4();
		echo $this->Bl->br();
		
	break;
		
	case 'line':
		echo $this->Bl->sboxContainer(array('class' => 'mexc_list'), array('size' => array('M' => $type[1]), 'type' => 'column_container'));
			echo $this->Bl->box(
				array('class' => 'line_date'),
				array('size' => array('M'=> 1)),
				$this->Bl->date(
					array(), 
					array(
						'begin' => $data['MexcEvent']['start'], 
						'end' => $data['MexcEvent']['end'], 
						'format' => 'event',
						'compact' => true
				))
			);
			echo $this->Bl->sbox(array('class' => 'mexc_list_link'), array('size' => array('M' => $type[1]-1, 'm' => -1, 'g' => -2)));
				if ($currentSpace != $data['MexcEvent']['mexc_space_id'])
					echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcEvent']['mexc_space_id']));
					
				echo $this->Bl->anchor(
					array('class' => 'visitable'), 
					array(
						'url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $data['MexcEvent']['id']),
						'space' => $data['MexcEvent']['mexc_space_id']
					),
					$data['MexcEvent']['name']
				);
			echo $this->Bl->ebox();
			echo $this->Bl->floatBreak();
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
	break;
	
	case 'two_lines':
		echo $this->Bl->sdiv();
			echo $this->Bl->date(
				array('class' => 'small light'), 
				array(
					'begin' => $data['MexcEvent']['start'], 
					'end' => $data['MexcEvent']['end'], 
					'format' => 'event',
					'compact' => true
			));
			echo $this->Bl->date(
				array('class' => 'small'), 
				array(
					'begin' => $data['MexcEvent']['start'], 
					'end' => $data['MexcEvent']['end'], 
					'format' => 'relative'
			));
			echo $this->Bl->br();
			echo $this->Bl->anchor(
				array('class' => 'visitable'), 
				array(
					'url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read', $data['MexcEvent']['id']),
					'space' => $data['MexcEvent']['mexc_space_id']
				),
				$data['MexcEvent']['name']
			);
		echo $this->Bl->ediv();
	break;

	case 'full':
		echo $this->Bl->h2Dry($data['MexcEvent']['name']);
		if (!empty($data['Tag']))
			echo $this->Bl->tagList(array(),array('tags' => $data['Tag']));
		echo $this->Bl->hr(array('class' => 'double'));
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 9), 'type' => 'column_container'));
			
			// Event main body
			echo $this->Bl->sbox(array(), array('size' => array('M' => 5, 'g' => -1), 'type' => 'inner_column'));
			
				if (!empty($data['MexcEvent']['img_id']))
					echo $this->Bl->img(array(), array('id' => $data['MexcEvent']['img_id'], 'version' => 'view'));
				
				echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_event'), $data['MexcEvent']['content_stream_id']);
				
				echo $this->Bl->br();
				echo $this->Bl->hr();
				
				echo $this->element('social_medias', array('plugin' => false, 'module' => 'MexcNew'));
				
			echo $this->Bl->ebox();

			
			// Dark box
			echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'dark_featured'));
				echo $this->Bl->h2Dry($this->Bl->date(array(), array('format' => 'event', 'begin' => $data['MexcEvent']['start'], 'end' => $data['MexcEvent']['end'])));

				$place_name = $data['MexcEvent']['place_name'];
				if (!empty($data['MexcEvent']['place_url']))
					$place = $this->Bl->a(array('href' => $data['MexcEvent']['place_url']),array(), $place_name);
				echo $this->Bl->h3Dry($place_name);
				
				echo $data['PlaceTextile']['html'];
			echo $this->Bl->ebox();

			echo $this->Bl->sbox(array('class' => 'event_agenda'), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
				
				if (!empty($data['MexcEventItem']))
				{
					echo $this->Bl->h5Dry('Programação do evento');
					$previous_date = false;
					foreach ($data['MexcEventItem'] as $item)
					{
						$start = getdate(strtotime($item['start']));
						$end = getdate(strtotime($item['end']));
						if (!$previous_date || ($start['yday'] != $previous_date['yday'] || $start['year'] != $previous_date['year']))
							echo $this->Bl->h5(array('class' => 'event_date'), array(), $this->Bl->date(array(), array('date' => $item['start'], 'format' => 'locale')));
					
						echo $this->Bl->span(array('class' => 'small'), array(), sprintf('%d:%02d&ndash;%d:%02d',$start['hours'],$start['minutes'],$end['hours'],$end['minutes']));
					
						echo $this->Bl->br();
					
						echo $this->Bl->sdiv(array('class' => 'event_item'));
							echo $this->Bl->h4Dry($item['name']);
							if (!empty($item['description']))
								echo $this->Bl->p(array('class' => 'small'), array(), $item['description']);
						echo $this->Bl->ediv();
						echo $this->Bl->br();
					
						$previous_date = $start;
					}
				}
				
				$data['ParticipationTextile']['html'] = trim($data['ParticipationTextile']['html']);
				if (!empty($data['ParticipationTextile']['html']))
				{
					echo $this->Bl->hr(array('class' => 'dotted'));
					echo $this->Bl->br();
					echo $this->Bl->h5Dry('Como participar');
					echo $data['ParticipationTextile']['html'];
				}
				
			echo $this->Bl->ebox();
			
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
	break;
	
	case 'full_grande_desafio':
		echo $this->Bl->h2Dry($data['MexcEvent']['name']);
		
		$date = $this->Bl->date(array(), 
			array(
				'begin' => $data['MexcEvent']['start'], 
				'end' => $data['MexcEvent']['end'], 
				'from' => true,
				'format' => 'event'
		));
		
		$class = 'column_date';
		echo $this->Bl->div(compact('class'), array(), $date);
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 9), 'type' => 'column_container'));
			
			// Event main body
			echo $this->Bl->sbox(array(), array('size' => array('M' => 5, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Bl->paraDry(array($data['MexcEvent']['summary']));
				if (!empty($data['MexcEvent']['img_id']))
					echo $this->Bl->img(array(), array('id' => $data['MexcEvent']['img_id'], 'version' => 'view'));
				
				echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_event'), $data['MexcEvent']['content_stream_id']);
				
				echo $this->Bl->br();
				
			echo $this->Bl->ebox();

			if (!empty($data['MexcEvent']['place_name']) || !empty($data['PlaceTextile']['html']))
			{
				// Dark box
				echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'dark_featured'));
					$place_name = $data['MexcEvent']['place_name'];
					if (!empty($data['MexcEvent']['place_url']))
						echo $this->Bl->a(array('class' => 'local', 'href' => $data['MexcEvent']['place_url']),array(), $place_name);
					else
						echo $this->Bl->h3Dry($place_name);
					echo $data['PlaceTextile']['html'];
				echo $this->Bl->ebox();
			}

			echo $this->Bl->sbox(array('class' => 'event_agenda'), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
				
				if (!empty($data['MexcEventItem']))
				{
					echo $this->Bl->h5Dry('Programação do evento');
					$previous_date = false;
					foreach ($data['MexcEventItem'] as $item)
					{
						$start = getdate(strtotime($item['start']));
						$end = getdate(strtotime($item['end']));
						if (!$previous_date || ($start['yday'] != $previous_date['yday'] || $start['year'] != $previous_date['year']))
							echo $this->Bl->h5(array('class' => 'event_date'), array(), $this->Bl->date(array(), array('date' => $item['start'], 'format' => 'locale')));
					
						echo $this->Bl->span(array('class' => 'small'), array(), sprintf('%d:%02d&ndash;%d:%02d',$start['hours'],$start['minutes'],$end['hours'],$end['minutes']));
					
						echo $this->Bl->br();
					
						echo $this->Bl->sdiv(array('class' => 'event_item'));
							echo $this->Bl->h4Dry($item['name']);
							if (!empty($item['description']))
								echo $this->Bl->p(array('class' => 'small'), array(), $item['description']);
						echo $this->Bl->ediv();
						echo $this->Bl->br();
					
						$previous_date = $start;
					}
				}
				
				$data['ParticipationTextile']['html'] = trim($data['ParticipationTextile']['html']);
				if (!empty($data['ParticipationTextile']['html']))
				{
					echo $this->Bl->hr(array('class' => 'dotted'));
					echo $this->Bl->br();
					echo $this->Bl->h5Dry('Como participar');
					echo $data['ParticipationTextile']['html'];
				}
				
			echo $this->Bl->ebox();
			
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
	break;
}
