<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Theme\Model\ResourceModel\Theme\Grid;

use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;

/**
 * Theme grid collection
 */
class Collection extends ThemeCollection
{
    /**
     * Add area filter
     *
     * @return $this
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->filterVisibleThemes()->addAreaFilter(\Magento\Framework\App\Area::AREA_FRONTEND)->addParentTitle();
        return $this;
    }
}
