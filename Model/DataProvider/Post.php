<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider;

use MageWorx\MirasvitBlogSeoCompatibility\Helper\Data;
use MageWorx\MirasvitBlogSeoCompatibility\Model\FrontUrl;
use Mirasvit\Blog\Api\Repository\PostRepositoryInterface;

/**
 * Data Provider for Mirasvit Blog Posts
 */
class Post extends \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * Post constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param FrontUrl $url
     * @param Data $helper
     * @param int $storeId
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        FrontUrl $url,
        Data $helper,
        int $storeId = 0
    ) {
        parent::__construct($url, $helper, $storeId);
        $this->postRepository = $postRepository;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getGeneratedData()
    {
        $code       = 'mirasvit_blog_post';
        $title      = __('Mirasvit Blog Posts');
        $collection = $this->postRepository->getCollection();
        $collection->addStoreFilter($this->storeId);
        $collection->addVisibilityFilter();
        $collection->addAttributeToSelect('url_key');

        return $this->getItemsForSitemap($collection, $code, $title);
    }
}
