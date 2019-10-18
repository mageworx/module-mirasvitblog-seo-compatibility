<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model;

use Magento\Framework\ObjectManagerInterface as ObjectManager;

/**
 * Class DataProviderFactory
 */
class DataProviderFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $map;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array $map
     */
    public function __construct(
        ObjectManager $objectManager,
        array $map = []
    ) {
        $this->objectManager = $objectManager;
        $this->map           = $map;
    }

    /**
     *
     * @param string $param
     * @param array $arguments
     * @return DataProviderInterface
     * @throws \UnexpectedValueException
     */
    public function create($param, array $arguments = [])
    {
        if (isset($this->map[$param])) {
            $instance = $this->objectManager->create($this->map[$param], $arguments);
        } else {
            $instance = $this->objectManager->create(
                '\MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider\Home',
                $arguments
            );
        }

        if (!$instance instanceof \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProviderInterface) {
            throw new \UnexpectedValueException(
                'Class ' . get_class($instance) .
                ' should be an instance of \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProviderInterface'
            );
        }

        return $instance;
    }
}
