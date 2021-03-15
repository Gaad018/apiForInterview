

## О проекте

Тестовое задание для компании ООО "Максимал" на позицию младшего разработчика. 
Api для хранилища товаров на Laravel. 


## Запуск проекта
-----------
:open_file_folder: Зайти в папку куда вы хотите загрузить проект, открыть консоль    
:computer: Выполнить следующие команды:    
```php
git clone https://github.com/Gaad018/apiForInterview
composer install
```
:open_file_folder: Перейти в папку проекта    
:pencil2: Вписать данные в файл .env    
:computer: Выполнить следующие команды:    
```php
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan serve
```

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
