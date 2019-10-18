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
 * Data Provider for Mirasvit Blog Home Page
 */
class Home extends \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Home constructor.
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
        $code       = 'mirasvit_blog_root';
        $title      = __('Mirasvit Blog Home');
        $collection = $this->categoryRepository->getCollection();
        $collection->addRootFilter();

        return $this->getItemsForSitemap($collection, $code, $title);
    }
}
