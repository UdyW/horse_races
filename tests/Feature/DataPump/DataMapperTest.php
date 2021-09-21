<?php

namespace Tests\Feature\DataPump;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataMapperTest extends TestCase
{
    protected $dataMapper;

    protected $source = [
        "Meeting" =>  [
            "@attributes" =>  [
              "id" => "129250",
              "country" => "Eire",
              "status" => "Dormant",
              "date" => "20210728",
              "course" => "Galway",
              "revision" => "1"
            ],
            "Race" =>  [
              "@attributes" => [
                "id" => "1043591",
                "date" => "20210728",
                "time" => "1635+0100",
                "runners" => "20",
                "handicap" => "Yes",
                "showcase" => "No",
                "trifecta" => "No",
                "stewards" => "None",
                "status" => "Dormant",
                "revision" => "2"
              ],
              "Weather" => [
                "@attributes" =>  [
                    "brief" => "good race",
                  ]
              ],
              "Going" =>  [
                "@attributes" =>  [
                  "brief" => "good race",
                ]
                ],
              "Horse" =>  [
                  [
                  "@attributes" =>  [
                    "id" => "2496725",
                    "name" => "Dysart Diamond",
                    "bred" => "IRE",
                    "status" => "Runner",
                  ],
                  "Cloth" =>  [
                    "@attributes" =>  [
                      "number" => "1",
                    ]
                    ],
                  "Weight" =>  [
                    "@attributes" =>  [
                      "units" => "lbs",
                      "value" => "164",
                      "text" => "11st 10lbs",
                    ]
                    ],
                  "Jockey" =>  [
                    "@attributes" =>  [
                      "id" => "1177674",
                      "name" => "J B Foley",
                    ],
                    "Allowance" =>  [
                      "@attributes" =>  [
                        "units" => "lbs",
                        "value" => "7",
                      ]
                    ]
                      ],
                  "Trainer" =>  [
                    "@attributes" =>  [
                      "id" => "1171",
                      "name" => "W P Mullins",
                    ]
                    ],
                  ],
                  [
                  "@attributes" =>  [
                    "id" => "2300199",
                    "name" => "Ena Baie",
                    "bred" => "FR",
                    "status" => "Runner",
                  ],
                  "Cloth" =>  [
                    "@attributes" =>  [
                      "number" => "2",
                    ]
                    ],
                  "Weight" =>  [
                    "@attributes" =>  [
                      "units" => "lbs",
                      "value" => "157",
                      "text" => "11st 3lbs",
                    ]
                    ],
                  "Jockey" =>  [
                    "@attributes" =>  [
                      "id" => "2837",
                      "name" => "M P Walsh",
                    ]
                    ],
                  "Trainer" =>  [
                    "@attributes" =>  [
                      "id" => "59464",
                      "name" => "C O'Dwyer",
                    ]
                  ]
                  ]
              ]
            ]
          ]
    ];

