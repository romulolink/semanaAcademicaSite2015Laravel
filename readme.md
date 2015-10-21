## Laravel PHP Framework

### Instalação

1. composer install
1. configurar banco de dados em .env.example e copia-lo e renomear o novo arquivo para .env
1. gerar uma chave com  o camando php artisan key:generate
1. configurar APP_ID e APP_SECRET do Facebook em .env inserindo as entradas 

```
FACEBOOK_APP_ID=1234567890
FACEBOOK_APP_SECRET=SomeFooAppSecret 
````

1. A Aplicação no Facebook foi configurada pra a URL Callback em http://localhost:8000 padrão do laravel


1. Instale as tabelas padrão do laravel com o comando `php artisan migrate`

1. 
### Atualize a tabela de usuários padrão do laravel

In order to get Facebook authentication working with Laravel's built-in authentication, you'll need to store the Facebook user's ID in your user's table.

Naturally you'll need to create a column for every other piece of information you want to keep about the user.

You can store the access token in the database if you need to make requests on behalf of the user when they are not browsing your app (like a 3AM cron job). But in general you won't need to store the access token in the database.

You'll need to generate a migration to modify your `users` table and add any new columns.

> **Note:** Make sure to change `<name-of-users-table>` to the name of your user table.

```bash
$ php artisan make:migration add_facebook_columns_to_users_table --table="<name-of-users-table>"
```

Now update the migration file to include the new fields you want to save on the user. At minimum you'll need to save the Facebook user ID.

```php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            // If the primary id in your you user table is different than the Facebook id
            // Make sure it's an unsigned() bigInteger()
            $table->bigInteger('facebook_user_id')->unsigned()->index();
            // Normally you won't need to store the access token in the database
            $table->string('access_token')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn(
                'facebook_user_id',
                'access_token'
            );
        });
    }
}
```

Don't forget to run the migration.

```bash
$ php artisan migrate


1. Rode a aplicação com o comando `php artisan serve`