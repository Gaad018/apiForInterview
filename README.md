

## О проекте
Тестовое задание для компании ООО "Максимал" на позицию младшего разработчика. 
```text
Api для хранилища товаров на Laravel. 

2 сущности:
Поставщик
Товар

api реализовывает:
1. crud для товаров
2. crud для поставщиков
3. Получить список товаров
4. Получить список поставщиков

В списке поставщиков должно быть указано общее кол-во его товаров. 
В списке товаров должно быть указано название поставщика. 
Так же список товаров можно отсортировать по цене(от меньшей к большей и наоборот) и отфильтровать по названию поставщика.
```
`Версия PHP 7.3`
## Запуск проекта
-----------
:open_file_folder: Зайти в папку куда вы хотите загрузить проект, открыть консоль    
:computer: Выполнить следующие команды:    
```php
git clone https://github.com/VladPil/apiForInterview
cd apiForInterview
composer install
```
:heavy_check_mark: Чтобы убедиться, что laravel готов к запуску выполните следующую команду:    
```
php artisan
```
:pencil2: Скопировать данные из файла .env.example новый файл .env   
1. Вы можете использовать уже созданную базу данных(пункт 3) или создать новую(пункт 2)
2. :books: Создать базу данных laravel (utf8mb4_unicode_ci) и для заполнения данными выполните в консоли эти команды:    
```php
php artisan migrate
php artisan db:seed
```
3.:computer: Загрузить дамп базы данных(файл laravel.sql) и выполнить следующие команды:    
```
php artisan key:generate
php artisan serve
```
`Api готово к работе!`    

Доступные api routes: 
-----------
![image](https://user-images.githubusercontent.com/39692367/111138459-c79b3a80-85a1-11eb-99c3-c2a36097b23f.png)

Коды ответов на запросы: 
-----------
+ GET
    :heavy_check_mark: "OK" - 200
    :o: "Bad Request" - 400
+ POST
    :heavy_check_mark: 201
    :o: "The given data was invalid" - 422
+ PUT
    :heavy_check_mark: "OK" - 200
    :o: "Bad Request" - 400
+ DELETE
    :heavy_check_mark: "OK" - 204
    :o: "Bad Request" - 400

Структура базы данных:
-----------
`products`    
| id | name_product | description_product | cost_product | supplier_id | created_at | updated_at |    
|:----:|:-------------:|:-----------------:|:---------------:|:--------------:|:-------------------:|:--------------------:| 
| int(10) | varchar(191) | text | int(11) | int(10) | timestamp | timestamp |    

`suppliers`
| id | name_supplier | created_at | updated_at |
|----------------|:---------------:|-------------:|:----------:
| int10 | varchar(191) | timestamp | timestamp |    
