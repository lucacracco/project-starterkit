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
   * @param array $tags
   *   Tags of test to run.
   *
   * @return \Robo\Result
   */
  public function behat(array $tags) {
    return $this->taskExec('./vendor/bin/behat')
      ->option('config', './behat/behat.yml')
      ->option('tags', implode(' ', $tags))->run();
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

    if ($browsertest_output_directory = getenv('BROWSERTEST_OUTPUT_DIRECTORY')) {
      $this->taskFilesystemStack()
        ->mkdir($browsertest_output_directory, 0777)
        ->chmod($browsertest_output_directory, 0777, 0000, TRUE)
        ->run();
    }

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

  /**
   * Run PHPQA test.
   *
   * @return \Robo\Result
   */
  public function phpqa(array $tools) {
    return $this->taskExec('./vendor/bin/phpqa')
      ->option('config', './phpqa')
      ->option('tools', implode(' ', $tools))->run();
  }

}