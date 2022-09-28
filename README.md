
"make", "docker" and "docker-compose" must be installed

## Install steps

git clone https://github.com/awoodsT/test-quotes.git

cd ./test-quotes

make install

## Testing web
Then go to http://0.0.0.0:8888 and enter a credentials:

email - test@example.com
password - 12345678

## Testing api

First of all you need authorized:
http://0.0.0.0:8888/api/login

curl -X POST \
  'http://0.0.0.0:8888/api/login' \
  --header 'User-Agent: Thunder Client (https://www.thunderclient.com)' \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data-raw '{
  "email": "test@example.com",
  "password": "12345678"
}

you will get token like this `1|NgUFOuuJhKVIbJmpqvy8A9IZkHzJ2UAXlljaNLgO`


then send request to 
http://0.0.0.0:8888/api/office
with your authorization token and you will get quotes


curl -X GET \
  'http://0.0.0.0:8888/api/office' \
  --header 'User-Agent: Thunder Client (https://www.thunderclient.com)' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 1|NgUFOuuJhKVIbJmpqvy8A9IZkHzJ2UAXlljaNLgO'
