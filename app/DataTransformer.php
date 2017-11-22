<?php

class DataTransformer {

    protected $puzzle;
    
    public function __construct($puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function displayGrid()
    {
        $html = "<table class=\"word-search\">\n";
        
        foreach ($this->puzzle->toArray() as $row) {
            $html .= "<tr>\n";
            foreach ($row as $cell) {
                $html .= sprintf("<td>%s</td>\n", $cell);
            }
            $html .= "</tr>\n";
        }

        $html .= "</table>\n";

        return $html;
    }

    public function displayWordList()
    {
        $html = "<ul>\n";

        foreach ($this->puzzle->getWordList() as $word) {
            $html .= sprintf(
                "<li>%s (row: %s, column: %s)</li>\n",
                $word->word, $word->row, $word->column
            );
        }

        $html .= "</ul>\n";

        return $html;
    }

}