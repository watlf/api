# Main goal:
Create API, that provides ability to save request info to it and get list of resaved requests.

## How to install  
  
### First step  

Use console command.  
```python 
git clone https://github.com/watlf/api  
cd folder api
composer update
```

### Second step  
Use console command.  
```python
php bin/console doctrine:database:create
php bin/console doctrine:schema:create 
php bin/console server:run  
```

Then use Postman for check results.  
