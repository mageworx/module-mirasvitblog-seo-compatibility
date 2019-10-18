<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider;

use MageWorx\MirasvitBlogSeoCompatibility\Helper\Data;
use MageWorx\MirasvitBlogSeoCompatibility\Model\FrontUrl;
use Mirasvit\Blog\Api\Repository\CategoryRepositoryInterface;

/**
 * Data Provider for Mirasvit Blog Posts
 */
class Category extends \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Category constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @param FrontUrl $url
     * @param Data $helper
     * @param int $storeId
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        FrontUrl $url,
        Data $helper,
        int $storeId = 0
    ) {
        parent::__construct($url, $helper, $storeId);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function getGeneratedData()
    {
        $code       = 'mirasvit_blog_category';
        $title      = __('Mirasvit Blog Categories');
        $collection = $this->categoryRepository->getCollection();
        $collection->excludeRoot();
        $collection->addVisibilityFilter();
        $collection->addAttributeToSelect('url_key');

        return $this->getItemsForSitemap($collection, $code, $title);
    }
}
