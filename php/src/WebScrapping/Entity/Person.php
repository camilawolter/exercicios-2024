<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person {

  /**
   * Person name.
   */
  public string $name;

  /**
   * Person institution.
   */
  public string $institution;

  /**
   * Builder.
   */

   public $postId;

  public function __construct($name, $institution, $postId) {
    $this->postId;
    $this->name = $name;
    $this->institution = $institution;
  }

}
