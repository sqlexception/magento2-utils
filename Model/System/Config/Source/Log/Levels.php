<?php
declare(strict_types = 1);

namespace SqlException\Utils\Model\System\Config\Source\Log;

use Psr\Log\LoggerInterface;

/**
 * Class Level
 *
 * @package SqlException\Utils\Model\System\Config\Source\Log
 */
class Levels implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Levels constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];
        foreach ($this->logger->getLevels() as $label => $value) {
            $options[] = ['value' => $value, 'label' => __($label)];
        }
        return $options;
    }
}
