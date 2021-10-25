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

  /**
   * PhpUnit test.
   *
   * @param array $args
   *   Sometimes you need to pass arguments from your command into a task.
   *   A command line after the -- delimiter is passed as a single parameter
   *   containing all of the following arguments. Any special characters such
   *   as - will be passed into without change.
   *
   * @command phpunit
   */
  public function phpUnit(array $args) {
    $phpunit_task = $this->taskPhpUnit('./vendor/bin/phpunit');
    foreach ([
               './phpunit.xml',
               './phpunit.xml.dist',
               './web/phpunit.xml',
               './web/phpunit.xml.dist',
               './web/core/phpunit.xml.dist',
             ] as $file) {
      if (file_exists($file)) {
        $phpunit_task->configFile(realpath($file));
        break;
      }
    }
    return $phpunit_task->args($args)->run();
  }

}
