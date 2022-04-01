<?php

namespace Drupal\monolog_ext\Logger\Handler;

use Drupal\Core\File\FileSystemInterface;
use Monolog\Handler\RotatingFileHandler as OriginalRotatingFileHandler;

/**
 * Custom RotatingFileHandler.
 *
 * This overridden check and prepare the log directory.
 *
 * @package Drupal\monolog_ext\Logger\Handler
 */
class RotatingFileHandler extends OriginalRotatingFileHandler {

  /**
   * {@inheritDoc}
   *
   * @psalm-suppress ImplementedParamTypeMismatch
   * @phpstan-ignore-next-line
   */
  protected function write(array $record): void {

    if (isset($this->url)) {
      // Checks that the directory log exists and is writable.
      $dir = dirname($this->url);
      // We can't inject service because will be thrown a circular reference.
      \Drupal::service('file_system')
        ->prepareDirectory($dir, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);
    }

    parent::write($record);
  }

}
