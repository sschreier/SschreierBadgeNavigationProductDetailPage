<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@sebastianschreier.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\BadgeNavigationProductDetailPage\Storefront\Subscriber;

use Shopware\Core\Content\Product\SalesChannel\SalesChannelProductEntity;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Page\Navigation\NavigationPageLoadedEvent;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Sschreier\BadgeNavigationProductDetailPage\SschreierBadgeNavigationProductDetailPage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FrontendSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            NavigationPageLoadedEvent::class => 'onNavigationPageLoaded',
            ProductPageLoadedEvent::class => 'onProductPageLoaded',
        ];
    }

    /**
     * provide the number of badges on the navigation page
     */
    public function onNavigationPageLoaded(NavigationPageLoadedEvent $event): void
    {
        $event->getPage()->assign([
            'numberBadgesValue' => SschreierBadgeNavigationProductDetailPage::NUMBER_BADGES,
        ]);
    }

    /**
     * provide the number of badges on the product detail page
     */
    public function onProductPageLoaded(ProductPageLoadedEvent $event): SalesChannelProductEntity
    {
        $product = $event->getPage()->getProduct();

        $numberBadges['value'] = SschreierBadgeNavigationProductDetailPage::NUMBER_BADGES;
        $numberBadgesValue = $this->createArrayEntity($numberBadges);

        $product->addExtension('numberBadgesValue', $numberBadgesValue);

        return $product;
    }

    /**
     * create an ArrayEntity with the given data
     */
    private function createArrayEntity($extensionData): ArrayEntity
    {
        return new ArrayEntity($extensionData);
    }
}
