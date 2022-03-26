<?php

namespace Drupal\Tests\my_module\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Defines the FrontPageLinkTest class.
 *
 * @package Drupal\Tests\my_module\Functional
 * @group my_module
 */
class FrontPageLinkTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['node', 'block', 'user'];

  /**
   * Our node type.
   *
   * @var \Drupal\node\Entity\NodeType
   */
  protected $contentType;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    // Always call the parent setUp().
    parent::setUp();
    // Add the Tools menu block, as provided by the Block module.
    $this->placeBlock('system_menu_block:tools');
    // Add a content type.
    $this->contentType = $this->createContentType();
  }

  /**
   * Tests for the existence of a default menu item on the home page.
   *
   * We'll open the home page and look for the Tools menu link called 'Add
   * content.'
   */
  public function testAddContentMenuItem() {
    // Step 1: Log in a user who can add content.
    $this->drupalLogin(
      $this->createUser([
        'create ' . $this->contentType->id() . ' content',
      ])
    );

    // Step 2: Visit the home path.
    $this->drupalGet($this->buildUrl(''));
    // Step 3: Look on the page for the 'Add content' link.
    $this->assertSession()->linkExists('Add content');
  }

}
