<?php

namespace Meetanshi\Flatshipping\Model\Carrier;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Meetanshi\Flatshipping\Model\Carrier\Flatrate\ItemPriceCalculator;
use Psr\Log\LoggerInterface;

/**
 * Class Flatrate1
 *
 * Custom flat rate shipping carrier 1
 */
class Flatrate1 extends AbstractCarrier implements CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'flatrate1';

    /**
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @var ResultFactory
     */
    protected $rateResultFactory;

    /**
     * @var MethodFactory
     */
    protected $rateMethodFactory;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var State
     */
    protected $state;

    /**
     * @var ItemPriceCalculator
     */
    private $itemPriceCalculator;

    /**
     * Flatrate1 constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param ItemPriceCalculator $itemPriceCalculator
     * @param Session $session
     * @param State $state
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        ItemPriceCalculator $itemPriceCalculator,
        Session $session,
        State $state,
        array $data = []
    ) {
        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
        $this->session = $session;
        $this->state = $state;
        $this->itemPriceCalculator = $itemPriceCalculator;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Collect shipping rates
     *
     * @param RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result|bool
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        if ($this->getConfigFlag('for_admin')) {
            if ($this->state->getAreaCode() != 'adminhtml') {
                return false;
            }
        }

        $freeBoxes = $this->getFreeBoxesCount($request);
        $this->setFreeBoxes($freeBoxes);

        $result = $this->rateResultFactory->create();

        $shippingPrice = $this->getShippingPrice($request, $freeBoxes);

        if ($shippingPrice !== false) {
            $method = $this->createResultMethod($shippingPrice);
            $result->append($method);
        }
        return $result;
    }

    /**
     * Get free boxes count
     *
     * @param RateRequest $request
     * @return int
     */
    private function getFreeBoxesCount(RateRequest $request)
    {
        $freeBoxes = 0;
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }

                if ($item->getHasChildren() && $item->isShipSeparately()) {
                    $freeBoxes += $this->getFreeBoxesCountFromChildren($item);
                } elseif ($item->getFreeShipping()) {
                    $freeBoxes += $item->getQty();
                }
            }
        }
        return $freeBoxes;
    }

    /**
     * Get shipping price
     *
     * @param RateRequest $request
     * @param int $freeBoxes
     * @return float|bool
     */
    private function getShippingPrice(RateRequest $request, $freeBoxes)
    {
        $shippingPrice = false;

        $configPrice = $this->getConfigData('price');
        if ($this->getConfigData('type') === 'O') {
            $shippingPrice = $this->itemPriceCalculator->getShippingPricePerOrder($request, $configPrice, $freeBoxes);
        } elseif ($this->getConfigData('type') === 'I') {
            $shippingPrice = $this->itemPriceCalculator->getShippingPricePerItem($request, $configPrice, $freeBoxes);
        }

        $onlyShippingPrice = $shippingPrice;

        $shippingPrice = $this->getFinalPriceWithHandlingFee($shippingPrice);

        if ($shippingPrice !== false && $request->getPackageQty() == $freeBoxes) {
            $shippingPrice = '0.00';
        }

        if ($this->getConfigData('handling_type') == 'FI') {
            if ($request->getPackageQty() > 1) {
                $onlyhandelfee = $shippingPrice - $onlyShippingPrice;
                $feeadded = $onlyhandelfee * ($request->getPackageQty() - 1);
                $shippingPrice = $shippingPrice + $feeadded;
            }
        }

        if ((($this->getConfigData('min_amount') != '')
                && ($request->getBaseSubtotalInclTax() <= $this->getConfigData('min_amount')))
            && (($this->getConfigData('max_amount') != '')
                && ($request->getBaseSubtotalInclTax() <= $this->getConfigData('max_amount')))) {
            $shippingPrice = false;
        } elseif ((($this->getConfigData('min_amount') != '')
                && ($request->getBaseSubtotalInclTax() >= $this->getConfigData('min_amount')))
            && (($this->getConfigData('max_amount') != '')
                && ($request->getBaseSubtotalInclTax() >= $this->getConfigData('max_amount')))) {
            $shippingPrice = false;
        } elseif ((($this->getConfigData('min_amount') != '')
                && ($request->getBaseSubtotalInclTax() <= $this->getConfigData('min_amount')))
            && (($this->getConfigData('max_amount') == ''))) {
            $shippingPrice = false;
        } elseif ((($this->getConfigData('max_amount') != '')
                && ($request->getBaseSubtotalInclTax() >= $this->getConfigData('max_amount')))
            && (($this->getConfigData('min_amount') == ''))) {
            $shippingPrice = false;
        }

        return $shippingPrice;
    }

    /**
     * Create result method
     *
     * @param float $shippingPrice
     * @return \Magento\Quote\Model\Quote\Address\RateResult\Method
     */
    protected function createResultMethod($shippingPrice)
    {
        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->getCarrierCode());
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->getCarrierCode());
        $method->setMethodTitle($this->getConfigData('name'));
        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);

        return $method;
    }

    /**
     * Get allowed methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->getCarrierCode() => $this->getConfigData('name')];
    }
}
