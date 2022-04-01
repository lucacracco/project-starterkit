<?php

namespace Drupal\monolog_ext;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Monolog\Handler\RotatingFileHandler;

/**
 * Overrides the logger.handler which uses RotatingFileHandler.
 */
class MonologExtServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritDoc}
   */
  public function alter(ContainerBuilder $container) {
    // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UnusedVariable
    foreach ($container->getDefinitions() as $definition_id => $definition) {
      if ($definition->getClass() == RotatingFileHandler::class) {
        // phpcs:ignore Drupal.Classes.FullyQualifiedNamespace.UseStatementMissing
        $definition->setClass(\Drupal\monolog_ext\Logger\Handler\RotatingFileHandler::class);
      }
    }
  }

}
