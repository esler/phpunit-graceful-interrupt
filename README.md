## Description
A simple plug-in which allows to you interrupt running PHPUnit tests **gracefully**.

## Instalation
```bash
composer require --dev esler/phpunit-graceful-interrupt
```

#### For PHPUnit >= 10
```xml
Add extension to your `phpunit.xml`
<phpunit>
    <extensions>
        <bootstrap class="Esler\PHPUnit\GracefulInterruptExtension" />
    </extensions>
</phpunit>
```

#### For PHPUnit < 10
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

More [info](https://github.com/esler/phpunit-graceful-interrupt/wiki).

## License
MIT
