<?php

namespace SqlException\Utils\Test\Integration\Traits;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader as DeploymentConfigReader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

/**
 * Trait ModuleConfigTestTrait
 *
 * @package SqlException\Utils\Test\Integration\Traits
 */
trait ModuleConfigTestTrait
{
    /**
     * test module is registered
     */
    public function testModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey(self::$moduleName, $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    /**
     * test module is configurated and enabled in the test environment
     * @depends testModuleIsRegistered
     */
    public function testModuleIsConfiguratedAndEnabledInTheTestEnvironment()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = ObjectManager::getInstance();

        /** @var ModuleList $moduleList */
        $moduleList = $objectManager->create(ModuleList::class);
        $this->assertTrue(
            $moduleList->has(self::$moduleName),
            sprintf('Module "%s" not enabled in the test environment', self::$moduleName)
        );
    }

    /**
     * test module is configurated and enabled in the real environment
     * @depends testModuleIsRegistered
     */
    public function testModuleIsConfiguratedAndEnabledInTheRealEnvironment()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = ObjectManager::getInstance();

        /** @var DirectoryList $dirLsit */
        $dirList = $objectManager->create(DirectoryList::class, ['root' => BP]);

        /** @var Reader $configReader */
        $configReader = $objectManager->create(DeploymentConfigReader::class, ['dirList' => $dirList]);

        /** @var DeploymentConfig $deploymentConfig */
        $deploymentConfig = $objectManager->create(DeploymentConfig::class, ['reader' => $configReader]);

        /** @var ModuleList $moduleList */
        $moduleList = $objectManager->create(ModuleList::class, ['config' => $deploymentConfig]);
        $this->assertTrue(
            $moduleList->has(self::$moduleName),
            sprintf(
                'Module "%s" not enabled in the real environment',
                self::$moduleName
            )
        );
    }
}
