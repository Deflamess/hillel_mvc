## Пример простой MVC ##


Все приложение, контроллеры, модели находятся в папке `app`

В папке bootstrap находится автозагрузчик классов autoload.php
В папке config находятся конфиг файлы
Папка public является DOCUMENT ROOT сервера, а файл index.php - точкой входа в приложение

В папке views находятся шаблоны HTML нашего проектика

Схематическое изображение следующее 

[Схематическое представление проекта](https://www.dropbox.com/s/0oyunywjsmqc4uh/%D0%A1%D0%BA%D1%80%D0%B8%D0%BD%D1%88%D0%BE%D1%82%202019-02-16%2011.32.22.png?dl=0)
### Задание №1 ###

Проект №1.

Реализовать небольшую систему управления пользователями.

Приложение должно иметь форму создания нового пользователя, редактирования существующего, и вывод всех пользователей в виде таблицы. В таблице должна быть кнопка (или ссылка) для удаления пользователя. Если нажать на ссылку с именем пользователя в таблице, то нужно показать информацию о пользователе.

Следует учитывать что в системе не может быть несколько одинаковых 

DB: id, name, age, email, address <br>
Model: UserModel (add, update, delete user) <br>
Controller: UserController.php <br>
Views: Users/user.phtml <br>