    protected $schemaConfig = [
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
                'race_id'       => ['int', ['Meeting', 'Race', '@attributes', 'id']],
                'handicap'      => ['bool', ['Meeting', 'Race', '@attributes', 'handicap']],
            ],
            'Horse' => [
                'race_id'       => ['int', ['Meeting', 'Horse', 0,'@attributes', 'id']]
            ],
            'Jockey' => [
                'jockey_id'     => ['int', ['Meeting', 'Horse', 0, 'Jockey', '@attributes', 'id']]
            ],
            'Trainer' => [
                'trainer_id'    => ['int', ['Meeting', 'Horse', 0, 'Trainer','@attributes','id']],
                'name'          => ['string', ['Meeting', 'Horse', 0, 'Trainer','@attributes','name']]
            ]
        ]
    ];

    protected function setUp(): void
    {
        $this->dataMapper = new \App\DataPump\DataMapper('horse_racing', $this->source);
        parent::setUp();
    }
    /**
     * test to assert if GetValueFromMapPath returns a valid string
     *
     * @return void
     */
    public function testGetValueFromMapPathFunctionReturnsValidString()
    {
        $path = ['int' ,['@attributes', 'id']];

        $this->assertEquals("129250", $this->dataMapper->getValueFromMapPath(
            $path,
            ["@attributes" =>  [
                "id" => "129250",
                "country" => "Eire",
                "status" => "Dormant",
                "date" => "20210728",
                "course" => "Galway",
                "revision" => "1"
            ]]
        ));
    }

    /**
     * test to assert if GetValueFromMapPath returns an exception for invalid path
     *
     * @return void
     */
    public function testGetValueFromMapPathFunctionReturnsInvalidIndex()
    {
        $path = ['int', ['foo', 'bar']];

        $this->expectException(\Exception::class);

        $this->expectErrorMessage('Index path not valid');

        $this->dataMapper->getValueFromMapPath($path, []);
    }

    /**
     * test to assert if getEntitiesForSchema returns a array of entities
     *
     * @return void
     */
    public function testGetEntitiesForSchemaReturnsAList()
    {
        $this->assertEquals(
            ['Meeting', 'Race', 'Horse', 'Jockey', 'Trainer'],
            $this->dataMapper->getEntitysForSchema($this->schemaConfig)
        );
    }

    /**
     * test to assert if getEntitiesForSchema returns a array of entities
     *
     * @return array
     */
    public function testfindMappingForEntity(): array
    {
        $maparray = $this->dataMapper->findMappingForEntity('Meeting');

        $this->assertIsArray($maparray);

        $this->assertArrayHasKey('meeting_id', $maparray);

        return $maparray;
    }

    /**
     * test to assert if getEntitiesForSchema returns a array of entities
     *
     * @return void
     */
    public function testInterateThroughSourceArray()
    {
        $modelContainer = $this->dataMapper->interateThroughSourceArray($this->schemaConfig, $this->source);
        $this->assertIsArray($modelContainer);
        $this->assertEquals('7', count($modelContainer));
    }

    /**
     * test to assert if createModelFromMapArray returns a valid entity
     * @depends testfindMappingForEntity
     * @return void
     */
    public function testCreateModelFromMapArray(array $maparray)
    {
        $singleModel = $this->dataMapper->createModelFromMapArray(
            'Meeting',
            ["@attributes" =>  [
                "id" => "129250",
                "country" => "Eire",
                "status" => "Dormant",
                "date" => "20210728",
                "course" => "Galway",
                "revision" => "1"
            ]]
        );
        $this->assertInstanceOf(\App\Models\Meeting::class, $singleModel[0]);
        $this->assertEquals('129250', $singleModel[0]->meeting_id);

        $multyModel = $this->dataMapper->createModelFromMapArray('Horse', [
        [
            "@attributes" =>  [
              "id" => "2496725",
              "name" => "Dysart Diamond",
              "bred" => "IRE",
              "status" => "Runner",
            ],
            "Cloth" =>  [
              "@attributes" =>  [
                "number" => "1",
              ]
              ],
            "Weight" =>  [
              "@attributes" =>  [
                "units" => "lbs",
                "value" => "164",
                "text" => "11st 10lbs",
              ]
              ],
            "Jockey" =>  [
              "@attributes" =>  [
                "id" => "1177674",
                "name" => "J B Foley",
              ],
              "Allowance" =>  [
                "@attributes" =>  [
                  "units" => "lbs",
                  "value" => "7",
                ]
              ]
                ],
            "Trainer" =>  [
              "@attributes" =>  [
                "id" => "1171",
                "name" => "W P Mullins",
              ]
              ],
          ],
            [
            "@attributes" =>  [
              "id" => "2300199",
              "name" => "Ena Baie",
              "bred" => "FR",
              "status" => "Runner",
            ],
            "Cloth" =>  [
              "@attributes" =>  [
                "number" => "2",
              ]
              ],
            "Weight" =>  [
              "@attributes" =>  [
                "units" => "lbs",
                "value" => "157",
                "text" => "11st 3lbs",
              ]
              ],
            "Jockey" =>  [
              "@attributes" =>  [
                "id" => "2837",
                "name" => "M P Walsh",
              ]
              ],
            "Trainer" =>  [
              "@attributes" =>  [
                "id" => "59464",
                "name" => "C O'Dwyer",
              ]
            ]
          ]
        ]);

        $this->assertInstanceOf(\App\Models\Horse::class, $multyModel[0]);
        $this->assertEquals('2', count($multyModel));
    }
}
