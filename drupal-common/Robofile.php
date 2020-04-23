<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  /**
   * Compute various metrics.
   *
   * @command analyze
   */
  public function analyze() {
    return $this->taskExec('vendor/bin/phpqa');
  }

}