## What's is this?
A simple plug-in which allows to you interrupt running PHPUnit tests gracefully.

## Instalation
```bash
composer require --dev esler/phpunit-graceful-interrupt
```
Add listener to your `phpunit.xml`
```xml
<phpunit>
  <listeners>
    <listener class="Esler\PHPUnit\Listener\GracefulInterruptListener" />
  </listeners>
</phpunit>
```

## Why?
Is this familiar to you?

```
..........................................................   6756 / 13326 ( 50%)
...EEEEEEFF.F.E........
```

You're in the middle of running huge pack of tests but suddenly some unexpected
fails appears. What's now? You may wait until all tests finish but that may take
a lot of time. You may hit Ctrl+C but that will ends tests without message which
tell what's actually happened. Well here comes this plug-in handy. It will
allows to end tests immediately with all errors and fails which appeared.

## How to use it?
Just hit Ctrl+\ this will send current running process SIGQUIT POSIX signal and
it tells the plug-in to shutdown a testing. It'll complete current test and then
will shutdown.

## How it work?
Plug-in just register signal handling (trough PCNTL) before tests. Then after
each test check for any signal which was send to process and it do the shutdown
if so.

## License
MIT
