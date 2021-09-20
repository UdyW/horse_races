<?php
return [
    'horse_racing' => [
        'Meeting' => [
            'meeting_id'    => ['int', ['Meeting','@attributes','id']],
            'date'          => ['date', ['Meeting','@attributes','date']],
            'country'       => ['string', ['Meeting','@attributes','country']],
            'status'        => ['string', ['Meeting','@attributes','status']],
            'course'        => ['string', ['Meeting','@attributes','course']],
            'revision'      => ['int', ['Meeting','@attributes','revision']]
        ],
        'Race' => [
            'race_id'       => ['int', ['Meeting', 'Race', '@attributes', 'id']],
            'date'          => ['date', ['Meeting', 'Race', '@attributes', 'date']],
            'time'          => ['time', ['Meeting', 'Race', '@attributes', 'time']],
            'runners'       => ['int', ['Meeting', 'Race', '@attributes', 'runners']],
            'handicap'      => ['bool', ['Meeting', 'Race', '@attributes', 'handicap']],
            'trifecta'      => ['bool', ['Meeting', 'Race', '@attributes', 'trifecta']],
            'stewards'      => ['string', ['Meeting', 'Race', '@attributes', 'stewards']],
            'status'        => ['string', ['Meeting', 'Race', '@attributes', 'status']],
            'revision'      => ['int', ['Meeting', 'Race', '@attributes', 'revision']],
            'weather'       => ['string', ['Meeting', 'Race', 'Weather', '@attributes', 'brief']],
            'brief'         => ['string', ['Meeting', 'Race', 'Going', '@attributes', 'brief']]
        ],
        'Horse' => [
            'horse_id'       => ['int', ['Meeting', 'Race', 'Horse', '@attributes', 'id']],
            'name'           => ['string', ['Meeting', 'Race', 'Horse', '@attributes', 'name']],
            'bred'           => ['string', ['Meeting', 'Race', 'Horse', '@attributes', 'bred']],
            'status'         => ['string', ['Meeting', 'Race', 'Horse', '@attributes', 'status']],
            'cloth_number'   => ['int', ['Meeting', 'Race', 'Horse', 'Cloth', '@attributes', 'number']],
            'weight'         => ['int', ['Meeting', 'Race', 'Horse', 'Weight', '@attributes', 'value']],
            'weight_text'    => ['string', ['Meeting', 'Race', 'Horse', 'Weight', '@attributes', 'text']]
        ],
        'Jockey' => [
            'jockey_id'     => ['int', ['Meeting', 'Race', 'Horse','Jockey', '@attributes', 'id']],
            'name'          => ['string', ['Meeting', 'Race', 'Horse','Jockey', '@attributes', 'name']]
        ],
        'Trainer' => [
            'trainer_id'    => ['int', ['Meeting', 'Race', 'Horse','Trainer','@attributes','id']],
            'name'          => ['string', ['Meeting', 'Race', 'Horse','Trainer','@attributes','name']]
        ]
    ]
];
