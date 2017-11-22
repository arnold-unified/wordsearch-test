<?php

class Data {

    protected $words;
    protected $field;
    const NAME = 1;
    const CAPITAL = 2;
    const ABBREVIATION = 3;

    public function __construct($field = 'name')
    {
        $this->words = [];
        $this->field = $field;
    }
    
    public function parse()
    {
        $row = 1;
        if (($handle = fopen("./us_states.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $this->words[] = $data[$this->getFieldIndex()];
            }
            fclose($handle);
        }

        return $this;
    }

    public function trim()
    {
        $newWords = array_map(
            function($word) {
                return preg_replace('/\s+/', '', $word);
            }, 
            $this->words
        );

        $this->words = $newWords;

        return $this;
    }

    public function get()
    {
        return $this->words;
    }

    private function getFieldIndex()
    {
        if ($this->field == 'name') return self::NAME;
        if ($this->field == 'capital') return self::CAPITAL;
        if ($this->field == 'abbreviation') return self::ABBREVIATION;
    }

}