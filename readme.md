````md
# 🐉 Dungeons & Dragons — Campaign Manager (Laravel + Docker)

Aplicación web para gestionar partidas de **Dungeons & Dragons**: campañas, personajes, razas y perfiles de usuario.  
Proyecto desarrollado con una arquitectura moderna basada en **Docker Compose**, **Laravel** y un **proxy inverso Nginx**.

---

## 🎯 Objetivo del proyecto

- Centralizar la gestión de campañas y personajes.
- Autenticación completa (Login / Register) con **Laravel Breeze**.
- Interfaz personalizada (CSS propio) basada en una paleta de colores definida.
- API interna para datos dinámicos (ej. **reseñas** en el welcome).

---

## 🧰 Tecnologías utilizadas

- ⚙️ **Backend:** PHP 8.3, Laravel 12, Laravel Breeze
- 🗄️ **Base de datos:** MySQL
- 🌐 **Proxy inverso:** Nginx
- 🧪 **Testing / Seeds:** Seeders + Factories
- 🐳 **Infraestructura:** Docker + Docker Compose
- 🎨 **Frontend:** Blade + CSS (mobile-first)

---

## 🧩 Servicios que componen la aplicación

La aplicación se despliega mediante **Docker Compose** con varios contenedores:

- 🧱 **backend** → Laravel (Apache + PHP)  
- 🖥️ **frontend** → servidor Nginx con la parte pública (rutas específicas)  
- 🗄️ **db** → MySQL  
- 🛠️ **phpmyadmin** → administración visual de la BD  
- 🔁 **proxy** → Nginx como puerta de entrada (reverse proxy)

---

## 🏗️ Cómo arrancar / parar el despliegue

### ✅ Arrancar
Desde la raíz del proyecto:

```bash
docker compose up -d
````

### ⛔ Parar (manteniendo volúmenes)

```bash
docker compose down
```

### 🧹 Parar y eliminar contenedores huérfanos

```bash
docker compose down --remove-orphans
```

---

## 🔑 Cómo acceder a la aplicación (URL)

* 🌍 **Aplicación (proxy):**
  `http://localhost/`

* 🛠️ **phpMyAdmin:**
  `http://localhost/phpmyadmin/`

* 📡 **API interna (ejemplo):**
  `http://localhost/api/reviews`

> Nota: si cambias puertos o host, revisa tu `docker-compose.yml` y tu configuración del proxy.

---

## 🔁 Breve explicación del proxy inverso

El contenedor **proxy (Nginx)** actúa como **punto único de entrada** a toda la aplicación.

✅ Ventajas del reverse proxy:

* Unifica el acceso por un solo dominio/puerto (`http://localhost`)
* Redirige cada ruta al servicio correcto
* Evita exponer servicios internos directamente

Ejemplo de comportamiento típico:

* `/` → backend (Laravel)
* `/personajes` → frontend (público)
* `/api/*` → backend (API Laravel)
* `/phpmyadmin/` → phpMyAdmin

---

## 📦 Base de datos, migraciones y seeds

### Crear tablas + datos de prueba

```bash
docker compose exec backend php artisan migrate:fresh --seed
```

Esto genera la estructura (migraciones) y carga datos iniciales (seeders).

---

## ⭐ Reseñas en la página principal (API interna)

En la página principal se consumen reseñas desde una API interna:

* Endpoint: `GET /api/reviews`
* Devuelve reseñas públicas (`is_public = true`)
* Se renderizan dinámicamente en el welcome mediante `fetch()`

---

## 📁 Estructura del proyecto (resumen)

* `backend/` → Laravel (controllers, models, routes, views)
* `frontend/` → parte pública (si aplica)
* `docker/` → configuración de contenedores
* `docker-compose.yml` → orquestación de servicios
* `proxy/default.conf` (o similar) → reglas de Nginx reverse proxy

---

## ✅ Funcionalidades

* 🔐 Autenticación (Login / Register / Logout)
* 👤 Perfil de usuario
* 🎲 Gestión de campañas (Mis Partidas)
* 🧙 Gestión de personajes / razas
* ⭐ Reseñas dinámicas desde API interna
* 📱 Estilos **mobile-first** con CSS propio

---

## 📌 Futuras mejoras

* 🏆 Ranking / estadísticas globales
* 👥 Invitaciones a campañas y roles (DM / Player)
* 🧾 Panel de administración (moderación de reseñas)
* 🖼️ Avatares y galería de personajes
* 🌍 Internacionalización (ES / EN)

---

## 👨‍💻 Autores

**Jokin Berridi**
📍 Irun, Euskal Herria
📧 [ikdgg@plaiaundi.net](mailto:jokinberridi@hotmail.com)


**Arkaitz Amostegi**
📍 Irun, Euskal Herria
📧 [arkaitzamostegi@gmail.com](mailto:arkaitzamostegi@gmail.com)

---

## 🔗 Repositorio

* `https://github.com/ArkaitzAmostegi/Dungeons-Dragons`

