<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person {

  /**
   * Person name.
   * @var string
   */
  public string $name;

  /**
   * Person institution.
   * @var string
   */
  public string $institution;

  /**
   * Builder.
   * @var string
   */
  public $postId;

  /**
   * Post id.
   * @param string $name
   * @param string $institution
   * @param string $postId
   */
  public function __construct($name, $institution, $postId) {
    $this->name = $name;
    $this->institution = $institution;
    $this->postId = $postId;
  }

}
