<?php
return [
    'horse_racing' => [
        'Meeting' => [
            'meeting_id'    => ['int', ['@attributes','id']],
            'date'          => ['date', ['@attributes','date']],
            'country'       => ['string', ['@attributes','country']],
            'status'        => ['string', ['@attributes','status']],
            'course'        => ['string', ['@attributes','course']],
            'revision'      => ['int', ['@attributes','revision']]
        ],
        'Race' => [
            'race_id'       => ['int', ['@attributes', 'id']],
            'date'          => ['date', ['@attributes', 'date']],
            'time'          => ['time', ['@attributes', 'time']],
            'runners'       => ['int', ['@attributes', 'runners']],
            'handicap'      => ['bool', ['@attributes', 'handicap']],
            'trifecta'      => ['bool', ['@attributes', 'trifecta']],
            'stewards'      => ['string', ['@attributes', 'stewards']],
            'status'        => ['string', ['@attributes', 'status']],
            'revision'      => ['int', ['@attributes', 'revision']],
            'weather'       => ['string', ['Weather', '@attributes', 'brief']],
            'brief'         => ['string', ['Going', '@attributes', 'brief']]
        ],
        'Horse' => [
            'horse_id'       => ['int', ['@attributes', 'id']],
            'name'           => ['string', ['@attributes', 'name']],
            'bred'           => ['string', ['@attributes', 'bred']],
            'status'         => ['string', ['@attributes', 'status']],
            'cloth_number'   => ['int', ['Cloth', '@attributes', 'number']],
            'weight'         => ['int', ['Weight', '@attributes', 'value']],
            'weight_text'    => ['string', ['Weight', '@attributes', 'text']]
        ],
        'Jockey' => [
            'jockey_id'     => ['int', ['@attributes', 'id']],
            'name'          => ['string', ['@attributes', 'name']]
        ],
        'Trainer' => [
            'trainer_id'    => ['int', ['@attributes','id']],
            'name'          => ['string', ['@attributes','name']]
        ]
    ]
];
