<?php
/**
 * Constructor Type Class Implementations.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model\Search;

use \Pixelmechanics\SearchAutocomplete\Helper\Data as HelperData;
use \Magento\Search\Helper\Data as SearchHelper;
use \Magento\Catalog\Model\Layer\Resolver as LayerResolver;
use \Magento\Framework\ObjectManagerInterface as ObjectManager;
use \Magento\Search\Model\QueryFactory;
use \Pixelmechanics\SearchAutocomplete\Model\Source\AutocompleteFields;
use \Pixelmechanics\SearchAutocomplete\Model\Source\ProductFields;

/**
 * Product model. Return product data used in search autocomplete
 */
class Product implements \Pixelmechanics\SearchAutocomplete\Model\SearchInterface
{
    /**
     * @var \Pixelmechanics\SearchAutocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Magento\Search\Helper\Data
     */
    protected $searchHelper;

    /**
     * @var \Magento\Catalog\Model\Layer\Resolver
     */
    protected $layerResolver;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Search\Model\QueryFactory
     */
    private $queryFactory;

    /**
     * Product constructor.
     *
     * @param HelperData $helperData
     * @param SearchHelper $searchHelper
     * @param LayerResolver $layerResolver
     * @param ObjectManager $objectManager
     * @param QueryFactory $queryFactory
     */
    public function __construct(
        HelperData $helperData,
        SearchHelper $searchHelper,
        LayerResolver $layerResolver,
        ObjectManager $objectManager,
        QueryFactory $queryFactory
    ) {
        $this->helperData    = $helperData;
        $this->searchHelper  = $searchHelper;
        $this->layerResolver = $layerResolver;
        $this->objectManager = $objectManager;
        $this->queryFactory  = $queryFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseData()
    {
        $responseData['code'] = AutocompleteFields::PRODUCT;
        $responseData['data'] = [];

        if (!$this->canAddToResult()) {
            return $responseData;
        }

        $query                 = $this->queryFactory->get();
        $queryText             = $query->getQueryText();
        $productResultFields   = $this->helperData->getProductResultFieldsAsArray();
        $productResultFields[] = ProductFields::URL;

        $productCollection = $this->getProductCollection($queryText);

        foreach ($productCollection as $product) {
            $responseData['data'][] = array_intersect_key(
                $this->getProductData($product),
                array_flip($productResultFields)
            );
        }

        $responseData['size'] = $productCollection->getSize();
        $responseData['url']  = ($productCollection->getSize() > 0) ? $this->searchHelper->getResultUrl(
            $queryText
        ) : '';

        $query->saveNumResults($responseData['size']);
        $query->saveIncrementalPopularity();

        return $responseData;
    }

    /**
     * Retrive product collection by query text
     *
     * @param string $queryText
     * @return mixed
     */
    protected function getProductCollection($queryText)
    {
        $productResultNumber = $this->helperData->getProductResultNumber();

        $this->layerResolver->create(LayerResolver::CATALOG_LAYER_SEARCH);

        $productCollection = $this->layerResolver->get()
                                                 ->getProductCollection()
                                                 ->addAttributeToSelect(
                                                     [ProductFields::DESCRIPTION, ProductFields::SHORT_DESCRIPTION]
                                                 )
                                                 ->setPageSize($productResultNumber)
                                                 ->addAttributeToSort('relevance')
                                                 ->setOrder('relevance')
                                                 ->addSearchFilter($queryText);

        return $productCollection;
    }

    /**
     * Retrieve all product data
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return array
     */
    protected function getProductData($product)
    {
        /** @var \Pixelmechanics\SearchAutocomplete\Block\Autocomplete\ProductAgregator $productAgregator */
        $productAgregator = $this->objectManager->create(
            'Pixelmechanics\SearchAutocomplete\Block\Autocomplete\ProductAgregator'
        )
                                                ->setProduct($product);

        $data = [
            ProductFields::NAME              => $productAgregator->getName(),
            ProductFields::SKU               => $productAgregator->getSku(),
            ProductFields::IMAGE             => $productAgregator->getSmallImage(),
            ProductFields::REVIEWS_RATING    => $productAgregator->getReviewsRating(),
            ProductFields::SHORT_DESCRIPTION => $productAgregator->getShortDescription(),
            ProductFields::DESCRIPTION       => $productAgregator->getDescription(),
            ProductFields::PRICE             => $productAgregator->getPrice(),
            ProductFields::URL               => $productAgregator->getUrl()
        ];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function canAddToResult()
    {
        return in_array(AutocompleteFields::PRODUCT, $this->helperData->getAutocompleteFieldsAsArray());
    }
}
