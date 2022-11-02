#!/bin/bash

echo $(curl -X GET http://syncapi/api/captor -H 'Content-Type: application/json' -H 'Accept: application/json')

i=1
error_count=0
while [ $i -le 10 ]
do
    curr_client=$((10000 + $RANDOM % 99999));
    curr_name=$((1000 + $RANDOM % 9999));
    curr_valueint=$((1 + $RANDOM % 50));
    curr_valuebool=$(($RANDOM % 2));
    uid=$(curl -X POST http://syncapi/api/captor -H 'Content-Type: application/json' -H 'Accept: application/json' -d '{"client_id": "'${curr_client}'","name": "'${curr_name}'","value_int": "'${curr_valueint}'","value_bool": "'${curr_valuebool}'"}' | jq -r '.uid');
    checktest=$(curl -X GET http://syncapi/api/captor/check/${uid} -H 'Content-Type: application/json' -H 'Accept: application/json');
    check=$(curl -X GET http://syncapi/api/captor/check/${uid} -H 'Content-Type: application/json' -H 'Accept: application/json' | jq -r '.check');
    
    echo $checktest | jq -r '.Local';
    echo $checktest | jq -r '.Cloud';
    echo 'is the same ?' $check;

    if [ "$check" != true ] 
    then 
        error_count=$(( $error_count + 1 ));
    fi

    i=$(( $i + 1 ));
done
echo 
echo ______RESULT______
echo
echo 'error count = '$error_count;
echo __________________
echo 

echo $(curl -X GET http://syncapi/api/captor -H 'Content-Type: application/json' -H 'Accept: application/json')
#curl -X POST http://syncapi/api/captor -H 'Content-Type: application/json' -H 'Accept: application/json' -d '{"client_id": "987451","name": "caca","value_int": "65","value_bool": "0"}' | jq -r '.uid' 