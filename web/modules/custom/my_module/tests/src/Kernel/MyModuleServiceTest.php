<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\my_module\Service\MyModuleService;

/**
 * Test Kernel.
 *
 * @group my_module
 * @coversDefaultClass \Drupal\my_module\Service\MyModuleService
 */
class MyModuleServiceTest extends KernelTestBase {

  /**
   * The service under test.
   *
   * @var \Drupal\my_module\Service\MyModuleService
   */
  protected $myService;

  /**
   * The modules to load to run the test.
   *
   * @var array
   */
  public static $modules = [
    'my_module',
  ];

  /**
   * {@inheritdoc}
   */
  protected $strictConfigSchema = FALSE;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installConfig(['my_module']);

    $this->myService = new MyModuleService(TRUE);
  }

  /**
   * @covers ::isDummy
   */
  public function testIsDummy() {
    $this->assertEquals($this->myService->isDummy(), TRUE);
  }

}
