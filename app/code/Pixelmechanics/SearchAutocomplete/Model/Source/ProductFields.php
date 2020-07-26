<?php
/**
 * Search Suite Autocomplete Source Model Class for System Configurations.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model\Source;

class ProductFields
{
    const NAME = 'name';

    const SKU = 'sku';

    const IMAGE = 'image';

    const REVIEWS_RATING = 'reviews_rating';

    const SHORT_DESCRIPTION = 'short_description';

    const DESCRIPTION = 'description';

    const PRICE = 'price';

    const URL = 'url';

    /**
     *
     * @return array
     */
    public function toOptionArray()
    {
        $this->options = [
            ['value' => self::NAME, 'label' => __('Product Name')],
            ['value' => self::SKU, 'label' => __('SKU')],
            ['value' => self::IMAGE, 'label' => __('Product Image')],
            ['value' => self::REVIEWS_RATING, 'label' => __('Reviews Rating')],
            ['value' => self::SHORT_DESCRIPTION, 'label' => __('Short Description')],
            ['value' => self::DESCRIPTION, 'label' => __('Description')],
            ['value' => self::PRICE, 'label' => __('Price')],
        ];

        return $this->options;
    }
}
