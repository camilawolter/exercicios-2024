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

     /**
     * Constructor.
     *
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
