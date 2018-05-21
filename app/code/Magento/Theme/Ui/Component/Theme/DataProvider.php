<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Theme\Ui\Component\Theme;

/**
 * Theme data provider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Theme collection
     *
     * @var \Magento\Theme\Model\ResourceModel\Theme\Collection
     */
    protected $collection;

    /**
     * DataProvider constructor.
     *
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $themeCollectionFactory->create();
        $this->collection
            ->filterVisibleThemes()
            ->addAreaFilter(\Magento\Framework\App\Area::AREA_FRONTEND)
            ->addParentTitle();
        $this->collection
            ->addFilterToMap('theme_id', 'main_table.theme_id')
            ->addFilterToMap('theme_title', 'main_table.theme_title')
            ->addFilterToMap('theme_path', 'main_table.theme_path')
            ->addFilterToMap('parent_theme_title', 'parent.theme_title')
        ;
    }
}
