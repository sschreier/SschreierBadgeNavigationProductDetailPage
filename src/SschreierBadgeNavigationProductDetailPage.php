<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@web-solutions-dresden.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\BadgeNavigationProductDetailPage;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class SschreierBadgeNavigationProductDetailPage extends Plugin
{
    public const CUSTOM_FIELD_SET_TECHNICAL_NAME = 'sschreier_badges_';
    public const NUMBER_BADGES = 5;

    public function uninstall(UninstallContext $uninstallContext): void
    {
        if ($uninstallContext->keepUserData()) {
            parent::uninstall($uninstallContext);

            return;
        }

        $this->removeCustomFieldSets($uninstallContext->getContext());

        parent::uninstall($uninstallContext);
    }

    private function removeCustomFieldSets(Context $context): void
    {
        $customFieldSetRepository = $this->container->get('custom_field_set.repository');

        for ($i = 1; $i <= self::NUMBER_BADGES; ++$i) {
            $criteria = new Criteria();
            $criteria->addFilter(new EqualsFilter('name', self::CUSTOM_FIELD_SET_TECHNICAL_NAME . $i));

            $result = $customFieldSetRepository->searchIds($criteria, $context);

            if ($result->getTotal() > 0) {
                $data = $result->getDataOfId($result->firstId());
                $customFieldSetRepository->delete([$data], $context);
            }
        }
    }
}
