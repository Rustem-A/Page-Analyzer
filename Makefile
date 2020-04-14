install:
	 composer install
lint:
	composer run-script phpcs -- --standard=PSR12 app routes tests
push:
	git push -u origin master
test:
	composer run-script phpunit tests
logs:
	tail -f storage/logs/lumen.log
# run:
# 	php -S localhost:8000 -t public
