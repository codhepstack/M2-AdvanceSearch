<?php
/**
 * Search Suite Autocomplete Search Model Class
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model;

use \Pixelmechanics\SearchAutocomplete\Helper\Data as HelperData;
use \Pixelmechanics\SearchAutocomplete\Model\SearchFactory;

/**
 * Search class returns needed search data
 */
class Search
{
    /**
     * @var \Pixelmechanics\SearchAutocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Pixelmechanics\SearchAutocomplete\Model\SearchFactory
     */
    protected $searchFactory;

    /**
     * Search constructor.
     *
     * @param HelperData $helperData
     * @param \Pixelmechanics\SearchAutocomplete\Model\SearchFactory $searchFactory
     */
    public function __construct(
        HelperData $helperData,
        SearchFactory $searchFactory
    ) {
        $this->helperData    = $helperData;
        $this->searchFactory = $searchFactory;
    }

    /**
     * Retrieve suggested, product data
     *
     * @return array
     */
    public function getData()
    {
        $data               = [];
        $autocompleteFields = $this->helperData->getAutocompleteFieldsAsArray();

        foreach ($autocompleteFields as $field) {
            $data[] = $this->searchFactory->create($field)->getResponseData();
        }

        return $data;
    }
}
