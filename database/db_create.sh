#!/usr/bin/sh

rm villat.db
sqlite3 villat.db ".read villat.sql"
sqlite3 villat.db ".read populate.sql"
