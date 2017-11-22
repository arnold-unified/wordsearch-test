<?php

require 'vendor/autoload.php';
require_once('app/Data.php');

use WordSearch\Factory as WSFactory;
use WordSearch\Transformer\HtmlTransformer as WSHtmlTransformer;

/** Get states data */
$data = new Data(); // args: name (default), capital, abbreviation
$words = $data->parse()->get();

/** Initialize and generate puzzle */
$puzzle = WSFactory::create($words);
$transformer = new WSHtmlTransformer($puzzle);

/** Display puzzle */
echo $transformer->grid();
echo count($words);
echo $transformer->wordList();