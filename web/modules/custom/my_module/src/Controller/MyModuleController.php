<?php

namespace Drupal\my_module\Controller;

/**
 * Defines the MyModuleController class.
 *
 * @package Drupal\my_module\Controller
 */
class MyModuleController {

  /**
   * Generate a render array for the description.
   *
   * @return array
   *   A render array.
   */
  public function description() {
    $template_file = \Drupal::service('extension.list.module')
      ->getPath('my_module') . '/templates/description.html.twig';
    $build = [
      'description' => [
        '#type' => 'inline_template',
        '#template' => file_get_contents($template_file),
      ],
    ];
    return $build;
  }

}
