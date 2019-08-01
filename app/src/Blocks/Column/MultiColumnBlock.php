<?php


namespace SilverStripe\Bambusa\Blocks\Column;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Shared\Models\ContentItem;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class MultiColumnBlock extends BaseElement
{
    /**
     * @var string
     */
    private static $icon = 'font-icon-columns';

    /**
     * @var string
     */
    private static $table_name = 'MultiColumnBlock';
    /**
     * @var string
     */
    private static $singular_name = 'Multi-column';

    /**
     * @var string
     */
    private static $plural_name = 'Multi-column blocks';

    /**
     * @var string
     */
    private static $description = 'Multiple column blocks';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @var array
     */
    private static $has_many = [
        'Items' => Item::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Items'
    ];

    private static $cascade_duplicates = [
        'Items'
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Items');
        $fields->addFieldToTab(
            'Root.Main',
            GridField::create(
                'Items',
                'Items',
                $this->Items(),
                $config = GridFieldConfig_RecordEditor::create()
            )
        );

        $config->addComponent(GridFieldOrderableRows::create());

        // Limit columns to 4 per block
        if ($this->Items()->count() >= 4) {
            $config->removeComponentsByType(GridFieldAddNewButton::class);
        }

        return $fields;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return static::$singular_name;
    }
}