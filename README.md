# WIP: Magento 2 Utils

A set of Magento utils to speed up development.

#### Installation within a Magento 2 project
To use within your Magento 2 project you can use:
````
composer require sqlexception/magento2-utils "dev-master as 1.0.0" --prefer-source --ignore-platform-reqs
````
### Usage
Once installed, you can run ...

#### Module Config integration test

````php
<?php

namespace Demo\Module\Test\Integration;

use SqlException\Utils\Test\Integration\Traits\ModuleConfigTestTrait;

/**
 * Class ModuleConfigTest
 *
 * @package Demo\Module\Test\Integration
 */
class ModuleConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string current module name to test
     */
    public static $moduleName = 'Demo_Module';

    use ModuleConfigTestTrait;

    // your custom tests
}
````
#### Crontab Config integration test

`````php
<?php

namespace Demo\Module\Test\Integration\Cron\Crontab;


use SqlException\Utils\Test\Integration\Traits\CrontabConfigTestTrait;
use Demo\Module\Cron\Sample;

/**
 * Class SampleCrontabConfigTest
 *
 * @package Demo\Module\Test\Integration\Cron\Crontab
 */
class SampleCrontabConfigTest extends \PHPUnit\Framework\TestCase
{
    public static $jobGroup = 'custom_or_default';
    public static $jobName = 'sample_cron_job';
    public static $jobInstance = Sample::class;
    public static $jobMethod = 'execute';

    use CrontabConfigTestTrait;

    // your custom tests
}
`````
#### Command Config integration test

````php
<?php
declare(strict_types = 1);

namespace Demo\Module\Test\Integration\Console\Command;

use SqlException\Utils\Test\Integration\Traits\CommandConfigTestTrait;
use Demo\Module\Console\Command\Sample;

/**
 * Class SampleCommandTest
 *
 * @package Demo\Module\Test\Integration\Console\Command
 */
class SampleCommandConfigTest extends \PHPUnit\Framework\TestCase
{
    public static $commandCode = 'demo_sample_command';
    public static $commandName = 'demo:sample';
    public static $commandDescription = 'Run sample command.';
    public static $commandClass = Sample::class;

    use CommandConfigTestTrait;

    // your custom tests
}
````

## Where to contribute

## How to contribute

## Testing
