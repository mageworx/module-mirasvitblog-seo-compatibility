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
abstract class DataProvider implements DataProviderInterface
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var FrontUrl
     */
    protected $url;

    /**
     * DataProvider constructor.
     *
     * @param FrontUrl $url
     * @param Data $helper
     * @param int|null $storeId
     */
    public function __construct(
        FrontUrl $url,
        Data $helper,
        int $storeId = 0
    ) {
        $this->helper  = $helper;
        $this->url     = $url;
        $this->storeId = $storeId;
    }

    /**
     * @return array
     */
    abstract public function getGeneratedData();


    /**
     * @param $collection
     * @param string $code
     * @param string $title
     * @return array mixed
     */
    protected function getItemsForSitemap($collection, $code, $title)
    {
        $generators[$code]               = [];
        $generators[$code]['title']      = $title;
        $generators[$code]['changefreq'] = $this->helper->getFrequency();
        $generators[$code]['priority']   = $this->helper->getPriority();
        $this->helper->setStoreId($this->storeId);

        foreach ($collection as $item) {
            $generators[$code]['items'][] = [
                'url_key'      => $this->prepareUrl($item, $code),
                'date_changed' => $this->getUpdatedDate($item)
            ];
        }

        return $generators;
    }

    /**
     * @param $item
     * @return string
     */
    protected function getUpdatedDate($item)
    {
        $date = $item->getUpdatedAt() ?: $item->getCreatedAt();

        if (!$date) {
            return '';
        }

        return date_format(date_create($date), 'Y-m-d');
    }

    /**
     * @param string $item
     * @param string $code
     * @return string
     */
    protected function prepareUrl($item, $code)
    {
        switch ($code) {
            case 'mirasvit_blog_root':
            case 'mirasvit_blog_category':
                $url = $this->url->getCategoryUrl($item, ['_nosid' => true]);
                break;
            case 'mirasvit_blog_post':
                $url = $this->url->getPostUrl($item, false);
                break;
            case 'mirasvit_blog_tag':
                $url = $this->url->getTagUrl($item, ['_nosid' => true]);
                break;
            case 'mirasvit_blog_author':
                $url = $this->url->getAuthorUrl($item, ['_nosid' => true]);
                break;
            default:
                $url = $this->url->getBaseUrl();
                break;
        }

        return $url;
    }
}
