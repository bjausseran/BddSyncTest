

curl -X GET http://syncapi/api/captor -H "Accept: */*"
curl -X POST http://syncapi/api/captor -H "Accept: */*" -d "{client_id: 51684, name: caca, value_int: 20, value_bool: 0}}"
curl -X GET http://syncapi/api/captor -H "Accept: */*"