# Main goal:
Create API, that provides ability to save request info to it and get list of recieved requests.

## How to install  
  
### First step  
Need create folder for project.
Then use console command.  
```python
cd folder  
git init  
git clone https://github.com/watlf/api  
```

### Second step  
Check your db configuration in api/app/config/parameters.yml
Then use console command.  
```python
php bin/console doctrine:schema:update --dump-sql  
php bin/console server:run  
```

Then use Postman for check results.  
