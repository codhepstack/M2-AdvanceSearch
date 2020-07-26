<?php
/**
 * Search Suite Autocomplete Interface file 
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model;

/**
 * @api
 */
interface SearchInterface
{
    /**
     * Retrieve selected in config data
     *
     * @return array
     */
    public function getResponseData();

    /**
     * Check if data used in search result
     *
     * @return bool
     */
    public function canAddToResult();
}
