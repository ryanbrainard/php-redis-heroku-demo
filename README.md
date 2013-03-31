PHP Redis Demo
==============

This is a demo of using Redis with PHP on Heroku both as a session manager and direct usage.

Deployment
----------

1. `git clone git@github.com:ryanbrainard/php-redis-heroku-demo.git`
2. `cd php-redis-heroku-demo`
3. `heroku create --stack cedar --buildpack https://github.com/heroku/heroku-buildpack-php.git#redis`
4. `heroku addons:add redistogo:nano`
5. `git push heroku master`
6. Follow the instructions in the app for demoing different aspects of Redis with PHP on Heroku.

