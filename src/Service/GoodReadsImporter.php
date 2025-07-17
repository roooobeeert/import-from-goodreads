<?php 
namespace Rober\ImportFromGoodreads\Service;
// Maybe change to roooobeeert


class GoodReadsImporter
{
    
    public function import_goodreads(string $csvFile): array
    {
        // Opening file
        if (!file_exists($csvFile)){
            throw new \InvalidArgumentException("File not found: $csvFile");
        }

        $books = [];
        
        if(($handle = fopen($csvFile, 'r')) != false){
            $header = fgetcsv($handle);

            // Right now only title, author, year published, later maybe more flexible if I have time  
            $titleIndex = array_search('Title', $header);
            $authorIndex = array_search('Author', $header);
            $yearIndex = array_search('Year Published', $header);


            if ($titleIndex === false || $authorIndex === false || $yearIndex === false){

                throw new \RuntimeException("Needed attributes are missing in the export file. Check your csv or changes in the export functionality from goodreads");   
            }

            while(($row = fgetcsv($handle)) !== false){
                $books[] = [
                    'title' => $row[$titleIndex],
                    'author' => $row[$authorIndex],
                    'release_year' => $row[$yearIndex],
                ];
            }
            fclose($handle);

        }

        return $books;
    }
}