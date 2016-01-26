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

echo $this->element('header-read', array('title' => $event['MexcEvent']['name'], 'slug'=>'events'));

echo $this->Bl->floatBreak();
echo $this->Bl->srow(array('class' => 'pages news'));
	echo $this->Bl->hr(array('class' => 'col-xs-12'));
	
	echo $this->Bl->sdiv(array('class' => 'col-xs-12 col-md-3 meta'), array());
			if (date("m/Y", strtotime($event['MexcEvent']['start'])) == date("m/Y", strtotime($event['MexcEvent']['end'])))
				$date = date('\d\a\s H:m \a\t\é ', strtotime($event['MexcEvent']['start'])).date('H:m \d\e d/m/Y',strtotime($event['MexcEvent']['end']));
			else
				$date = date('\d\a\s H:m \d\e d/m/Y \a\té ', strtotime($event['MexcEvent']['start'])).date('H:m \d\e d/m/Y', strtotime($event['MexcEvent']['end']));

		echo $this->Bl->div(array(), array(), $date);
		if (!empty($event['MexcEvent']['place_name'])) {
			echo $this->Bl->div(array(), array(), 
			"Local: ".$event['MexcEvent']['place_name']);
		}
		if (!empty($event['MexcEvent']['place_url'])) {
			echo $this->Bl->div(array(), array(), 
			$this->Bl->anchor(array('target' => '_blank'), array('url' => $event['MexcEvent']['place_url']),
				$event['MexcEvent']['place_url']));
		}
	echo $this->Bl->hr(array('class' => 'meta'));
		if (isset($event['Tag'])) {
			foreach($event['Tag'] as $tag) {
				echo $this->Bl->anchor(array(), array('url' => '/tag/'.$tag['keyname']), $tag['name']);
				if ($tag != end($event['Tag'])) echo ", ";
			}
			echo $this->Bl->hr(array('class' => 'meta'));
		}
	echo $this->Bl->ediv();
	echo $this->Bl->sdiv(array('class' => 'col-xs-12 col-md-9'), array());
		echo $this->Bl->srow(array('class' => ''));
			echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_event'), $event['MexcEvent']['content_stream_id']);
		echo $this->Bl->erow();
	echo $this->Bl->ediv();
	echo $this->Bl->hr(array('class' => 'col-xs-12'));

echo $this->Bl->erow();
	
	

if (!empty($news))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
		echo $this->Bl->h5Dry('Novidades deste evento');
		echo $this->Bl->hr(array('class' => 'dotted'));
		
		foreach ($news as $new)
		{
			echo $this->Jodel->insertModule('MexcNews.MexcNew', array('two_lines'), $new);
			echo $this->Bl->hr(array('class' => 'dotted'));
		}
		
	echo $this->Bl->ebox();
}

if (!empty($galleries))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
		echo $this->Bl->h5Dry('Galerias deste evento');
		echo $this->Bl->hr(array('class' => 'dotted'));
		
		foreach ($galleries as $gallery)
		{
			echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('mini_column'), $gallery);
			echo $this->Bl->hr(array('class' => 'dotted'));
		}
		
	echo $this->Bl->ebox();
}

if (!empty($documents))
{
	echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
		echo $this->Bl->h5Dry('Documentos deste evento');
		echo $this->Bl->hr(array('class' => 'dotted'));
		
		foreach ($documents as $document)
		{
			echo $this->Jodel->insertModule('MexcDocuments.MexcDocument', array('...'), $document);
			echo $this->Bl->hr(array('class' => 'dotted'));
		}
		
	echo $this->Bl->ebox();
}
