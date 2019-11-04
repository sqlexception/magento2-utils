<?php
declare(strict_types = 1);

namespace SqlException\Utils\Model\System\Config\Backend;

/**
 * Class Cron
 *
 * @package SqlException\Utils\Model\System\Config\Backend
 */
class Cron extends \Magento\Framework\App\Config\Value
{
    /**
     * @var \Magento\Framework\App\Config\ValueFactory
     */
    protected $configValueFactory;

    /**
     * @var string
     */
    protected $jobCode;

    /**
     * @var string
     */
    protected $cronGroup;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Config\ValueFactory $configValueFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param string $job_code
     * @param string $cron_group
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Config\ValueFactory $configValueFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        $job_code = null,
        $cron_group = null,
        array $data = []
    ) {
        if (null === $job_code || empty($job_code)) {
            throw new \InvalidArgumentException('Missing required argument job_code');
        }
        if (null === $cron_group || empty($cron_group)) {
            throw new \InvalidArgumentException('Missing required argument cron_group');
        }
        $this->jobCode = $job_code;
        $this->cronGroup = $cron_group;
        $this->configValueFactory = $configValueFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @return string
     */
    protected function getConfigPath(): string
    {
        return sprintf('crontab/%s/jobs/%s/schedule/cron_expr', $this->cronGroup, $this->jobCode);
    }

    /**
     * {@inheritdoc}
     *
     * @return \SqlException\Utils\Model\System\Config\Backend\Cron
     * @throws \Exception
     */
    public function afterSave()
    {
        $cronExpr = $this->getValue();
        try {
            $this->configValueFactory->create()->load(
                $this->getConfigPath(),
                'path'
            )->setValue(
                $cronExpr
            )->setPath(
                $this->getConfigPath()
            )->save();
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(
                new \Magento\Framework\Phrase('Can\'t save the cron expression.')
            );
        }
        return parent::afterSave();
    }
}
