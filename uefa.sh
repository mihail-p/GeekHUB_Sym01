#!/bin/bash

echo;
echo "what you wanna do?"
echo "0 - create base, schema and load fixtures"
echo "1 - run tests"
echo "2 - clear cache"
echo "3 - drop database"
echo "9 - exit"
echo;

read key

case "$key" in
   "0" ) 
   ./app/console doctrine:database:create
   ./app/console doctrine:schema:update --force   
   ./app/console h:d:f:l -n
   ;;
   "1" ) 
      ./phpunit -c app
   ;;
   "2" ) 
    ./app/console cache:clear  
   ;;
   "3" ) 
    ./app/console doctrine:database:drop --force 
   ;;
   "9" ) ;;
esac
