# FocalPoint Migration

A quick way to migrate focal point data from https://github.com/smcyr/Craft-FocusPoint to the native implementation in Craft 3.

## Caveats:

In Craft-FocusPoint focal point data can be set per field. Craft 3's focal point information is set per asset. This means that two things:

1. You can only use one focal point per image.
2. This script isn't smart about what focal point it writes to the asset. If there are three focal points for the same image in the database from three different FocusPoint fields, the last occuring (highest ID) will win and the other two will disappear. 

## How to use:
- Clone this repository
- cp settings.example.php settings.php
- fill in the relevant details
- run the script via the command line `php migrate.php` and you should see:

```
Connected
Select returned 934 rows.
Updated asset: 10607 to 0.5000;0.5000
Updated asset: 8485 to 0.5000;0.5000
...
```
