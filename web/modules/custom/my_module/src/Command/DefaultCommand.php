<?php

namespace Drupal\my_module\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;

/**
 * Class DefaultCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="my_module",
 *     extensionType="module"
 * )
 */
class DefaultCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('my_module:default')
      ->setDescription($this->trans('commands.my_module.default.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('Example command');
  }

}
