# INFO0303 - TP n°10

Le résultat obtenu après le TP n°10.

## Récupération du dépôt

Pour récupérer le dépôt, tapez les commandes suivantes :

```
git clone https://gitlab-mi.univ-reims.fr/rabat01/tp10_breeze tp10_breeze
cd tp10_breeze
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
npm install
npm run build
```

Ouvrez le fichier *.env* et spécifiez la configuration de votre base de données sur les lignes suivantes :

```
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tp10_breeze
DB_USERNAME=root
DB_PASSWORD=
...
```

Exécutez la migration et le peuplement de la base de données en tapant les commandes suivantes :

```
php artisan migrate --seed
```