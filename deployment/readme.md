# Production settings

## Don't forget to generate JWT keys
```bash
docker-compose exec php sh -c '
		set -e
		apk add openssl
		mkdir -p config/jwt
		jwt_passphrase=$JWT_PASSPHRASE
		echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
		echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
		setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
		setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
	'
```
