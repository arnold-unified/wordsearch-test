<?php

require 'vendor/autoload.php';
require_once('app/Data.php');
require_once('app/DataTransformer.php');

use WordSearch\Factory as WSFactory;
use WordSearch\Transformer\HtmlTransformer as WSHtmlTransformer;

/** Get states data */
$data = new Data(); // args: name (default), capital, abbreviation
$words = $data->parse()->trim()->get();

/** Initialize and generate puzzle */
$puzzle = WSFactory::create($words);
// $transformer = new DataTransformer($puzzle);

/** Display puzzle */
// echo $transformer->displayGrid();
// echo $transformer->displayWordList();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Word Search</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" 
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
              crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2>US States</h2>
                    <br>
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            foreach ($puzzle->toArray() as $row) {
                                echo "<tr>\n";
                                foreach ($row as $cell) {
                                    echo sprintf("<td class=\"text-center\">%s</td>\n", $cell);
                                }
                                echo "</tr>\n";
                            }
                            ?>
                        </tbody>
                    </table>

                    <br>
                    <h3>Answers</h3>
                    <div class="panel panel-default">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">State Name</th>
                                    <th class="text-center">Row</th>
                                    <th class="text-center">Column</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($puzzle->getWordList() as $word) {
                                    echo "<tr>";
                                    echo sprintf("<td>%s</td>", $word->word);
                                    echo sprintf("<td>%s</td>", $word->row);
                                    echo sprintf("<td>%s</td>", $word->column);
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
                crossorigin="anonymous"></script>
    </body>
</html>