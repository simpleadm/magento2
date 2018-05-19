<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Theme\Ui\Component\Listing\DataProvider\Theme;

use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;


/**
 * Theme search result
 */
class SearchResult implements SearchResultInterface
{
    /**
     * {@inheritdoc}
     */
    protected $_map = [
        'fields' => [
            'theme_id' => 'main_table.theme_id',
            'theme_title' => 'main_table.theme_title',
            'theme_path' => 'main_table.theme_path',
            'parent_theme_title' => 'parent.theme_title',
        ],
    ];

    /**
     * @var AggregationInterface
     */
    protected $aggregations;

    /**
     * @var ThemeCollection
     */
    protected $themeCollection;

    /**
     * SearchResult constructor.
     *
     * @param \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollectionFactory
     * @param $mainTable
     * @param $resourceModel
     * @param string $model
     */
    public function __construct(
        \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollectionFactory,
        $mainTable,
        $resourceModel,
        $model = \Magento\Framework\View\Element\UiComponent\DataProvider\Document::class
    ) {
        $this->themeCollection = $themeCollectionFactory->create();
        $this->themeCollection->setMainTable($mainTable);
        $this->themeCollection->setModel($model);
        $this->themeCollection->setResourceModel($resourceModel);

        $this->themeCollection->filterVisibleThemes()->addAreaFilter(\Magento\Framework\App\Area::AREA_FRONTEND)->addParentTitle();
        $this->themeCollection
            ->addFilterToMap('theme_id', 'main_table.theme_id')
            ->addFilterToMap('theme_title', 'main_table.theme_title')
            ->addFilterToMap('theme_path', 'main_table.theme_path')
            ->addFilterToMap('parent_theme_title', 'parent.theme_title')
        ;
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->themeCollection->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @return \Magento\Framework\Api\Search\DocumentInterface[]
     */
    public function getItems()
    {
        return $this->themeCollection->getItems();
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
