<?php

namespace Drupal\Tests\my_module\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Tests Functional Javascript.
 *
 * @group action
 */
class MyModuleFunctionalJavascriptTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['node'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'bartik';

  /**
   * Tests the homepage, no specific js here.
   */
  public function testHomepage() {
    $this->drupalGet('<front>');
    $this->createScreenshot(\Drupal::root() . '/../reports/screenshot.jpg');
    $this->assertFileExists(\Drupal::root() . '/../reports/screenshot.jpg');

    $session = $this->getSession();
    $assert_session = $this->assertSession();
    $page = $session->getPage();

    $this->drupalGet('<front>');
    $this->createScreenshot(\Drupal::root() . '/../reports/screenshot2.jpg');
    $this->assertFileExists(\Drupal::root() . '/../reports/screenshot2.jpg');

    $button = $page->findButton('Log in');
    $this->assertTrue($button->isVisible());
  }

}
