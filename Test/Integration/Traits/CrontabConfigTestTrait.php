<?php

namespace SqlException\Utils\Test\Integration\Traits;

use Magento\TestFramework\ObjectManager;

/**
 * Trait ModuleConfigTestTrait
 *
 * @package SqlException\Utils\Test\Integration\Traits
 */
trait CrontabConfigTestTrait
{
    /**
     * test job group exists fron cronjob
     */
    public function testJobGroupExits()
    {
        $config = ObjectManager::getInstance()->create(\Magento\Cron\Model\ConfigInterface::class);
        $jobs = $config->getJobs();
        $this->assertArrayHasKey(
            self::$jobGroup,
            $jobs,
            sprintf('The job group "%s" is not defined.', self::$jobGroup)
        );
    }

    /**
     * test job group exists fron cronjob
     */
    public function testCronJobIsRegistered()
    {
        $config = ObjectManager::getInstance()->create(\Magento\Cron\Model\ConfigInterface::class);
        $jobs = $config->getJobs();
        $this->assertArrayHasKey(
            self::$jobName,
            $jobs[self::$jobGroup],
            sprintf('The job "%s" is not defined in job group "%s."', self::$jobName, self::$jobGroup)
        );
    }

    /**
     * test class exists for cronjob
     */
    public function testCronJobClassExists()
    {
        $config = ObjectManager::getInstance()->create(\Magento\Cron\Model\ConfigInterface::class);
        $jobs = $config->getJobs();
        $this->assertSame(
            ltrim(self::$jobClass, '\\'),
            $jobs[self::$jobGroup][self::$jobName]['instance']
        );
    }

    /**
     * test class can be instantiated for cronjob
     */
    public function testCronJobClassCanBeInstantiated()
    {
        $config = ObjectManager::getInstance()->create(\Magento\Cron\Model\ConfigInterface::class);
        $jobs = $config->getJobs();
        $jobObject = ObjectManager::getInstance()->get($jobs[self::$jobGroup][self::$jobName]['instance']);
        $this->assertInstanceOf(
            self::$jobClass,
            $jobObject
        );
    }

    /**
     * test class exists for cronjob
     */
    public function testCronJobMethodExistsInClass()
    {
        $config = ObjectManager::getInstance()->create(\Magento\Cron\Model\ConfigInterface::class);
        $jobs = $config->getJobs();
        $jobObject = ObjectManager::getInstance()->get($jobs[self::$jobGroup][self::$jobName]['instance']);
        $this->assertInstanceOf(
            self::$jobClass,
            $jobObject
        );
        $this->assertTrue(
            method_exists(
                self::$jobClass,
                self::$jobMethod
            )
        );
    }
}
