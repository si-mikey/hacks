#!/usr/bin/env php
<?php


$json = file_get_Contents("http://search.twitter.com/search.json?q=json&rpp=5&include_entities=true");

$pretty_json =  json_decode($json, true);

print_r($pretty_json);
