# api-reviews

Test application in Symfony 5

## Create local dev environment with Vagrant

```bash
git clone https://github.com/mariapf/api-reviews.git
cd api-reviews/
composer install --ignore-platform-reqs
php vendor/bin/homestead make
cp .env .env.local
vagrant up
vagrant ssh
```

Load fixtures for testing purposes

```
php bin/console doctrine:fixtures:load
```
Update hosts file `/etc/hosts` using data from `./Homestead.yaml` for example.:

```
# Api Reviews
192.168.10.70 reviews.test
```
