<?php

namespace SqlExeption\Utils\Test\Integration;

use SqlException\Utils\Test\Integration\Traits\ModuleConfigTestTrait;

/**
 * Class ModuleConfigTest
 *
 * @package Valmano\Catalog\Test\Integration
 */
class ModuleConfigTest extends \PHPUnit\Framework\TestCase
{
    use ModuleConfigTestTrait;
    /**
     * @var string current module name to test
     */
    public static $moduleName = 'SqlException_Utils';
}
