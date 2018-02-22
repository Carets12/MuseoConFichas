## Instalación de la máquina virtual

Para reducir el tiempo de preparación del entorno, la tendencia actual es usar máquinas virtuales y/o contenedores.

Vagrant es una herramienta para la creación y configuración de entornos de desarrollo virtualizados. Originalmente se desarrolló para VirtualBox y sistemas de configuración tales como Chef, Salt y Puppet. Sin embargo ya es capaz de trabajar con múltiples proveedores, como VMware, Amazon EC2, LXC, DigitalOcean, etc.​ Se ha desarrollado en Ruby.

Descargamos la última versión de Vagrant desde su Website.

Puedes encontrar [máquinas listas para trabajar en esta Web.](https://app.vagrantup.com/boxes/search)

### Instalación de Homestead

 Descargamos la plantilla de Internet. No instala aún ninguna aplicación, es sólo la plantilla, como los ".ova" de VirtualBox.

```
vagrant box add laravel/homestead
```

Clonamos una configuración base para esta plantilla desde GitHub e inicializamos el directorio:

```
git clone https://github.com/laravel/homestead.git ~/Homestead
```

Ahora ejecutamos el script para crear el fichero Homestead.yaml

```
// Mac / Linux...
bash init.sh

// Windows...
init.bat
```

Configuramos la máquina que vamos a levantar desde el fichero Homestead.yaml:

```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

#authorize: ~/.ssh/id_rsa.pub

#keys:
#    - ~/.ssh/id_rsa

# Suponemos que tenemos el proyecto clonado en el directorio
# /home/usuario/workdir/proyectos/museo-ciencias de la máquina
# física. Las carpetas "code" las usaremos para pruebas.

folders:
    - map: /home/usuario/code
      to: /home/vagrant/code
    - map: /home/usuario/workdir/proyectos/museo-ciencias/laravel
      to: /home/vagrant/museo

sites:
    - map: homestead.app
      to: /home/vagrant/code/public
    - map: museo.app
      to: /home/vagrant/museo/public

# nombre de la BBDD: homestead, usuario: homestead, password: secret
databases:
    - homestead

# blackfire:
#     - id: foo
#       token: bar
#       client-id: foo
#       client-token: bar

# para ver MySQL desde la máquina física
ports:
     - send: 33306
       to: 3306
#     - send: 7777
#       to: 777
#       protocol: udp

```

Añadimos el nuevo HOST en el fichero de hosts de nuestro sistema operativo:

    Linux:  /etc/hosts
    Windows:  C:\Windows\System32\drivers\etc\hosts


En las primeras líneas del fichero Homestead.yaml puedes ver que la IP es 192.168.10.10, luego es los ficheros arriba reseñados, hay que incluir estas líneas para tener acceso a ls sitios Web:

```
# Laravel Homestead sites

192.168.10.10	homestead.app
192.168.10.10	museo.app

```

Como puedes ver en el archivo de configuración, mapeamos la carpeta "física" code de nuestra máquina, con la carpeta "virtual" code de la máquina virtual.

Hay que crear en ambos lados la carpeta "code".

Ahora ya podemos lanzar la máquina virtual desde el directorio que clonamos de GitHub con el comando:

```
vagrant up

$ composer global require "laravel/installer"

$ composer create-project --prefer-dist laravel/laravel code
```
