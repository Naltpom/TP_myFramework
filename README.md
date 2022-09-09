# TP_myFramework

## Installation
TP_myframework est disponnible sur git https://github.com/Naltpom/TP_myFramework

```sh
  $ git clone https://github.com/Naltpom/TP_myFramework
```

## Mise en place de App, utilité de l'App
1. App nos permet de renseigner toutes nos information de notre framework dans notre `src\Services\Container\container.php`
2. On intégre le container dans notre App `Services\App::set($container)`

## Systeme du routing
Pour mettre en place une nouvelle route vers le controller
1. Les controllers sont dans le dossier `app\controllers` 
2. On met en place nos route avec les annotations 
> #[Route(path: '/blog/{id}', method: 'GET')]
2. On precise les parametres dans le fichier `config/routes.yaml` nos routes
```yaml
BlogController_index:
  pattern:   \/
  connect:  App\Controllers\BlogController:index
```

## Construction du router
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

## Template
Pour les views on intégre tiwg à notre projet
Les template des view sont dans le dossier `templates`
> doc twig : https://twig.symfony.com/doc/3.x/templates.html

## Le pattern dispatcher
Sert de connexion entre les differentes routes.