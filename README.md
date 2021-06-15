## Running The App
- run: docker-compose up  --build -d.
- run: sudo docker exec -it {BuiltServiceName} composer install. 
- run tests: sudo docker exec -it {BuiltServiceName} ./vendor/bin/phpunit --filter=CustomerTest. 
- check http://127.0.0.1:8080/ for main page. 
- api endpoint is http://127.0.0.1:8080/api/v1/customer with country filter and validity filter. 
