# Trial test work
* Create .env file from .env.dist in the root of project
* Please configurate DB connection
*  $ mkdir var/jwt
*  $ openssl genrsa -out var/jwt/private.pem -aes256 4096
*  $ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
* You can find Insomnia config in the root of this project
* composer install
* bin/console doctrine:migrations:migrate
* bin/console doctrine:fixtures:load
* Use login endpoint to get auth token. Use credentials _username=johndoe _password=test
* Set the token to header of all other endpoints Authorization: "Bearer $token"
* Go ahead :)


