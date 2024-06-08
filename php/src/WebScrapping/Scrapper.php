<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */



class Scrapper
{

  /**
   * Loads paper information from the HTML and returns the array with the Element.
   */
  public function scrap(\DOMDocument $dom): array
  {
    $xPATH  = new \DOMXPath($dom);
    $papers = [];

    $titleElements = $xPATH->query('//*[@class="my-xs paper-title"]');
    $authorsElements = $xPATH->query('//*[@class="authors"]');
    $idElements = $xPATH->query('//*[@class="volume-info"]');
    $postTypeElements = $xPATH->query('//*[@class="tags mr-sm"]');

    // itera sobre os elementos identificados no DOM
    for ($i = 0; $i < $idElements->length; $i++) {
      $postId = $idElements->item($i)->textContent;
      $title = $titleElements->item($i)->textContent;
      $type = $postTypeElements->item($i)->textContent;

      // extrai e organiza os autores do artigo
      $authors = $this->extractAuthors($authorsElements->item($i), $postId);

      // cria um objeto Paper com os dados extraídos e adiciona ao array de papers
      $papers[] = new Paper($postId, $title, $type, $authors);
    }

    // filtra e retorna o array de papers
    return array_filter($papers);
  }

   /**
   * extrai e organiza os autores de um artigo.
   */

  private function extractAuthors(\DOMNode $authorsNode, string $postId): array
  {
    $authors = [];

    // itera sobre os elementos span dentro do elemento dos autores
    foreach ($authorsNode->getElementsByTagName('span') as $authorSpan) {
      $authorInstitution = '';

      // verifica se o elemento span tem o atributo 'title' (instituição do autor)
      if ($authorSpan->hasAttribute('title')) {
        $authorInstitution = $authorSpan->getAttribute('title');
      }

      // extrai e limpa o nome do autor
      $authorName = preg_replace('/\s+/', ' ', $authorSpan->textContent);

      // cria um objeto Person representando o autor
      $authors[] = new Person($authorName, $authorInstitution, $postId);
    }

    return $authors;
  }
}