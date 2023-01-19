<?php

$f = gzopen('data.tsv.gz', 'r');

$times = [];

while ( $line = fgets($f) ) {
  $row = explode("\t", trim($line));

  # put into ClickHouse Cloud
  $times['clickhouse-cloud'] += $t;

  # put into Redshift
  $times['redshift-serverless'] += $t;

}

print_r($times);
