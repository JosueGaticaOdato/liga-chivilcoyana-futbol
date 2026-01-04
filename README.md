# Liga Chivilcoyana de Fútbol – Sitio Web Oficial

## 📌 Descripción del proyecto

Este proyecto consiste en un **sitio web desarrollado con Laravel** para la **Liga Chivilcoyana de Fútbol**, una liga local de la ciudad de Chivilcoy.

El objetivo principal es centralizar y digitalizar toda la información relevante de la liga, permitiendo a los usuarios acceder de manera clara, rápida y ordenada a:

* Partidos y resultados
* Tablas de posiciones
* Información de equipos
* Noticias oficiales de la liga

El sistema contempla todas las categorías, desde **Primera División hasta las divisiones inferiores**.

---

## 🎯 Objetivos del sistema

* Brindar un **portal informativo moderno** para la liga local
* Facilitar la **visualización de tablas y fechas**
* Centralizar la información de equipos y categorías
* Permitir la publicación de noticias relevantes
* Servir como **base escalable** para futuras funcionalidades (estadísticas, usuarios, árbitros, etc.)

---

## 🏗️ Tecnologías utilizadas

* **Backend:** Laravel (PHP)
* **Frontend:** Blade + HTML5 + CSS3 + JavaScript
* **Base de datos:** MySQL
* **ORM:** Eloquent
* **Control de versiones:** Git
* **Gestión de dependencias:** Composer / NPM

---

## 📂 Estructura general del proyecto

```
/app
 ├── Models        # Modelos Eloquent (Equipo, Partido, Tabla, Noticia, etc.)
 ├── Http
 │   ├── Controllers  # Controladores del sistema
 │   └── Middleware
/resources
 ├── views         # Vistas Blade
 ├── css           # Estilos
 ├── js            # Scripts
/routes
 ├── web.php       # Rutas web del proyecto
/database
 ├── migrations    # Migraciones de la base de datos
 ├── seeders       # Datos iniciales
/public
 ├── storage       # Archivos públicos (escudos, imágenes, etc.)
```

---

## ⚽ Módulos principales

### 🏟️ Equipos

* Listado de todos los equipos de la liga
* Visualización de:

  * Nombre
  * Escudo
  * Categoría
  * Información básica del club

---

### 📅 Partidos

* Calendario de partidos por categoría
* Visualización de:

  * Equipos enfrentados
  * Fecha y horario
  * Cancha
  * Resultado (cuando corresponda)

---

### 📊 Tablas de posiciones

* Tablas dinámicas por categoría
* Cálculo automático de:

  * Puntos
  * Partidos jugados
  * Ganados, empatados y perdidos
  * Goles a favor y en contra

---

### 📰 Noticias

* Publicación de noticias oficiales de la liga
* Información relevante:

  * Comunicados
  * Fechas importantes
  * Cambios de programación

---

## 🔐 Gestión y escalabilidad

El proyecto está pensado para crecer, permitiendo incorporar:

* Panel administrativo
* Roles de usuario (admin, prensa, público)
* Estadísticas avanzadas
* Historial de temporadas
* Integración con redes sociales

---

## 🚀 Instalación y configuración

1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
```

2. Instalar dependencias

```bash
composer install
npm install
```

3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en `.env`

5. Ejecutar migraciones

```bash
php artisan migrate
```

6. Levantar el servidor

```bash
php artisan serve
```

---

## 🧪 Estado del proyecto

🚧 **En desarrollo**

El proyecto se encuentra en constante evolución, agregando mejoras visuales, optimizaciones de código y nuevas funcionalidades.

---

## 👤 Autor

**Josue Gatica Odato**
Proyecto académico y profesional orientado a resolver una necesidad real de la comunidad deportiva local.

---

## 📄 Licencia

Este proyecto es de uso educativo y comunitario. La licencia podrá definirse en futuras versiones.

---

⚽ *Liga Chivilcoyana de Fútbol*
