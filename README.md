# Fit360 – Plataforma SaaS para Gestión Integral de Gimnasios

Fit360 es una plataforma web desarrollada como proyecto intermodular DAW para la gestión, seguimiento y bienestar de usuarios en gimnasios y centros deportivos. El objetivo es ofrecer una solución SaaS multi-gimnasio que permita gestionar usuarios, rutinas, clases, nutrición, progreso físico y administración interna.

El sistema implementa **roles diferenciados** (admin, entrenador, dietista, socio), cada uno con su propio dashboard y funcionalidades específicas.

---

## 🚀 Funcionalidades principales

### 🔐 Autenticación y Roles
- Login seguro con contraseñas encriptadas.
- Roles: **admin**, **entrenador**, **dietista**, **socio**.
- Middleware de acceso por rol.
- Redirección automática al dashboard correspondiente.

### 👤 Perfil de Usuario
- Edición de datos personales.
- Subida de avatar con validación.
- Visualización de gimnasio asociado.
- Rol asignado automáticamente como *socio* en el registro.

### 🏋️ Rutinas y Entrenamientos
- Rutinas personalizadas por usuario.
- Rutinas creadas por entrenador.
- Registro de entrenamientos.
- Relación N:M entre rutinas y ejercicios.

### 🍎 Nutrición y Salud
- Registro diario de ingesta nutricional.
- Pautas nutricionales creadas por dietista.
- Seguimiento físico con peso, grasa, medidas corporales.

### 📅 Clases y Reservas
- Clases colectivas con aforo.
- Reservas y cancelaciones.
- Relación con entrenador y gimnasio.

### 📊 Administración
- Gestión de usuarios.
- Gestión de gimnasios.
- Configuración de roles.
- Estadísticas básicas.

---

## 🧱 Tecnologías utilizadas

### Frontend
- HTML5, CSS3, JavaScript
- Diseño responsive
- Figma para prototipado

### Backend
- PHP 8
- Arquitectura MVC básica
- Middleware por rol

### Base de Datos
- MariaDB / MySQL
- Modelo relacional normalizado
- Relaciones 1:N y N:M

---

## 📂 Estructura del proyecto

\\\C:.
│   index.php
│   README.md
│
├───backend
│   │   .gitkeep
│   │
│   ├───config
│   │       conexion.php
│   │       session.php
│   │
│   ├───controllers
│   │       gimnasio-controller.php
│   │       login-controller.php
│   │       logout.php
│   │       nutricion-controller.php
│   │       perfil-controller.php
│   │       progreso-controller.php
│   │       recuperar-controller.php
│   │       registro-controller.php
│   │       rutinas-controller.php
│   │       usuario-controller.php
│   │
│   ├───middleware
│   │       admin.php
│   │       auth.php
│   │       dietista.php
│   │       entrenador.php
│   │       socio.php
│   │
│   └───models
│           nutricion.php
│           progreso.php
│           rutinas.php
│           usuario.php
│
├───database
│       .gitkeep
│       fit360.sql
│
└───frontend
    ├───assets
    │   └───img
    │       ├───dashboard
    │       │       dashboard-banner.jpg
    │       │       icon-admin.png
    │       │       icon-bell.png
    │       │       icon-calendar.png
    │       │       icon-classes.png
    │       │       icon-dashboard.png
    │       │       icon-health.png
    │       │       icon-logout.png
    │       │       icon-nutrition.png
    │       │       icon-progress.png
    │       │       icon-routines.png
    │       │       icon-search.png
    │       │       icon-settings.png
    │       │       icon-stats.png
    │       │       icon-time.png
    │       │       icon-users.png
    │       │       icon-workout.png
    │       │       icon_-settings.png
    │       │
    │       ├───login
    │       │       login-bg.png
    │       │
    │       ├───logo
    │       │       logo-fit360.png
    │       │       _logo-fit360.png
    │       │       __logo-fit360.png
    │       │
    │       └───users
    │               avatar_1_1777751882.jpg
    │               avatar_3_1777751849.jpg
    │               avatar_9_1777799706.jpg
    │               default-avatar.png
    │
    ├───css
    │       admin-forms.css
    │       dashboard.css
    │       login.css
    │       nutricion.css
    │       perfil.css
    │       progreso.css
    │       rutinas.css
    │
    ├───js
    │       dashboard.js
    │       login.js
    │
    ├───views
    │   │   clases.php
    │   │   dashboard.php
    │   │   estadisticas.php
    │   │   login.php
    │   │   no-autorizado.php
    │   │   nutricion.php
    │   │   perfil.php
    │   │   progreso.php
    │   │   recuperar.php
    │   │   registro.php
    │   │   rutinas.php
    │   │   salud.php
    │   │
    │   ├───admin
    │   │       dashboard.php
    │   │       gimnasio-crear.php
    │   │       gimnasio-editar.php
    │   │       gimnasios.php
    │   │       perfil.php
    │   │       usuario-crear.php
    │   │       usuario-editar.php
    │   │       usuarios.php
    │   │
    │   ├───dietista
    │   │       dashboard.php
    │   │       perfil.php
    │   │
    │   └───entrenador
    │           dashboard.php
    │           perfil.php
    │
    └───_test
            test-login.html\\\

  
---

## 🗄 Base de datos

Incluye tablas para:

- usuario  
- gimnasio  
- clase  
- reserva_clase  
- rutina  
- rutinas (rutinas simples por usuario)  
- rutina_ejercicio  
- ejercicio  
- entrenamiento  
- progreso  
- nutricion  
- pauta_nutricional  
- seguimiento_fisico  

El script completo está en:  
`/database/fit360.sql`

---

## 🎨 Prototipado (Figma)

### Wireframes (baja fidelidad)
https://www.figma.com/proto/B5r8xgQMMH3xY3SEdn99ds/B_Wireframe_Fit360

### Mockups (alta fidelidad)
https://www.figma.com/proto/0gJyK0e2dz5K4jg8Wqsxyl/B_Wireframe_Fit360--Alta-fidelidad

---

## 🧪 Usuarios de prueba

> **Contraseña real de todos los usuarios: 123456**

| Email             | Rol        | Contraseña |
|------------------|------------|------------|
| clara@test.com   | admin      | 123456     |
| julia@test.com   | socio      | 123456     |
| julia2@test.com  | entrenador | 123456     |
| julia3@test.com  | dietista   | 123456     |

---

## 👩‍💻 Autora

**M. Pilar Galán Alís**  
Proyecto Intermodular DAW – 2026

