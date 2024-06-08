<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    $xpath = new DOMXPath($dom);

    $papers = [];
    $authors = [];

    $titleElements = $xPATH->query('//*[@class="my-xs paper-title"]');
    $authorsElements = $xPATH->query('//*[@class="authors"]');
    $idElements = $xPATH->query(('//*[@class="volume-info"]'));
    $postTypeElements = $xPATH->query(('//*[@class="tags mr-sm"]'));

  }

}
