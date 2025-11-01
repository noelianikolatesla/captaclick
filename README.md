# 🏠 Proyecto CaptaClick - Gestión Inmobiliaria

**CaptaClick** es una aplicación web desarrollada en **Laravel** que permite la gestión integral de inmuebles, clientes y visitas dentro de una plataforma moderna, segura y eficiente.  
El sistema está diseñado para facilitar el trabajo de agentes inmobiliarios y administradores, centralizando toda la información en un solo panel.

---

## 🎯 Objetivo del proyecto
Ofrecer una herramienta **profesional, escalable y automatizada** que permita:
- Gestionar **inmuebles** (alta, baja, modificación, filtros, subida de imágenes).  
- Administrar **clientes y usuarios**, con distintos roles (admin / usuario).  
- Controlar **visitas a inmuebles**, generando PDFs e informes automáticos.  
- Integrar **autenticación segura** con Laravel Sanctum.  
- Optimizar el flujo de trabajo mediante **notificaciones** y almacenamiento en **Firebase**.

---

## 🛠️ Tecnologías utilizadas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Firebase](https://img.shields.io/badge/Firebase-FFCA28?style=for-the-badge&logo=firebase&logoColor=black)
![Nginx](https://img.shields.io/badge/Nginx-009639?style=for-the-badge&logo=nginx&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)

---

## 🧩 Arquitectura del sistema
El proyecto sigue el patrón **MVC (Modelo–Vista–Controlador)** con enfoque **backend–first**, aprovechando:
- **Eloquent ORM** para la comunicación con la base de datos.  
- **Blade** como motor de plantillas.  
- **Rutas protegidas** mediante middlewares.  
- **Storage y FileSystem** para almacenar imágenes y documentos.  
- **PDF y DomPDF** para generar informes de visitas.  

---

## ⚙️ Funcionalidades principales
- 👤 Registro e inicio de sesión con autenticación por roles.  
- 🏘️ Gestión de inmuebles: alta, edición, filtrado y eliminación.  
- 📅 Control de visitas y generación de PDFs.  
- 📨 Envío de notificaciones automáticas.  
- 💾 Subida de imágenes y almacenamiento en Firebase.  
- 🔒 Acceso protegido mediante **Laravel Sanctum**.  

---

## 🧠 Estado actual del proyecto
📌 Proyecto funcional y en mejora continua.  
✅ Funcionalidades implementadas:
- [x] Sistema de favoritos para clientes.  
- [x] Gestión de inmuebles, clientes y visitas.  
- [x] Generación de PDFs e informes de visitas.  
- [x] Subida y almacenamiento de imágenes en Firebase.  
- [x] Autenticación por roles con Laravel Sanctum. 
🧩 Próximas mejoras:
- [ ] Panel estadístico con métricas de rendimiento.  
- [ ] Integración de IA para sugerencias de inmuebles.  

---

## 🖥️ Ejemplo de estructura del proyecto
```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
├── Models/
├── Views/
├── Routes/
└── Database/
