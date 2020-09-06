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

Update hosts file `/etc/hosts` using data from `./Homestead.yaml` for example.:

```
# Api Reviews
192.168.10.70 reviews.test
```

Run migrations
```
php bin/console doctrine:migrations:migrate
```
Load fixtures for testing purposes

```
php bin/console doctrine:fixtures:load
```
Stats api endpoint

```
[GET] /hotel/{Id}/reviews-stats
```
Body request sample

```
{
    "id": 6,
    "dateStart": "2020-01-01",
    "dateEnd": "2020-01-15"
}
```

The endpoint use a DTO layer for the input data and output and serialize the output with the serializer symfony component

Output sample
```
[
    {
        "review-count": 12,
        "average-score": "2.5000000000000000",
        "date-group": "1"
    },
    {
        "review-count": 13,
        "average-score": "2.8461538461538462",
        "date-group": "2"
    },
    {
        "review-count": 17,
        "average-score": "2.0000000000000000",
        "date-group": "3"
    },
    {
        "review-count": 16,
        "average-score": "2.0000000000000000",
        "date-group": "4"
    },
    {
        "review-count": 9,
        "average-score": "2.3333333333333333",
        "date-group": "5"
    },
    {
        "review-count": 11,
        "average-score": "3.1818181818181818",
        "date-group": "6"
    },
    {
        "review-count": 21,
        "average-score": "2.5714285714285714",
        "date-group": "7"
    },
    {
        "review-count": 12,
        "average-score": "2.6666666666666667",
        "date-group": "8"
    },
    {
        "review-count": 18,
        "average-score": "2.5555555555555556",
        "date-group": "9"
    },
    {
        "review-count": 13,
        "average-score": "2.6153846153846154",
        "date-group": "10"
    },
    {
        "review-count": 14,
        "average-score": "2.5000000000000000",
        "date-group": "11"
    },
    {
        "review-count": 13,
        "average-score": "2.5384615384615385",
        "date-group": "12"
    },
    {
        "review-count": 14,
        "average-score": "2.5714285714285714",
        "date-group": "13"
    },
    {
        "review-count": 13,
        "average-score": "2.5384615384615385",
        "date-group": "14"
    }
]
```



