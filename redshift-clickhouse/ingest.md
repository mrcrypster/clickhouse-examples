# ClickHouse 
```sql
insert into wiki_stat_1b select * from url('https://clickhousetests.s3.eu-central-1.amazonaws.com/data.tsv.gz');
```

## multifile insert (10 files x 10m rows each)
```sql
insert into wiki_stat_1b select * from url('https://clickhousetests.s3.eu-central-1.amazonaws.com/data.tsv.gz');
```

## table size (10 minutes after insert)
```sql
SELECT
    formatReadableSize(sum(bytes)),
    count(*)
FROM system.parts
WHERE (table = 'wiki_stat_1b') AND active
```

## multifile insert (10 files x 10m rows each)
```sql
COPY wiki_stat_1b
FROM 's3://clickhousetests/wiki_stat_'
iam_role 'arn:aws:iam::580253803458:role/TestRedShiftClusterAndS3'
region 'eu-central-1' delimiter '\t' gzip;
```

# Redshift
```sql
COPY wiki_stat_1b
FROM 's3://clickhousetests/data.tsv.gz'
iam_role 'arn:aws:iam::580253803458:role/TestRedShiftClusterAndS3'
region 'eu-central-1' delimiter '\t' gzip;
```

## table size (after 10 minutes from insert)

```sql
SELECT "table", size, tbl_rows FROM SVV_TABLE_INFO
```
