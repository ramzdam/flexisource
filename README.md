# Flexisource Exam
This is just a simple implementation of retrieving records and saving data using a Cron Job and Scheduler. This implementation is not yet optimize we can further improve this implementation by adding redis to save the records that way all `GET` method will only retrieve all records from the REDIS and if not existing retrieve it in the DB. As for the CronJob all record should be save in DB then in the Redis to make the record consistent.

## Create directory
Select a repository you want to deploy the application

```
mkdir ~/Desktop/flexisourceExam
cd ~/Desktop/flexisourceExam
```

## Clone repository

Clone the given repository into your local by running

```
git clone https://github.com/ramzdam/flexisource.git .
```

## Install dependency

Make sure composer is install in your dev machine

```bash
composer install
```

## Modify Host File
Edit your host file to support custom name

```shell
sudo vi /etc/hosts
```
Add the entry below in your host file then save

```shell
192.168.10.20   flexisource.com.test
```

## Vagrant container
Create your vagrant instance by running vagrant up

```shell
vagrant up
```

Connect to your vagrant container

```shell
vagrant ssh
```

Make sure that nginx is running (although by default this should be running)
```
sudo service nginx start
```

## Cron
We need to add an entry in your crontab to make sure that Jobs is processing the api properly. Run command below to open crontab
```
crontab -e
```
Input this line of code in the cron
```
* * * * * cd /home/vagrant/code && php artisan schedule:run >> /dev/null 2>&1
```

## Migrate
Migrate the files database tables by running command below while still inside the vagrant box.
```
php artisan migrate
```

## Usage
To retrieve all list of player run the command via POSTMAN

```
METHOD: GET
URL: http://flexisource.com.test/api/players
Sample Response: 
{
    "success": true,
    "data": [
        {
            "code": 6744,
            "first_name": "Lee",
            "second_name": "Grant",
            "form": "0.00",
            "total_points": 0,
            "influence": "0.00",
            ...
        }
     ]
}
```
To retrieve individual record below is the parameter
```
METHOD: GET
URL: http://flexisource.com.test/api/players/6744
Sample Response: 
{
    "success": true,
    "data": {
        "code": 6744,
        "first_name": "Lee",
        "second_name": "Grant",
        "form": "0.00",
            ...
     }    
}
```
## Database
To connect to your database below are the credential

```
Host: 192.168.10.20
Username: homestead
Password: secret
DB Name: homestead
```

## .env content
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:J35PLlTJr9PKMczQHWt0XuPjDmIXqs0Iz2ITxsvK1M4=
APP_DEBUG=true
APP_URL=http://flexisource.com.test

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=192.168.10.20
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

API_URL=https://fantasy.premierleague.com/api/bootstrap-static/
RESPONSE_FORMAT=application/json
```
## Homestead.yaml content
```
ip: 192.168.10.20
memory: 2048
cpus: 2
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: ~/Desktop/flexisource
        to: /home/vagrant/code
        type: "nfs"
sites:
    -
        map: flexisource.com.test
        to: /home/vagrant/code/public
databases:
    - homestead
features:
    -
        mariadb: false
    -
        ohmyzsh: false
    -
        webdriver: false
name: homesteadflexisource
hostname: homesteadflexisource
```
## License
[MIT](https://choosealicense.com/licenses/mit/)

### Developer
Madzmar Ullang  |  madzmar.ullang@gmail.com
