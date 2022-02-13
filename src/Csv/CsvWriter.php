<?php

namespace Pos\Csv;

class CsvWriter
{


    public $array;
    public $filePath;

    public function __construct($array)
    {

        $this->array = $array;
    }

    public function writeCsv($fileName)
    {
        $this->filePath = './data/' . $fileName . '.csv';
        $fp = fopen($this->filePath, 'a');

        foreach ($this->array as $row) {
            fputcsv(
                $fp,
                $row,
                ';'
            );
        }

        fclose($fp);
    }

}