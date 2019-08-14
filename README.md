# delacon-api-php
A simple and clean Delacon Api integration in PHP.

## Installation
You can install the library by using composer command

```
composer require sooviet/delacon-api-php 
```

## Usage
Here is a simple example of how this library can be used.

```
$request = new \Delacon\Models\DelaconRequest();
$request->setDateFrom('2019-08-01'); // set date from parameter
$request->setDateTo('2019-08-14'); //set date to parameter

$delaconApi = new \Delacon\Application\XmlApplication($request, 'authentication', env('delacon_api_key'));

$response = $delaconApi->reports('json'); // gets json report data

```
