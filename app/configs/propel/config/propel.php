<?php

return [
    'propel' => [

        'paths' => [
            // The directory where Propel expects to find your `schema.xml` file.
            'schemaDir' => '../../app/propel/v3/schemas',

            // The directory where Propel should output generated object model classes.
            'phpDir' => '../../app/',
        ],


        'database' => [
            'connections' => [
                'client_project_data' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=10.0.80.19;port=3306;dbname=plantlogic',
                    'user'       => 'root',
                    'password'   => 'P@$$w0rd',
                    'attributes' => [],
                    'settings'  => [
                        'charset'=> 'utf8mb4'
                    ]
                ],
            ]
        ],
        'generator'=>[
            'namespaceAutoPackage'=>true,
            'packageObjectModel'=>true,
            'schema'=>[
                'autoPackage'=>true,
                'autoNamespace'=>true,
                'autoPrefix'=>true
            ]
        ]
    ]
];