<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  /**
   * Force use locale=it and account mail of wellnet for new installation.
   *
   * @hook init install
   */
  public function initInstallCommand(\Symfony\Component\Console\Input\InputInterface $input, \Consolidation\AnnotatedCommand\AnnotationData $annotationData) {
    $input->setOption('locale', 'it');
    $input->setOption('mail', 'admin@localhost.loc');
  }

}