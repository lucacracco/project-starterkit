<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  /**
   * Force use account mail of test for new installation.
   *
   * @hook init install
   */
  public function initInstallCommand(\Symfony\Component\Console\Input\InputInterface $input, \Consolidation\AnnotatedCommand\AnnotationData $annotationData) {
    $input->setOption('mail', 'admin@localhost.loc');
  }

}