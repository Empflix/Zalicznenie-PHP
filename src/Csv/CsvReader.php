<?php

namespace Pos\Csv;

class CsvReader
{

    private string $filePath;

    public function __construct($fileName)
    {
        $this->filePath = './data/' . $fileName . '.csv';
    }


    public function readCsv($separator=';'):array
    {

        $content = file($this->filePath);
        $csv = array();
        foreach ($content as $line) {
            $csv[] = str_getcsv($line, $separator);
        }


        return $csv;

    }


}