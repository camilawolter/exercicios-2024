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
   * Extracts paper info from HTML to an array
   */
  public function scrap(\DOMDocument $dom): array
  {
    $xPATH  = new \DOMXPath($dom);
    $papers = [];

    $titleElements = $xPATH->query('//*[@class="my-xs paper-title"]');
    $authorsElements = $xPATH->query('//*[@class="authors"]');
    $idElements = $xPATH->query('//*[@class="volume-info"]');
    $postTypeElements = $xPATH->query('//*[@class="tags mr-sm"]');

    // Itera sobre os elementos identificados no DOM.
    for ($i = 0; $i < $idElements->length; $i++) {
      $postId = $idElements->item($i)->textContent;
      $title = $titleElements->item($i)->textContent;
      $type = $postTypeElements->item($i)->textContent;

      // Extrai e organiza os autores do artigo.
      $authors = $this->extractAuthors($authorsElements->item($i), $postId);

      // Cria um objeto Paper com os dados extraídos e adiciona ao array.
      $papers[] = new Paper($postId, $title, $type, $authors);
    }

    // Filtra e retorna o array de papers
    return array_filter($papers);
  }


   /**
   * Extrai e organiza os autores de um artigo.
   */
  private function extractAuthors(\DOMNode $authorsNode, string $postId): array
  {
    $authors = [];

    // Itera sobre os elementos span dentro do elemento dos autores.
    foreach ($authorsNode->getElementsByTagName('span') as $authorSpan) {
      $authorInstitution = '';

      // Verifica se o elemento span tem o atributo 'title' (instituição do autor).
      if ($authorSpan->hasAttribute('title')) {
        $authorInstitution = $authorSpan->getAttribute('title');
      }

      // Extrai e limpa o nome do autor.
      $authorName = preg_replace('/\s+/', ' ', $authorSpan->textContent);

      // Cria um objeto Person representando o autor.
      $authors[] = new Person($authorName, $authorInstitution, $postId);
    }

    return $authors;
  }
}
