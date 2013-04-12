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

echo $this->Bl->sbox(array(), array('size' => array('M' => 9, 'g' => -1), 'type' => 'cloud'));

	echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('full'), $event);
	
	echo $this->Bl->hr(array('class' => 'double'));
	
	// @todo Thread of comments.
	
echo $this->Bl->ebox();

echo $this->Bl->sbox(array('class' => 'more_content'), array('type' => 'sky', 'size' => array('M' => 3, 'g' => -1)));
	// @todo Link to the right place
	echo $this->Bl->anchor(
		array('class' => 'non_visitable'), 
		array('url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_event', 'action' => 'index')),
		'Outros eventos'
	);
echo $this->Bl->ebox();


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
