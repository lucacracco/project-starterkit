<?php

namespace Drupal\module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example of controller.
 *
 * @package Drupal\module\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return Hello render array.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): $name'),
    ];
  }

}
