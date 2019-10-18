<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider;

use MageWorx\MirasvitBlogSeoCompatibility\Helper\Data;
use MageWorx\MirasvitBlogSeoCompatibility\Model\FrontUrl;
use Mirasvit\Blog\Api\Repository\TagRepositoryInterface;

/**
 * Data Provider for Mirasvit Blog Tags
 */
class Tag extends \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider
{
    /**
     * @var TagRepositoryInterface
     */
    protected $tagRepository;

    /**
     * Tag constructor.
     *
     * @param TagRepositoryInterface $tagRepository
     * @param FrontUrl $url
     * @param Data $helper
     * @param int $storeId
     */
    public function __construct(
        TagRepositoryInterface $tagRepository,
        FrontUrl $url,
        Data $helper,
        int $storeId = 0
    ) {
        parent::__construct($url, $helper, $storeId);
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getGeneratedData()
    {
        $code       = 'mirasvit_blog_tag';
        $title      = __('Mirasvit Blog Tags');
        $collection = $this->tagRepository->getCollection();

        return $this->getItemsForSitemap($collection, $code, $title);
    }
}
