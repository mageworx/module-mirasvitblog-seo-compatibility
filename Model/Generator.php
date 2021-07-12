<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\MirasvitBlogSeoCompatibility\Model;

use MageWorx\MirasvitBlogSeoCompatibility\Helper\Data;

/**
 * Class Abstract DataProvider
 */
class Generator
{
    /**
     * @var DataProviderFactory
     */
    protected $dataProviderFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Generator constructor.
     *
     * @param DataProviderFactory $dataProviderFactory
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        DataProviderFactory $dataProviderFactory,
        Data $helper,
        array $data = []
    ) {
        $this->dataProviderFactory = $dataProviderFactory;
        $this->helper              = $helper;
        $this->data                = $data;
    }

    /**
     * @param $storeId
     * @return array
     */
    public function generate($storeId)
    {
        if (!$this->helper->isBlogPagesEnabled($storeId)) {
            return [];
        }

        $this->helper->setStoreId($storeId);

        $generators = [];
        $arguments  = ['storeId' => $storeId];

        foreach ($this->data as $identifier) {
            if (!$this->isAddPages($identifier)) {
                continue;
            }

            $dataProvider = $this->dataProviderFactory->create($identifier, $arguments);
            $generators   = array_merge($generators, $dataProvider->getGeneratedData());
        }

        return $generators;
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function isAddPages($identifier)
    {
        switch ($identifier) {
            case 'post':
                $result = $this->helper->isAddPosts();
                break;
            case 'category':
                $result = $this->helper->isAddCategories();
                break;
            case 'author':
                $result = $this->helper->isAddAuthors();
                break;
            case 'tag':
                $result = $this->helper->isAddTags();
                break;
            case 'home':
            default:
                $result = true;
                break;
        }

        return $result;
    }
}