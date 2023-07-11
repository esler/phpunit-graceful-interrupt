<?php
namespace Esler\PHPUnit;

use PHPUnit\Event\Test\PreparationStartedSubscriber;
use PHPUnit\Event\Test\PreparationStarted;
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
final class GracefulInterruptSubscriber implements PreparationStartedSubscriber
{
    public bool $interrupted = false;

    public function notify(PreparationStarted $event): void
    {
        pcntl_signal_dispatch();

        if ($this->interrupted) {
            Assert::markTestSkipped('Skipped by ' . $this::class);
        }
    }
}
