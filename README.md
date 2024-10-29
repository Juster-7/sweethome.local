<p align="center"><img src="https://github.com/Juster-7/sweethome.local/blob/main/public/images/logo4.png"></p>
<p>Проект сайта на Laravel и MySQL.</p>
<p>Сайт статей о доме/квартире, ремонте, дизайне.</p>
<p>- Реализован механизм древовидных комментариев к статьям.</p>
<p>- Реализован магазин с корзиной товаров</p>
<p>- Реализована регистрация, загрузка аватара</p>
<p>- Реализован REST API (Sanctum authentication) для регистрации, авторизации и работы с товарами (Route::apiResource)</p>
<p>- Добавлена валидация через FormRequest во все формы ввода</p>
<p>- Реализовано внедрение зависимостей (Dependency Injection) в классах контроллеров</p>
<p>- Настройка Policy и middleware (can) для Comment delete</p>
<p>- Реализована генерация аватарок (Intervention Image v3) в UserFactory для User и хранение в Storage</p>
<p>- Создана команда artisan command csmfs (Clear Storage and Migrate:Fresh --Seed), удаляющая аватарки и загружающая фейковые данные заново</p>
<p>- Написаны тесты для API, авторизации, моделей, консольных команд (покрытие 50%)</p>
<p>- Реализован Trait ProfilePhotoStorage для работы с аватарками в разных частях сайта</p>
<br>
<p>Laravel.................9.52.16</p>
<p>PHP.....................8.1.9</p>
