<?php
/**
 * Product Block Agregator Class For Search Suite Autocomplete.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
namespace Pixelmechanics\SearchAutocomplete\Block\Autocomplete;

use \Pixelmechanics\SearchAutocomplete\Block\Product as ProductBlock;
use \Magento\Catalog\Helper\Output as CatalogHelperOutput;
use \Magento\Catalog\Block\Product\ReviewRendererInterface;
use \Magento\Framework\Stdlib\StringUtils;
use \Magento\Framework\Url\Helper\Data as UrlHelper;
use \Magento\Framework\Data\Form\FormKey;
use \Magento\Framework\View\Asset\Repository;
use \Magento\Framework\Escaper;


/**
 * ProductAgregator class for autocomplete data
 *
 * @method Product setProduct(\Magento\Catalog\Model\Product $product)
 */
class ProductAgregator extends \Magento\Framework\DataObject
{
    /**
     * @var \Pixelmechanics\SearchAutocomplete\Block\Product
     */
    protected $productBlock;

    /**
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;

    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $assetRepo;

    /**
     * @var CatalogHelperOutput
     */
    protected $catalogHelperOutput;

    /**
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;

    /**
     * ProductAgregator constructor.
     *
     * @param ProductBlock $productBlock
     * @param StringUtils $string
     * @param UrlHelper $urlHelper
     * @param Repository $assetRepo
     * @param CatalogHelperOutput $catalogHelperOutput
     * @param FormKey $formKey
     * @param Escaper $escaper
     */
    public function __construct(
        ProductBlock $productBlock,
        StringUtils $string,
        UrlHelper $urlHelper,
        Repository $assetRepo,
        CatalogHelperOutput $catalogHelperOutput,
        FormKey $formKey,
        Escaper $escaper
    ) {
        $this->productBlock        = $productBlock;
        $this->string              = $string;
        $this->urlHelper           = $urlHelper;
        $this->assetRepo           = $assetRepo;
        $this->catalogHelperOutput = $catalogHelperOutput;
        $this->formKey             = $formKey;
        $this->escaper             = $escaper;
    }

    /**
     * Retrieve product name
     *
     * @return string
     */
    public function getName()
    {
        return strip_tags(html_entity_decode($this->getProduct()->getName()));
    }

    /**
     * Retrieve product sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getProduct()->getSku();
    }

    /**
     * Retrieve product small image url
     *
     * @return bool|string
     */
    public function getSmallImage()
    {
        $product   = $this->getProduct();
        $url       = false;
        $attribute = $product->getResource()->getAttribute('thumbnail');
        if (!$product->getThumbnail() || $product->getThumbnail() == 'no_selection') {
            $attribute = $product->getResource()->getAttribute('small_image');
            if (!$product->getSmallImage() || $product->getSmallImage() == 'no_selection') {
                $url = $this->assetRepo->getUrl('Magento_Catalog::images/product/placeholder/small_image.jpg');
            } elseif ($attribute) {
                $url = $attribute->getFrontend()->getUrl($product);
            }
        } elseif ($attribute) {
            $url = $attribute->getFrontend()->getUrl($product);
        }

        return $url;
    }

    /**
     * Retrieve product reviews rating html
     *
     * @return string
     */
    public function getReviewsRating()
    {
        return $this->productBlock->getReviewsSummaryHtml(
            $this->getProduct(),
            ReviewRendererInterface::SHORT_VIEW,
            true
        );
    }

    /**
     * Retrieve product short description
     *
     * @return string
     */
    public function getShortDescription()
    {
        $shortDescription = html_entity_decode($this->getProduct()->getShortDescription());

        return $this->cropDescription($shortDescription);
    }

    /**
     * Retrieve product description
     *
     * @return string
     */
    public function getDescription()
    {
        $description = html_entity_decode($this->getProduct()->getDescription());

        return $this->cropDescription($description);
    }

    /**
     * Crop description to 50 symbols
     *
     * @param string $html
     * @return string
     */
    protected function cropDescription($html)
    {
        $string = strip_tags($html);
        $string = (strlen($string) > 50) ? $this->string->substr($string, 0, 50) . '...' : $html;

        return $string;
    }

    /**
     * Retrieve product price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->productBlock->getProductPrice(
            $this->getProduct(),
            \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE
        );
    }

    /**
     * Retrieve product url
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->productBlock->getProductUrl($this->getProduct());
    }
}
