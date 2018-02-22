# Cómo arrancar el proyecto desde GitHub

## Cómo funciona Apache /NGINX

Virtualhosts

Hemos añadido un virtual host: museo.app (la IP la he configurado en el /etc/hosts de linux o en el C:\windows\system32\drivers\etc\hosts).

## Clonando el proyecto (empezar de cero)

Aunque no es lo normal, nosotros tenemos nuestro proyecto dividido en tres directorios:
*. doc: Este directorio contiene toda la documentación para ayudarte con el desarrollo de la aplicación y para dar tus primeros pasos en Laravel.
*. database: Este directorio contiene el código SQL de la primera versión de la base de datos.
*. laravel: Este directorio contiene 

Creamos un directorio para el clonado y clonamos el repositorio:
```
$ mkdir test
$ cd test
$ git clone -b develop https://gitlab.iesvirgendelcarmen.com/juangu/museo-ciencias
```

Para montar el servicio, ahora tenemos que ver la ruta completa de Laravel:
```
$ cd museo-ciencias/
$ cd laravel/
$ pwd
/home/matinal/test/museo-ciencias/laravel
```

Esta ruta la tenemos que añador a nuestro fichero **Homestead.yaml**.
Si además, quiero añadir un nuevo host, por ejemplo: **test.app** para probar la configuración, tenemos que darlo de alta en los ficheros: */etc/hosts* de linux o en el *C:\windows\system32\drivers\etc\hosts* (añadimos el nuevo host 192.168.10.10 test.app):

```
# Laravel Homestead sites

192.168.10.10   homestead.app
192.168.10.10   museo.app       
192.168.10.10   test.app
```

Y en el fichero Homestead.yaml (editamos el fichero, p.ej. $ geany ~/Homestead/Homestead.yaml):

```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox
folders:
    - map: /home/juangu/workdir/proyectos/test/museo-ciencias/laravel
      to: /home/vagrant/code
    - map: /home/juangu/workdir/proyectos/museo-ciencias/laravel
      to: /home/vagrant/museo
    - map: /home/juangu/test/museo-ciencias/laravel
      to: /home/vagrant/test   
sites:
    - map: homestead.app
      to: /home/vagrant/code/public
    - map: museo.app
      to: /home/vagrant/museo/public
    - map: test.app
      to: /home/vagrant/test/public
databases:
    - homestead
ports:
     - send: 33306
       to: 3306
```

Ahora hay que reiniciar la máquina para que coja los cambios:

$ cd ~/Homestead
$ vagrant reload --provision

El siguiente paso es inicializar la configuración de Laravel:
1. Ejecutamos composer install
2. Creamos o copiamos el fichero .env

Para primer paso, entramos dentro de la máquina:
``` 
$ vagrant ssh
vagrant@homestead:~$ cd test 
vagrant@homestead:~$ composer install
```

Si no tenemos copia del fichero **.env** de otra versión del proyecto, puedes usar esta configuración:

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:PaAlRecSuq7pD4VaSvph/e9Uu73dtWH73ak5ocYb0nM=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

## Descargando cambios del GitLab

Si otro compañero sube cambios al repositorio y queremos actualizar nuestro repo local, hay que ejecutar el comando **git pull** desde el directorio del proyecto (NO desde la carpeta laravel).

## Subiendo cambios al GitLab

Si queremos subir cambios al GitLab, hay que añadir los ficheros modificados con *git add [fichero]*, aceptamos los cambios con *git commit -m "mensaje"* y subimos al servidor con git *push origin develop*.

Muy importante, **solo hacemos git add** a los ficheros de trabajo, no a todo.


