# TP_myFramework

## Mise en place de App
1. App nos permet de resnseigner toutes nos information de notre framework notre container
- Pour cela on a besoin de mettre en place un container
2. On intégrer le container dans notre App `Services\App::set($container)`

## Mise en place du routing
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