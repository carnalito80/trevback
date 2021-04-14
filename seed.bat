@echo off
echo Kom ihåg att seedern kommer mosa in data även om data redan existerar. Kolla database\seeders\DatabaseSeeder.php och kommentera bort det du inte behöver.
pause
php artisan db:seed