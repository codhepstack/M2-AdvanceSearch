<?php
/**
 * Search Suite Autocomplete Source Model Class for the system configurations.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model\Source;

class AutocompleteFields
{
    const SUGGEST = 'suggest';

    const PRODUCT = 'product';

    /**
     *
     * @return array
     */
    public function toOptionArray()
    {
        $this->options = [
            ['value' => self::SUGGEST, 'label' => __('Suggested')],
            ['value' => self::PRODUCT, 'label' => __('Products')],
        ];

        return $this->options;
    }
}
