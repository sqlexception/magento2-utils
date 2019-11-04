<?php
declare(strict_types=1);

namespace SqlException\Utils\Test\Integration\Traits;

/**
 * Trait ObjectManagerTrait
 *
 * @package SqlException\Utils\Test\Integration\Traits
 */
trait ObjectManagerTrait
{
    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    private $objectManager;

    /**
     * @return \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    private function getObjectManager()
    {
        if (null === $this->objectManager) {
            $this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        }

        return $this->objectManager;
    }
}
