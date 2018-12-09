# inventory-manager

## Setup
To set up the project go to the root folder and run `docker-compose up` this will start the docker containers for Apache and Mysql.

On start the database will be imported with some seed data. The schema for the DB is located in `/docker/mysql/init/schema.sql`

You can then access the app at `localhost` and the API endpoints at `localhost/api/[resource_name]`

The DB will be accessible at:

```
host: localhost

user: root

pass: A6#JajRA^f@@hnD
```

## API Docs
Full API docs with example code can be found at `https://documenter.getpostman.com/view/6102335/RzfiGTxj`

You can also find a Postman collection of test calls in the root of this repo. 

## Login Details 
A basic CRUD backend can be accessed with

```
user: admin

pass: platinumseed
```

## API Details
```
user: admin

pass: 9c2aee61575b1764f534914c508a831e005b070c3671f8ac6561704e32de9c82
```