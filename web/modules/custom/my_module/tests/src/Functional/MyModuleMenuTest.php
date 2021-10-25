<?php

namespace Drupal\Tests\my_module\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test the user-facing menus.
 *
 * @ingroup my_module
 *
 * @group my_module
 * @group examples
 */
class MyModuleMenuTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['my_module'];

  /**
   * The installation profile to use with this test.
   *
   * We need the 'minimal' profile in order to make sure the Tool block is
   * available.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * Verify and validate that default menu links were loaded for this module.
   */
  public function testTestingNavigation() {
    foreach (['' => '/testing'] as $page => $path) {
      $this->drupalGet($page);
      $this->assertSession()->linkByHrefExists($path);
    }
    $this->drupalGet('/testing');
    $this->assertResponse(200);
  }

}
