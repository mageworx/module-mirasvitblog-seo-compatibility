<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use MageWorx\MirasvitBlogSeoCompatibility\Model\Generator;

/**
 * Class AddBlogPages
 *
 */
class AddBlogPagesObserver implements ObserverInterface
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * AddBlogPagesObserver constructor.
     *
     * @param Generator $generator
     */
    public function __construct(
        Generator $generator
    ) {
        $this->generator = $generator;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        $storeId = $observer->getData('storeId');
        if (!$storeId) {
            return;
        }

        $container  = $observer->getEvent()->getContainer();
        $generators = $container->getGenerators();
        $generators = array_merge($generators, $this->generator->generate($storeId));

        $container->setGenerators($generators);
    }
}