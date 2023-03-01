<?php
namespace Esler\PHPUnit\Listener;

use BadMethodCallException;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\Test;

/**
 * This class defines an extension for PHPUnit.
 *
 * It allows interrupt running test gracefully. By hitting Ctrl+\ (SIGQUIT)
 * you will let know to PHPUnit
 *
 * @author     Ondrej Esler <esler.ondrej@gmail.com>
 * @license    MIT
 */
class GracefulInterruptListener implements TestListener
{
    use TestListenerDefaultImplementation;

    /** @var Test */
    private $test;

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
     * @param Test  $test
     * @param float $time
     */
    public function endTest(Test $test, float $time): void {
        $this->test = $test;
        pcntl_signal_dispatch();
    }

}
