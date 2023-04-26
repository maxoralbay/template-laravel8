docker-up:
	docker-compose --env-file ./backend/.env up

docker-up-d:
	docker-compose --env-file ./backend/.env up -d

docker-down:
	docker-compose --env-file ./backend/.env down