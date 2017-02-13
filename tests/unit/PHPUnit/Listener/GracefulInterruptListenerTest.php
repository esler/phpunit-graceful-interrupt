<?php
namespace Esler\PHPUnit\Listener;

use PHPUnit\Framework\TestCase;

/**
 * Fake test suite with some long tests. It servers like demonstration
 * of listener's feature. Try hit Ctrl+\. Process will not goes into background
 * but it will complete current test and then gracefully stop testing
 * and prints the result.
 *
 * @author     Ondrej Esler <esler.ondrej@gmail.com>
 * @license    MIT
 */
class GracefulInterruptListenerTest extends TestCase
{

    /**
     * Init before test
     *
     * @return void
     */
    protected function setUp() {
        // disable nesting protection for ackermann function
        ini_set('xdebug.max_nesting_level', -1);
    }

    /**
     * Test with fail
     *
     * @return void
     */
    public function testFail() {
        $this->fail('Deliberately failed...');
    }

    /**
     * Test with error
     *
     * @return void
     */
    public function testError() {
        throw new \Exception('An exception...');
    }

    /**
     * Some very long test
     *
     * @return void
     */
    public function testAckermann310() {
        self::assertEquals(8189, $this->_ackermann(3, 10));
    }

    /**
     * Some very long test
     *
     * @return void
     */
    public function testAckermann311() {
        self::assertEquals(16381, $this->_ackermann(3, 11));
    }

    private function _ackermann($m, $n) {
        if ($m == 0) {
            return $n + 1;
        } elseif ($n == 0) {
            return $this->_ackermann($m - 1, 1);
        }

        return $this->_ackermann($m - 1, $this->_ackermann($m, $n -1));
    }

}
