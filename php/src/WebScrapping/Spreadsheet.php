<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

use Exception;

class Spreadsheet{
  public function createSpreadsheet(array $papers): void{
    try {
      $filePath = __DIR__ . '/../../assets/result.xlsx';
      $writer = WriterEntityFactory::createXLSXWriter();
      $writer->openToFile($filePath);

      // Estilo do cabeçalho da tabela.
      $headerStyle = (new StyleBuilder())
        ->setFontBold()
        ->setFontName('Arial')
        ->setFontSize(10)
        ->setCellAlignment(CellAlignment::LEFT)
        ->build();

      // Cabeçalho da tabela.
      $headerCells = [
        'ID', 'Title', 'Type',
        'Author 1', 'Author 1 Institution',
        'Author 2', 'Author 2 Institution',
        'Author 3', 'Author 3 Institution',
        'Author 4', 'Author 4 Institution',
        'Author 5', 'Author 5 Institution',
        'Author 6', 'Author 6 Institution',
        'Author 7', 'Author 7 Institution',
        'Author 8', 'Author 8 Institution',
        'Author 9', 'Author 9 Institution',
      ];

      $headerRow = WriterEntityFactory::createRowFromArray($headerCells, $headerStyle);
      $writer->addRow($headerRow);

      // Estilo padrão para as células.
      $defaultStyle = (new StyleBuilder())
        ->setFontName('Arial')
        ->setFontSize(10)
        ->setCellAlignment(CellAlignment::LEFT)
        ->setShouldWrapText()
        ->build();

      // Preenchendo a planilha com os dados.
      foreach ($papers as $paper) {
        $valueCells = [];
        $valueCells[] = $paper->id;
        $valueCells[] = $paper->title;
        $valueCells[] = $paper->type;

        foreach ($paper->authors as $author) {
          $valueCells[] = str_replace(';', '', $author->name);
          $valueCells[] = $author->institution;
        }

        $valueRow = WriterEntityFactory::createRowFromArray($valueCells, $defaultStyle);
        $writer->addRow($valueRow);
      }

      $writer->close();
      print_r("Planilha criada com sucesso");
      } catch (Exception $e) {
        print_r("Ocorreu um erro: " . $e->getMessage());
      }

    }
}
