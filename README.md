# WorkoutDatabase

This is a fork of a repo by dlargent for the purposes of testing pushing it to Heroku.

## Adjustments for Heroku

1. Modifying DB connections in accordance with [https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php](https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php) to use the system credentials for accessing ClearDB securely.

1. I've also added a php/dbSetup.php file to build the relevant table(s) before running the other stuff.



