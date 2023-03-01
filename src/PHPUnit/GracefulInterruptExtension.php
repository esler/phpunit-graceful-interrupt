<?php
namespace Esler\PHPUnit;

use BadMethodCallException;
use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

/**
 * This class defines an extension for PHPUnit.
 *
 * It allows interrupt running test gracefully. By hitting Ctrl+\ (SIGQUIT)
 * you will let know to PHPUnit
 *
 * @author     Ondrej Esler <esler.ondrej@gmail.com>
 * @license    MIT
 */
final class GracefulInterruptExtension implements Extension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        if (!function_exists('pcntl_signal')) {
            throw new BadMethodCallException('PCNTL is disabled');
        }

        $facade->registerSubscriber($subscriber = new GracefulInterruptSubscriber());

        pcntl_signal(SIGQUIT, static function () use ($subscriber)  {
            $subscriber->interrupted = true;
        });
    }
}
