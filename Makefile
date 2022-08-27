build: docker-compose.yml .env
	docker-compose -f docker-compose.yml build $(c)
up: docker-compose.yml .env
	docker-compose -f docker-compose.yml up -d $(c)
start: docker-compose.yml .env
	docker-compose -f docker-compose.yml start $(c)
down: docker-compose.yml .env
	docker-compose -f docker-compose.yml down $(c)
stop: docker-compose.yml .env
	docker-compose -f docker-compose.yml stop $(c)