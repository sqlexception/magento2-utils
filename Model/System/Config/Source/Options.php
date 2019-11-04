<?php

namespace SqlException\Utils\Model\System\Config\Source;

/**
 * Class Options
 *
 * @package SqlException\Utils\Model\System\Config\Source
 */
class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * AbstractLabelOptions constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->options as $option) {
            if (isset($option['value']) && isset($option['label'])) {
                $options[] = ['value' => $option['value'], 'label' => __($option['label'])];
            }
        }
        return $options;
    }
}
