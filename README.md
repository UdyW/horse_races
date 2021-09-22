Docker desktop required

Spinup the container

`./vendor/bin/sail up`

Create db

`php artisan migrate`

Check coding standerd
`./vendor/bin/phpcs --standard=PSR12 /{folder}`

run tests
`./vendor/bin/sail php artisan test`

populate data
`./vendor/bin/sail php artisan datapump:horse_racing`
