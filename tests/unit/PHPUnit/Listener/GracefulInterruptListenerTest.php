<?php
namespace Esler\PHPUnit\Listener;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\DataProvider;

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
     * @before
     */
    #[Before]
    protected function disableNestingProtection() {
        // disable nesting protection for ackermann function
        ini_set('xdebug.max_nesting_level', -1);
    }

    public static function provideRanges() : iterable {
        foreach (range(1, 3) as $m) {
            foreach (range(1, 11) as $n) {
                yield [$m, $n];
            }
        }
    }

    /**
     * @dataProvider provideRanges
     */
    #[DataProvider('provideRanges')]
    public function testAckermann(int $m, int $n) : void {
        $this->assertGreaterThan(0, $this->_ackermann($m, $n));
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
