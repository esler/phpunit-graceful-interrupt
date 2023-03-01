<?php
namespace Esler\PHPUnit;

use PHPUnit\Event\Test\PreparedSubscriber;
use PHPUnit\Event\Test\Prepared;
use PHPUnit\Framework\Assert;

/**
 * This class defines an extension for PHPUnit.
 *
 * It allows interrupt running test gracefully. By hitting Ctrl+\ (SIGQUIT)
 * you will let know to PHPUnit
 *
 * @author     Ondrej Esler <esler.ondrej@gmail.com>
 * @license    MIT
 */
final class GracefulInterruptSubscriber implements PreparedSubscriber
{
    public bool $interrupted = false;

    public function notify(Prepared $event): void
    {
        pcntl_signal_dispatch();

        if ($this->interrupted) {
            Assert::markTestSkipped('Skipped by ' . $this::class);
        }
    }
}
