<?php

namespace Devmamun\LocalizationFinder;

class Finder
{
    private $list = [];

    private $text = '';

    private $arr = [];

    private $time;

    private $importLocation;

    private $identifier;

    private $exportLocation;

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setExportLocation($export)
    {
        $this->exportLocation = $export;

        return $this;
    }

    public function setImportLocation($import)
    {
        $this->importLocation = $import;

        return $this;
    }

    private function generateIdentifier($identifier, $line)
    {
        $position = strpos($identifier, '(');
        $identifier = substr($identifier, 0, $position);

        $identifier = str_replace(
            ['_'],
            ['\_'],
            $identifier
        );
        
        preg_match_all('#' . $identifier . '\([\'\"](.*?)[\'\"][( ,),\)]#', $line, $match);

        return $match;
    }

    private function getIdentifier($line)
    {
        $identifier = explode(',', $this->identifier);

        $data = [];
        foreach ($identifier as $value) {
            $value = trim($value);
            $data[] = $this->generateIdentifier($value, $line);
        }
        
        return $data;
    }

    private function scanFolderFiles($dir)
    {
        $directories = scandir($dir);

        unset($directories[array_search('.', $directories, true)]);
        unset($directories[array_search('..', $directories, true)]);
        
        // prevent empty ordered elements
        if (count($directories) < 1) return;

        foreach ($directories as $file) {
            if (file_exists($dir . '/' . $file) && !is_dir($dir . '/' . $file)) {
                $this->list[] = $dir . '/' . $file;
            }
            if (is_dir($dir . '/' . $file)) $this->scanFolderFiles($dir . '/' . $file);
        }
    }

    private function formatJsonText($value)
    {
        $this->text .= '    "' . $value . '": "' . $value . '",' . "\n";
    }

    private function formatJsonFile()
    {
        $text = str_replace("\'", "'", $this->text);

        $text = "{\n" . $text . "}";
        $this->text = str_replace(",\n}", "\n}", $text);
    }

    private function readFile($file)
    {
        $file = fopen($file, 'r');

        while ($line = fgets($file)) {
            foreach ($this->getIdentifier($line) as $data) {
                foreach ($data[1] as $value) {
                    if (!in_array($value, $this->arr)) {
                        $this->arr[] = $value;

                        $this->formatJsonText($value);
                    }
                }
            }
        }

        fclose($file);
    }

    private function progressBar($current, $total)
    {
        $fileData = [
            'file_counter' => $current,
            'total_files' => $total
        ];

        if ($this->time < time() - 2) {
            $this->time = time();
            file_put_contents(__DIR__ . "/../../assets/file/file.txt", json_encode($fileData));
        }
    }

    public function execute() {
        ini_set('max_execution_time', 10000);

        $this->scanFolderFiles($this->importLocation);
        
        $count = 1;
        $this->time = time();
        $totalFiles = count($this->list);
        foreach ($this->list as $file) {
            $this->progressBar($count++, $totalFiles);

            if (filesize($file) > 100000) {
                continue;
            }

            $this->readFile($file);
        }

        $this->formatJsonFile();
        
        file_put_contents($this->exportLocation, $this->text);
        unlink(__DIR__ . "/../../assets/file/file.txt");
    }
}
