<?php
/**
 * Search Suite Autocomplete Factory Class
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Model;

use Magento\Framework\ObjectManagerInterface as ObjectManager;

/**
 * SearchFactory class for Search model
 */
class SearchFactory
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager = null;

    /**
     * @var string
     */
    protected $map;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array $map
     */
    public function __construct(
        ObjectManager $objectManager,
        array $map = []
    ) {
        $this->objectManager = $objectManager;
        $this->map           = $map;
    }

    /**
     *
     * @param string $param
     * @param array $arguments
     * @return \Pixelmechanics\SearchAutocomplete\Model\SearchInterface
     * @throws \UnexpectedValueException
     */
    public function create($param, array $arguments = [])
    {
        if (isset($this->map[$param])) {
            $instance = $this->objectManager->create($this->map[$param], $arguments);
        } else {
            $instance = $this->objectManager->create(
                '\Pixelmechanics\SearchAutocomplete\Model\Search\Suggested',
                $arguments
            );
        }

        if (!$instance instanceof \Pixelmechanics\SearchAutocomplete\Model\SearchInterface) {
            throw new \UnexpectedValueException(
                'Class ' . get_class(
                    $instance
                ) . ' should be an instance of \Pixelmechanics\SearchAutocomplete\Model\SearchInterface'
            );
        }

        return $instance;
    }
}
