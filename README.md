# TP_myFramework

## Utilisation
### Installation 
TP_myframework est disponnible sur git https://github.com/Naltpom/TP_myFramework

```sh
  $ git clone https://github.com/Naltpom/TP_myFramework
```

### Server
Le lancement du serveur se fait a partir du fichier index.php dans le dossier public qui sera visible par le client 
```sh
php -S 127.0.0.1:8000 public/index.php
```



### Systeme du routing
Pour mettre en place une nouvelle route vers le controller
#### routes.yaml (To be replaced by 'route attributes')
Pour ajouter une nouvelle route avec `config/routes.yaml` il suffit d'ajouter dans ce fichier les information nessessaire a cette route. Exemple:

```yaml
BlogController_show:
  pattern:  \/blogs\/(?P<id>[1-9][0-9]*)
  connect:  App\Controllers\BlogController:show
  params:   id
```
#### route attributes
WIP: Il sera possible de definir les routes directement sur les controller en definissant l'attribut `#[Route]` => `use Services\Routing\Route;` et renseigner different paramettres tel que `path, methods, ..`
```php
#[Route(path: '/blog/{id}', method: 'GET')]
```

### Systeme de templating
Pour les views on intégre tiwg à notre projet
On a definit le dossier `templates` pour contenir les templates twig recuperable dans les controllers.
> doc twig : https://twig.symfony.com/doc/3.x/templates.html.

On met a disposition dans `AbstractController` ce model de templating.
Dans nos controller on va pouvoir `return $this->twig->render(..)` et dans ce render on mettre le path du template a afficher a placer dans le dossier `templates`.

### Les controllers
Pour ajouter des controllers
- namespace `namespace App\Controller`.
- nom du fichier = "nom de la class".php.
- la class doit `extends AbstractController` pour befinifier des render twig par exemple.

```php 
<?php #app/Controllers/TestController.php
namespace App\Controller;

use Services\AbstractController;

class TestController extends AbstractController
{}
```

### twig Templates
On ajoute nos fichier twig dans le dossier `templates`

## Le framework

### Construction du router
1. On crée la class `Route` 
- On va definir les informations essenciels pour du routing pour instancier notre class
    - ?string $path     => Url 
    - ?string $pattern  => Pattern de l'url
    - array $methods    => Method [GET, POST, PATCH, PUT, DELETE]
    - ?string $connect  => Information pour recuperer la bonne function, Chemin de la class et nom de la function
    - array $params     => params suplementaire

2. On precise dans le fichier `config/routes.yaml` nos routes
```yaml
BlogController_index:
  pattern:   \/
  connect:  App\Controllers\BlogController:index
```
3. Dans `app.php` on va construire notre `Router::class` en lisant le fichier YAML
4. Notre `Router::class` construit avec des `Route::class` nous avons besoin de fetch une route en particulier pour executer la function definie pour celle-ci
5. Maintenant on place notre `Router::class` dans le container `$container['router']` (avant l'insersion du $container dans l'app)


### Construction du model de view
Pour cela on import twig dans notre `$container['view']`

### Fonctionnement de l'App
1. App nos permet de renseigner toutes nos information de notre framework dans notre container `src\Services\Container\container.php`
Il contient nos routes et nos views 
`$container['routes'], $container['router'],$container['view']`
2. On intégre le container dans notre app.php `Services\App::set($container)`

### Le dispatcher
Lors de l'utilisation de l'app, `public/index.php` va executer notre dispatcher avec la `Request` recuperer du client sur le server.
Avec celle ci il va permettre de lire le bon controller, la bonne fonction et definira a celle si les bon parametres, pour ainsi return le comportement souhaité par cette funciton.