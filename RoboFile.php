<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  /**
   * Run Behat test.
   *
   * @param string $config
   * @param null[] $options
   *
   * @return \Robo\Result
   */
  public function behat($config = './behat/behat.yml', $options = ['tags' => NULL]) {
    $behat_task = $this->taskExec('./vendor/bin/behat')
      ->option('config', $config);
    if ($options['tags']) {
      $behat_task->option('tags', $options['tags']);
    }
    return $behat_task->run();
  }

  /**
   * Force use account mail of test for new installation.
   *
   * @hook init install
   */
  public function initInstallCommand(\Symfony\Component\Console\Input\InputInterface $input, \Consolidation\AnnotatedCommand\AnnotationData $annotationData) {
    $input->setOption('mail', 'admin@localhost.loc');
  }

}
