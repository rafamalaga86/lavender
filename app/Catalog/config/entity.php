<?php

use Lavender\Support\Facades\Attribute;
use Lavender\Support\Facades\Relationship;
use Lavender\Support\Facades\Scope;

return [

    'category' => [
        'class' => 'Lavender\Catalog\Database\Category',
        'scope' => Scope::IS_DEPARTMENT,
        'attributes' => [
            'name' => [
                'label' => 'Name',
                'type' => Attribute::VARCHAR,
                'backend.table' => true,
                'backend.renderer' => 'Lavender\Backend\Handlers\Entity\EditLink',
            ],
            'description' => [
                'label' => 'Description',
                'type' => Attribute::TEXT,
            ],
            'url' => [
                'label' => 'Url',
                'type' => Attribute::VARCHAR,
                'before_save' => 'Lavender\Catalog\Handlers\CategoryUrl'
            ],
        ],
        'relationships' => [

            'products' => [
                'entity' => 'product',
                'type' => Relationship::HAS_PIVOT,
                'table' => 'catalog_category_product',
            ],
            'parent' => [
                'entity' => 'category',
                'type' => Relationship::BELONGS_TO,
            ],
            'children' => [
                'entity' => 'category',
                'type' => Relationship::HAS_MANY,
            ],

        ],

    ],



    'product' => [
        'class' => 'Lavender\Catalog\Database\Product',
        'scope' => Scope::IS_STORE,
        'attributes' => [
            'sku' => [
                'label' => 'Sku',
                'type' => Attribute::VARCHAR,
                'backend.table' => true,
                'backend.renderer' => 'Lavender\Backend\Handlers\Entity\EditLink',
            ],
            'name' => [
                'label' => 'Name',
                'type' => Attribute::VARCHAR,
                'backend.table' => true,
                'backend.renderer' => 'Lavender\Backend\Handlers\Entity\EditLink',
            ],
            'price' => [
                'label' => 'Price',
                'type' => Attribute::DECIMAL,
                'default' => 0.00,
            ],
            'url' => [
                'label' => 'Url',
                'type' => Attribute::VARCHAR,
                'before_save' => 'Lavender\Catalog\Handlers\ProductUrl'
            ],
            'special_price' => [
                'label' => 'Special Price',
                'type' => Attribute::DECIMAL,
                'default' => 0.00,
            ],
        ],
        'relationships' => [

            'categories' => [
                'entity' => 'category',
                'type' => Relationship::HAS_PIVOT,
                'table' => 'catalog_category_product',
            ],

        ],
    ],


    'store' => [
        'relationships' => [
            'root_category' => [
                'entity' => 'category',
                'type' => Relationship::BELONGS_TO,
            ]
        ]
    ]


];
