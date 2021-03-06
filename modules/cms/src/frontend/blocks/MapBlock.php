<?php

namespace luya\cms\frontend\blocks;

use luya\cms\frontend\Module;
use luya\cms\base\PhpBlock;

/**
 * Google Maps Block.
 *
 * @author Basil Suter <basil@nadar.io>
 */
final class MapBlock extends PhpBlock
{
    /**
     * @inheritdoc
     */
    public $module = 'cms';
    
    /**
     * @inheritdoc
     */
    public $cacheEnabled = true;

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('block_map_name');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'map';
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        return [
            'vars' => [
                [
                    'var' => 'address',
                    'label' => Module::t('block_map_address_label'),
                    'type' => self::TYPE_TEXT,
                    'placeholder' => 'Zephir Software Design AG, Tramstrasse 66, 4142 Münchenstein'
                ],
                [
                    'var' => 'zoom',
                    'label' => Module::t('block_map_zoom_label'),
                    'type' => self::TYPE_SELECT,
                    'initvalue' => '12',
                    'options' => [
                        ['value' => '0', 'label' => Module::t('block_map_zoom_entire')],
                        ['value' => '1', 'label' => '4000 km'],
                        ['value' => '2', 'label' => '2000 km (' . Module::t('block_map_zoom_world') . ')'],
                        ['value' => '3', 'label' => '1000 km'],
                        ['value' => '4', 'label' => '400 km (' . Module::t('block_map_zoom_continent') . ')'],
                        ['value' => '5', 'label' => '200 km'],
                        ['value' => '6', 'label' => '100 km (' . Module::t('block_map_zoom_country') . ')'],
                        ['value' => '7', 'label' => '50 km'],
                        ['value' => '8', 'label' => '30 km'],
                        ['value' => '9', 'label' => '15 km'],
                        ['value' => '10', 'label' => '8 km'],
                        ['value' => '11', 'label' => '4 km'],
                        ['value' => '12', 'label' => '2 km (' . Module::t('block_map_zoom_city') . ')'],
                        ['value' => '13', 'label' => '1 km'],
                        ['value' => '14', 'label' => '400 m (' . Module::t('block_map_zoom_district') . ')'],
                        ['value' => '15', 'label' => '200 m'],
                        ['value' => '16', 'label' => '100 m'],
                        ['value' => '17', 'label' => '50 m (' . Module::t('block_map_zoom_street') . ')'],
                        ['value' => '18', 'label' => '20 m'],
                        ['value' => '19', 'label' => '10 m'],
                        ['value' => '20', 'label' => '5 m (' . Module::t('block_map_zoom_house') . ')'],
                        ['value' => '21', 'label' => '2.5 m'],
                    ],
                ],
                [
                    'var' => 'maptype',
                    'label' => Module::t('block_map_maptype_label'),
                    'type' => self::TYPE_SELECT,
                    'options' => [
                        ['value' => 'm', 'label' => Module::t('block_map_maptype_roadmap')],
                        ['value' => 'k', 'label' => Module::t('block_map_maptype_satellitemap')],
                        ['value' => 'h', 'label' => Module::t('block_map_maptype_hybrid')],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraVars()
    {
        return [
            'address' => urlencode($this->getVarValue('address', 'Zephir Software Design AG, Tramstrasse 66, Münchenstein')),
            'zoom' => $this->getVarValue('zoom', 15),
            'maptype' => $this->getVarValue('maptype', 'h'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '{% if vars.address is not empty %}<div class="iframe-container"><iframe src="http://maps.google.com/maps?f=q&source=s_q&hl=de&geocode=&q={{ extras.address }}&z={{ extras.zoom }}&t={{ extras.maptype }}&output=embed"></iframe></div>{% else %}<span class="block__empty-text">' . Module::t('block_map_no_content') . '</span>{% endif %}';
    }
}
