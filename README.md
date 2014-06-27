INSTALL PROJET
========================


1) Clone project
-------------------------------------
$git clone https://github.com/songcat/31.git


2) Install ruby and compass
-------------------------------------
http://rubyinstaller.org/
$gem update --system
$ gem install compass


3) Install vendors
-------------------------------------
$php composer.phar install


4) Install assets
-------------------------------------
### windows. (*do it at every img update*)
$php app/console assets:install
### unix. (*more friendly*)
$php app/console assets:install --symlink


5) Update the parameters.yml
-------------------------------------
### windows
compass.bin: 'C:\Ruby(version)\bin\compass'
ruby.bin: 'C:\Ruby(version)\bin\ruby.exe'
### mac os
ruby.bin: /usr/bin/ruby
compass.bin: /usr/bin/compass

6) for CSS and JS 
-------------------------------------
### dev
$php app/console assetic:dump --watch
### prod
$php app/console assetic:dump --env=prod
