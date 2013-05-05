#!/usr/bin/env php
<?php





$raw = '22. 11. 1968';
$start = \DateTime::createFromFormat('d. m. Y', $raw);

echo $start->format("m/d/Y");








