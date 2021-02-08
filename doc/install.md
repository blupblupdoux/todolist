# Installation informations

## setup symfony

Install symfony project -> `composer create-project symfony/website-skeleton symfony_app`  
Create a .env.local file and config db user, password and db name  
Create db -> `bin/console d:d:c`  

For run back-end part -> in the back-end folder run `php -S localhost:8000 -t public`

## setup vue.js

The following install commands use vue CLI, check if install with `vue --version` if not install run `sudo npm install -g @vue/cli`

Install vue.js project -> `vue create vuejs_app`  
Install vue router  -> `vue add router`
Install vuex -> `vue add vuex`  
Install vutify -> `vue add vuetify`

For run front-end part : in the front-end folder run `npm run serve`

## manage cors

Install Nelmio Cors => `composer require nelmio/cors-bundle`

Then go to config/packages/nelmio_cors.yaml and replace the actual code by the following one :

```yaml 
nelmio_cors:
    defaults:
        allow_credentials: false
        allow_origin: []
        allow_headers: []
        allow_methods: []
        expose_headers: []
        max_age: 0
        hosts: []
        origin_regex: false
        # forced_allow_origin_value: ~
    paths:
        '^/api/':
            allow_origin: ['*']
            allow_headers: ['*']
            allow_methods: ['POST', 'PUT', 'GET', 'DELETE']
            max_age: 3600
```

Note : don't forget to clear symfony cache with `bin/console cache:clear` and to clear browser cache by checking the "disable cache" checkbox
