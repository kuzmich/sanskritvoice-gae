#!/bin/bash
google_appengine/dev_appserver.py --storage_path=gae-storage --skip_sdk_update_check=true \
                                  --log_level=debug src/app.yaml

#--datastore_consistency_policy {consistent,random,time}
#--require_indexes=true
