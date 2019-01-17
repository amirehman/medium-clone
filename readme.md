## Medium Clone

MediumClone is a clone of [Medium](https://medium.com) with simple features. It was created as the test project for the [Mindvalley](https://www.mindvalley.com/) using [Laravel](https://laravel.com) and [Vuejs](https://vuejs.org).

### Features!
  - User can create own profile.
  - Add Multiple Files
  - Mulitiple Images as slider
  - Featured Articles
  - Latest Articles
  - Articles by tags
  - Articles by user and tags
  - Articles by User
  - Testing
  - Seeding using faker

### How To Install

Pull repository to your invorment ``` https://github.com/amirehman/medium-clone.git ```

Install composser and run this command
```  $ Composer install ```

Install Node.js and run npm install
``` $ npm install ```

Create database and update you ` .env ` file with database username and password

Generate new key for your project
```$ php artisan key:generate ```

Clear Cache after chnages in `.env` file
```$ php artisan config:cache ```

Migrate all your tables to database
```$ php artisan migrate ```

After this run this for seeding data to database.
```$ php artisan db:see ```

And you are good to go! :)