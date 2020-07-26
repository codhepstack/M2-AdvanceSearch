<?php
/**
 * Controller Class to process the Ajax Requests and Result Response.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Controller\Ajax;

use \Pixelmechanics\SearchAutocomplete\Helper\Data as HelperData;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\ResultFactory;
use \Magento\Search\Model\QueryFactory;
use \Magento\Store\Model\StoreManagerInterface;
use \Pixelmechanics\SearchAutocomplete\Model\Search as SearchModel;

/**
 * SearchSuiteAutocomplete ajax controller
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Pixelmechanics\SearchAutocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Magento\Search\Model\QueryFactory
     */
    private $queryFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Pixelmechanics\SearchAutocomplete\Model\Search
     */
    private $searchModel;

    /**
     * Index constructor.
     *
     * @param HelperData $helperData
     * @param Context $context
     * @param QueryFactory $queryFactory
     * @param StoreManagerInterface $storeManager
     * @param SearchModel $searchModel
     */
    public function __construct(
        HelperData $helperData,
        Context $context,
        QueryFactory $queryFactory,
        StoreManagerInterface $storeManager,
        SearchModel $searchModel
    ) {
        $this->helperData   = $helperData;
        $this->storeManager = $storeManager;
        $this->queryFactory = $queryFactory;
        $this->searchModel  = $searchModel;
        parent::__construct($context);
    }

    /**
     * Retrieve json of result data
     *
     * @return array|\Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $query = $this->queryFactory->get();
        $query->setStoreId($this->storeManager->getStore()->getId());

        $responseData = [];

        if ($query->getQueryText() != '') {

            $query->setId(0)->setIsActive(1)->setIsProcessed(1);

            $responseData['result'] = $this->searchModel->getData();
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($responseData);

        return $resultJson;
    }
}
