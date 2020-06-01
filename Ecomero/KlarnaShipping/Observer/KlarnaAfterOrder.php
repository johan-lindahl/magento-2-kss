<?php declare(strict_types=1);
/**
 *
 *           a88888P8
 *          d8'
 * .d8888b. 88        .d8888b. 88d8b.d8b. .d8888b. .dd888b. .d8888b.
 * 88ooood8 88        88'  `88 88'`88'`88 88ooood8 88'    ` 88'  `88
 * 88.  ... Y8.       88.  .88 88  88  88 88.  ... 88       88.  .88
 * `8888P'   Y88888P8 `88888P' dP  dP  dP `8888P'  dP       `88888P'
 *
 *           Copyright © eComero Management AB, All rights reserved.
 *
 */
namespace Ecomero\KlarnaShipping\Observer;

use Magento\Framework\Event\ObserverInterface;

class KlarnaAfterOrder implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getData('quote');
        $methodName = $quote->getKssMethod();
        $carrier = $quote->getKssCarrier();
        $class = $quote->getKssClass();
        $pickupPointId = $quote->getKssPickupLocationId();

        $order = $observer->getData('order');
        $order->setKssMethod($methodName);
        $order->setKssCarrier($carrier);
        $order->setKssClass($class);
        $order->setKssPickupLocationId($pickupPointId);
        $order->save();
    }
}
