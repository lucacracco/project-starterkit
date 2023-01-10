<?php

use Consolidation\AnnotatedCommand\CommandData;

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
    $task = $this->taskExec('./vendor/bin/behat')
      ->option('config', './behat/behat.yml');
    if (!empty($tags)) {
      $task->option('tags', implode(' ', $tags));
    }
    return $task->run();
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
    $task_list = [
      'createFolder' => $this->taskFilesystemStack()
        ->mkdir('./reports'),
      'permissionsFolder' => $this->taskFilesystemStack()
        ->chmod('./reports', 0775),
    ];

    $task_phpqa = $this->taskExec('./vendor/bin/phpqa')
      ->option('config', './.phpqa');
    if (!empty($tools)) {
      $task_phpqa->option('tools', implode(' ', $tools));
    }

    $task_list['executePhpQA'] = $task_phpqa;
    return $this->getBuilder()->addTaskList($task_list)->run();
  }

  /**
   * Create a custom folder private/logs.
   *
   * @hook post-command scaffold
   */
  public function postScaffoldCommand($result, CommandData $commandData) {
    $private_folder = "private/default";
    $task_list = [
      'createPrivateFolder' => $this->taskFilesystemStack()
        ->mkdir($private_folder),
      'createLogsFolder' => $this->taskFilesystemStack()
        ->mkdir("{$private_folder}/logs"),
    ];
    $this->getBuilder()->addTaskList($task_list)->run();
  }

}