<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Url;
use Magento\Store\Model\StoreManagerInterface;

class FrontUrl extends \Mirasvit\Blog\Model\Url
{

    /**
     * FrontUrl constructor.
     *
     * Use Url from frontend
     *
     * @param StoreManagerInterface $storeManager
     * @param \Mirasvit\Blog\Model\Config $config
     * @param ScopeConfigInterface $scopeConfig
     * @param \Mirasvit\Blog\Model\PostFactory $postFactory
     * @param \Mirasvit\Blog\Model\CategoryFactory $categoryFactory
     * @param \Mirasvit\Blog\Model\TagFactory $tagFactory
     * @param \Mirasvit\Blog\Model\AuthorFactory $authorFactory
     * @param Url $urlManager
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        \Mirasvit\Blog\Model\Config $config,
        ScopeConfigInterface $scopeConfig,
        \Mirasvit\Blog\Model\PostFactory $postFactory,
        \Mirasvit\Blog\Model\CategoryFactory $categoryFactory,
        \Mirasvit\Blog\Model\TagFactory $tagFactory,
        \Mirasvit\Blog\Model\AuthorFactory $authorFactory,
        Url $urlManager
    ) {
        parent::__construct(
            $storeManager,
            $config,
            $scopeConfig,
            $postFactory,
            $categoryFactory,
            $tagFactory,
            $authorFactory,
            $urlManager
        );
    }
}