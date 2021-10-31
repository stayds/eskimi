#clone laradock from github
git clone https://github.com/Laradock/laradock.git

#rename .env.example to .env
cd laradock
cp .env.example .env

#run containers
docker-compose up -d apache2 mysql php-worker workspace
