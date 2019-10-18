<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider;

use MageWorx\MirasvitBlogSeoCompatibility\Helper\Data;
use MageWorx\MirasvitBlogSeoCompatibility\Model\FrontUrl;
use Mirasvit\Blog\Api\Repository\AuthorRepositoryInterface;

/**
 * Data Provider for Mirasvit Blog Author Pages
 */
class Author extends \MageWorx\MirasvitBlogSeoCompatibility\Model\DataProvider
{
    /**
     * @var AuthorRepositoryInterface
     */
    protected $authorRepository;

    /**
     * Author constructor.
     *
     * @param AuthorRepositoryInterface $authorRepository
     * @param FrontUrl $url
     * @param Data $helper
     * @param int $storeId
     */
    public function __construct(
        AuthorRepositoryInterface $authorRepository,
        FrontUrl $url,
        Data $helper,
        int $storeId = 0
    ) {
        parent::__construct($url, $helper, $storeId);
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getGeneratedData()
    {
        $code       = 'mirasvit_blog_author';
        $title      = __('Mirasvit Blog Authors');
        $collection = $this->authorRepository->getCollection();

        return $this->getItemsForSitemap($collection, $code, $title);
    }
}
