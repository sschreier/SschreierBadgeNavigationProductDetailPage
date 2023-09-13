<?php
declare(strict_types=1);

namespace Sschreier\BadgeNavigationProductDetailPage\Migration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\CustomField\CustomFieldTypes;
use Sschreier\BadgeNavigationProductDetailPage\SschreierBadgeNavigationProductDetailPage;

final class Migration1693936800CustomFieldProductBadges extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public const CUSTOM_FIELD_SET_TECHNICAL_NAME = 'sschreier_badges_';

    public function getCreationTimestamp(): int
    {
        return 1693936800;
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function update(Connection $connection): void
    {
        for ($i = 1; $i <= SschreierBadgeNavigationProductDetailPage::NUMBER_BADGES; ++$i) {
            $customFieldSetId = $this->createCustomFieldSet($connection, $i);

            $this->createCustomField($connection, $customFieldSetId, $i);

            $this->createCustomFieldRelation($connection, $customFieldSetId);
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    protected function createCustomFieldSet(Connection $connection, int $number): string
    {
        $customFieldSetId = Uuid::randomBytes();

        $customFieldSetStmt = $connection->prepare(self::getCustomFieldSetSql());
        $customFieldSetStmt->executeStatement([
            'id' => $customFieldSetId,
            'name' => self::CUSTOM_FIELD_SET_TECHNICAL_NAME . $number,
            'position' => $number,
            'config' => '{"label": {"de-DE": "Badge ' . $number .'", "en-GB": "badge ' . $number .'"}}',
            'created_at' => self::getDateTimeValue(),
        ]);

        return $customFieldSetId;
    }

    protected function createCustomField(Connection $connection, string $customFieldSetId, int $number): void
    {
        $customFieldId = Uuid::randomBytes();

        $customFieldTextStmt = $connection->prepare(self::getCustomFieldSql());
        $customFieldTextStmt->executeStatement(
            [
                'id' => $customFieldId,
                'name' => self::CUSTOM_FIELD_SET_TECHNICAL_NAME . 'badge' . $number . '_text',
                'fieldType' => CustomFieldTypes::TEXT,
                'config' => '{"label": {"de-DE": "Text des Badges", "en-GB": "text of the badge"}, "placeholder": {"de-DE": "Text des Badges", "en-GB": "text of the badge"}, "componentName": "sw-field", "customFieldType": "text", "customFieldPosition": 1, "type": "text"}',
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );

        $customFieldId = Uuid::randomBytes();

        $customFieldBackgroundColorStmt = $connection->prepare(self::getCustomFieldSql());
        $customFieldBackgroundColorStmt->executeStatement(
            [
                'id' => $customFieldId,
                'name' => self::CUSTOM_FIELD_SET_TECHNICAL_NAME . 'badge' . $number . '_backgroundcolor',
                'fieldType' => CustomFieldTypes::TEXT,
                'config' => '{"label": {"de-DE": "Hintergrundfarbe des Badges", "en-GB": "background color of the badge"}, "componentName": "sw-field", "customFieldType": "colorpicker", "customFieldPosition": 2, "type": "colorpicker"}',
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );

        $customFieldId = Uuid::randomBytes();

        $customFieldFontColorStmt = $connection->prepare(self::getCustomFieldSql());
        $customFieldFontColorStmt->executeStatement(
            [
                'id' => $customFieldId,
                'name' => self::CUSTOM_FIELD_SET_TECHNICAL_NAME . 'badge' . $number . '_fontcolor',
                'fieldType' => CustomFieldTypes::TEXT,
                'config' => '{"label": {"de-DE": "Schriftfarbe des Badges", "en-GB": "font color of the badge"}, "componentName": "sw-field", "customFieldType": "colorpicker", "customFieldPosition": 3, "type": "colorpicker"}',
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );
    }

    protected function createCustomFieldRelation(Connection $connection, $customFieldSetId): void
    {
        $customFieldRelationId = Uuid::randomBytes();

        $customFieldRelationStmt = $connection->prepare(self::getCustomFieldRelationSql());
        $customFieldRelationStmt->executeStatement(
            [
                'id' => $customFieldRelationId,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
                'entity_name' => 'product'
            ],
        );
    }

    protected static function getCustomFieldSetSql(): string
    {
        return <<<'SQL'
            INSERT INTO `custom_field_set` (`id`, `name`, `config`, `active`, `app_id`, `position`, `global`, `created_at`, `updated_at`) VALUES
            (:id, :name, :config, 1, NULL, :position, 0, :created_at, NULL);
            SQL;
    }

    public static function getCustomFieldSql(): string
    {
        return <<<'SQL'
                INSERT INTO `custom_field` (`id`, `name`, `type`, `config`, `active`, `set_id`, `created_at`, `updated_at`, `allow_customer_write`) VALUES
                (:id, :name, :fieldType, :config, 1, :set_id, :created_at, NULL, 1);
            SQL;
    }

    public static function getCustomFieldRelationSql(): string
    {
        return <<<'SQL'
                INSERT INTO `custom_field_set_relation` (`id`, `set_id`, `entity_name`, `created_at`, `updated_at`) VALUES
                (:id, :set_id, :entity_name, :created_at, NULL);
            SQL;
    }

    protected static function getDateTimeValue(): string
    {
        return (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT);
    }
}
