<?php
namespace Esler\PHPUnit\Listener;

use BadMethodCallException;
use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_Test;

/**
 * This class defines an extension for PHPUnit.
 *
 * It allows interrupt running test gracefully. By hitting Ctrl+\ (SIGQUIT)
 * you will let know to PHPUnit
 *
 * @author     Ondrej Esler <esler.ondrej@gmail.com>
 * @license    MIT
 */
class GracefulInterruptListener extends PHPUnit_Framework_BaseTestListener
{

    /**
     * Constructor
     */
    public function __construct() {
        if (!function_exists('pcntl_signal')) {
            throw new BadMethodCallException('PCNTL is disabled');
        }

        pcntl_signal(SIGQUIT, function () {
            $this->test->getTestResultObject()->stop();
        });
    }

    /**
     * A test ended.
     *
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time) {
        $this->test = $test;
        pcntl_signal_dispatch();
    }

}
