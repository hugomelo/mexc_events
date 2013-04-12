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

echo $this->Bl->strongDry('Início');
echo $this->Bl->br();
echo $this->Bl->spanDry(date('d/m/Y - H:i', strtotime($data['MexcEventItem']['start'])));

echo $this->Bl->br();
echo $this->Bl->br();

echo $this->Bl->strongDry('Hora de fim');
echo $this->Bl->br();
echo $this->Bl->spanDry(date('d/m/Y - H:i', strtotime($data['MexcEventItem']['end'])));

echo $this->Bl->br();
echo $this->Bl->br();

echo $this->Bl->strongDry('Nome');
echo $this->Bl->br();
echo $this->Bl->spanDry($data['MexcEventItem']['name']);

echo $this->Bl->br();
echo $this->Bl->br();

echo $this->Bl->strongDry('Descrição');
echo $this->Bl->br();
echo $this->Bl->pDry($data['MexcEventItem']['description']);
