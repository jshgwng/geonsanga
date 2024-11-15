<?php

use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;
use Uganda\Exceptions\DistrictNotFoundException;
use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\SubCountyNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

$obj = new stdClass();

Route::add('/v1/ping', function () {
  echo "Hello World";
}, 'GET');

// Get all districts
Route::add('/v1/districts', function () use ($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $districts = $uganda->districts();
    $count = count($districts);

    $names = [];
    foreach ($districts as $dist):
      $names[] = [
        "id" => $dist->id,
        "name" => $dist->name
      ];
    endforeach;
    $obj->count = $count;
    $obj->districts = $names;
  } catch (DistrictNotFoundException $e) {
    throw new DistrictNotFoundException(sprintf("You're sailing in unchartered waters, districts not found"));
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
}, 'GET');

// Get all Counties
Route::add('/v1/counties', function () use ($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $counties = $uganda->counties();
    $count = count($counties);

    $names = [];
    foreach ($counties as $county):
      $names[] = $county->name;
    endforeach;
    $obj->count = $count;
    $obj->counties = $names;
  } catch (CountyNotFoundException $e) {
    throw new CountyNotFoundException(sprintf("You're sailing in unchartered waters, counties not found"));
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
}, 'GET');

// Get all Sub Counties
Route::add('/v1/subcounties', function () use ($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $subcounties = $uganda->subcounties();
    $count = count($subcounties);

    $names = [];
    foreach ($subcounties as $subcounty):
      $names[] = $subcounty->name;
    endforeach;
    $obj->count = $count;
    $obj->subcounties = $names;
  } catch (SubCountyNotFoundException $e) {
    throw new SubCountyNotFoundException(sprintf("You're sailing in unchartered waters, subcounties not found"));
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
}, 'GET');

// Get all Parishes
Route::add('/v1/parishes', function () use ($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $parishes = $uganda->parishes();
    $count = count($parishes);

    $names = [];
    foreach ($parishes as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->parishes = $names;
  } catch (ParishNotFoundException $e) {
    throw new SubCountyNotFoundException(sprintf("You're sailing in unchartered waters, parishes not found"));
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
}, 'GET');

// Get all Villages
Route::add('/v1/villages', function () use ($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $villages = $uganda->villages();
    $count = count($villages);

    $names = [];
    foreach ($villages as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->villages = $names;
  } catch (VillageNotFoundException $e) {
    throw new VillageNotFoundException(sprintf("You're sailing in unchartered waters, villages not found"));
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
}, 'GET');
