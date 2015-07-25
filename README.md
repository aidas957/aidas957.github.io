CyOTA - PHP OTA server for Cyanogenmod 11-12
======================
ace3.tk
======================
Need:
PHP 5.3
MySQL 5.1 
======================
Import ota.sql to db
Write you db setting to core/config.php
In DB add you build to table where:
builds_id = auto updates by sql server
builds_device = codename you device in build.prop = ro.product.device
builds_type = not use for now
builds_incremental = in build.prop = ro.build.version.incremental
builds_api_level = in build.prop  = ro.build.version.sdk
builds_url = link to download zip
builds_timestamp = in build.prop = ro.build.date.utc
builds_md5sum = md5 hash for build zip
builds_changes = link to change txt for build
builds_channel = nightly
builds_filename = Name for update in ota in cyanogenmod (!!!!need end .zip) example cm12-myupdate.zip
