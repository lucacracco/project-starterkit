<?php

namespace Drupal\my_module\Service;

/**
 * Defines the MyModuleService class.
 *
 * @package Drupal\my_module\Service
 */
class MyModuleService {

  /**
   * Dummy thing.
   *
   * @var bool
   */
  protected $dummy;

  /**
   * Constructs a MyModuleService object.
   *
   * @codeCoverageIgnore
   */
  public function __construct(bool $dummy) {
    $this->dummy = $dummy;
  }

  /**
   * Retrieves the dummy!
   *
   * @return bool
   *   The dummy!
   */
  public function isDummy() {
    return $this->dummy;
  }

}
