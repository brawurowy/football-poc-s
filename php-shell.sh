#!/bin/bash

docker exec -ti --env COLUMNS=`tput cols` --env LINES=`tput lines` football_poc_php_1  bash