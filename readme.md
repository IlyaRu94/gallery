# Простой скрипт галереи изображений на PHP

1. Добавлен функционал авторизации и регистрации.
2. В БД записываются комментарии, названия картинок, пользователи.
3. Есть возможность удаления своих комментариев (чужие удалить нельзя).
4. На странице с комментариями реализована загрузка комментариев с помощью fetch.
5. При удалении картинки, стираются из базы комментарии, относящиеся к этой картинке.
6. Пользователи с одинаковыми логинами зарегистрироваться не могут.
7. Если загружаются 2 файла с одинаковым именем - файл переименовывается, к названию добавляется timestamp
8. При регистрации и авторизации реализована проверка на безопасные символы, путем масок.
9. На страницах авторизации и регистрации добавлены стили, реализован подробный вывод ошибок...
10. У незарегистрированных пользователей есть возможность только просмотра.

К сожалению, было мало времени на выполнение этой работы, можно было бы реализовать намного большее...

Логин/пароль для проверки: admin/admin
вторую учетную запись попрошу зарегистрировать самостоятельно