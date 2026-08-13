# 🚀 Guía rápida de comandos Laravel (para principiantes)

Este archivo sirve como **chuleta (.md)** para tener a mano los comandos más usados en Laravel durante el desarrollo de un proyecto.

---

## 📦 Requisitos previos

* PHP >= 8.x
* Composer
* MySQL / PostgreSQL (u otro motor)
* Node.js y npm (para frontend)

Verificar versiones:

```bash
php -v
composer -V
node -v
npm -v
```

---

## 🆕 Crear un proyecto Laravel

### Opción 1: usando Composer

```bash
composer create-project laravel/laravel nombre-proyecto
```

### Opción 2: usando Laravel Installer

```bash
composer global require laravel/installer
laravel new nombre-proyecto
```

Entrar al proyecto:

```bash
cd nombre-proyecto
```

---

## ▶️ Levantar el servidor de desarrollo

```bash
php artisan serve
```

Por defecto corre en: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📦 Carpetas en Laravel

- App:
  - Http/Controllers: Controladores
  - Models: Modelos
  - Providers: Proveedores de servicios de laravel

- Bootstrap: Archivo necesario para la inicializacion del proyecto

- Config: Configuracion del proyecto (Autenticacion, BD, Cache, etc.)

- Database: Manejo de BD con migraciones

- Public: Raiz publica de la aplicacion, tiene el index.php

- Resources: Vistas

- Routes: Rutas, como navegamos la aplicacion

- Storage: Logs, cache, sesiones, archivos internos, etc.

- Test: Pruebas automatizadas

- Vendor: Carpeta que genera composer y almacena todas las dependencias


## ⚙️ Configuración inicial

### Copiar archivo de entorno

```bash
cp .env.example .env
```

### Generar APP_KEY

```bash
php artisan key:generate
```

### Limpiar cache de configuración

```bash
php artisan config:clear
php artisan cache:clear
```

---

## 🗄️ Base de datos

### Crear migraciones

```bash
php artisan make:migration create_users_table
```

### Ejecutar migraciones

```bash
php artisan migrate
```

### Revertir migraciones

```bash
php artisan migrate:rollback
```

### Refrescar base de datos (borra todo)

```bash
php artisan migrate:fresh
```

### Migrar + seeders

```bash
php artisan migrate --seed
```

---

## 🌱 Seeders (Semilla) y Factories

### Crear seeder

```bash
php artisan make:seeder UserSeeder
```

### Crear factory

```bash
php artisan make:factory UserFactory
```

### Ejecutar seeders

```bash
php artisan db:seed
```

---

## 🧠 Modelos

### Crear modelo

```bash
php artisan make:model User
```

### Modelo + migración

```bash
php artisan make:model Post -m
```

### Modelo + migración + controller + factory + seeder

```bash
php artisan make:model Post -a
```

#### En Laravel, las funciones del modelo NO son lógica de negocio, son definiciones de relaciones entre tablas

Sirven para que después puedas escribir cosas como
```
$equipo->torneos
$torneo->equipos
$partido->local->nombre_pila
```

---

## 🎮 Controllers

### Controller básico

```bash
php artisan make:controller PostController
```

### Controller tipo resource

```bash
php artisan make:controller PostController --resource
```

---

## 🛣️ Rutas

### Ver todas las rutas

```bash
php artisan route:list
```

---

## 🧩 Requests (validaciones)

```bash
php artisan make:request StorePostRequest
```

---

## 🔐 Autenticación

### Breeze (simple)

```bash
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev
```

---

## 🎨 Frontend (Vite)

### Instalar dependencias

```bash
npm install
```

### Modo desarrollo

```bash
npm run dev
```

### Build producción

```bash
npm run build
```

---

## 🧹 Cache y optimización

```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:clear
```

---

## 🐞 Debugging

```bash
php artisan tinker
```

---

## 🔎 Información útil

```bash
php artisan list
php artisan help migrate
```

---

## 📌 Consejos

* Usá `php artisan route:list` todo el tiempo
* Revisá `.env` antes de migrar
* Si algo falla: limpiar cache

---

## Orden de construccion

1. Migrations
        
2. Models + relaciones
        
3. Factories / Seeders
        
4. Form Requests / validaciones
        
5. Controllers
        
6. Routes
        
7. Views / Frontend
        
8. Tests

✍️ **Pensado para tenerlo siempre abierto mientras programás en Laravel**
