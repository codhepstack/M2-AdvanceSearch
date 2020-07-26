<?php
/**
 * Autocomplete Block Class For Search Suite Autocomplete.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Block;

/**
 * Autocomplete class used for transport config data
 */
class Autocomplete extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Pixelmechanics\SearchAutocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * Autocomplete constructor.
     *
     * @param \Pixelmechanics\SearchAutocomplete\Helper\Data $helperData
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Pixelmechanics\SearchAutocomplete\Helper\Data $helperData,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {

        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve search delay in milliseconds (500 by default)
     *
     * @return int
     */
    public function getSearchDelay()
    {
        return $this->helperData->getSearchDelay();
    }

    /**
     * Retrieve search action url
     *
     * @return string
     */
    public function getSearchUrl()
    {
        return $this->getUrl("searchautocomplete/ajax/index");
    }
}
