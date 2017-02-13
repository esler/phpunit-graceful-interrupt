## Description
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

## Usage
Just hit `Ctrl+\` to interrupt running tests. Errors and failures from previous tests will be shown.

## License
MIT
