#!/bin/sh
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console init:acl
php app/console doctrine:fixtures:load
