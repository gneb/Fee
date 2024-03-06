
# Simple fee calculator

this is simple project to demonstrate calculation of fees based on client/transaction types in different currencies. ``` project includes just few tests```




## Requirements

- PHP 7.4 with mbstring, xml, bcmath and curl is required.
- Composer version 2.7.1 is used to install dependencies.

## installation

- clone repository in environment which supports all dependencies written above in requirements section.
- navigate inside project directory
- run ```composer install```
- run ```composer dump-autoload```

## set up

- rename or create copy of ```.env.example``` file in same dir.
- get your api key from ```exchangeratesapi.io```  and assign it to ```EXCHANGE_RATE_API_KEY``` inside ```.env```
- if you do not have api key or too lazy to register there which requires your credit card entere, you can uncomment ```line 42``` in ```index.php``` and comment ```line 39```. in this case if modify ```input.csv``` file with more currencies, please add that currencies in ```line 42``` too

## running

- simple navigate in project directory and run ```php index.php input.csv```, or change ```php``` with php location is used in env, for example ```/usr/bin/php```

## testing

- navigate inside project root dir
- run ```composer run test```