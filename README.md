# 🏠 Proyecto CaptaClick - Gestión Inmobiliaria

**CaptaClick** es una aplicación web desarrollada en **Laravel Jetstream** que permite la gestión integral de inmuebles, clientes y visitas dentro de una plataforma moderna, segura y eficiente.  
El sistema incluye un **asistente virtual con voz**, implementado con la API de **SpeechSynthesis**, que guía al usuario por la interfaz de manera accesible e interactiva.  

---

## 🎯 Objetivo del proyecto
Ofrecer una herramienta **profesional, escalable y automatizada** que permita:
- Gestionar **inmuebles** (alta, baja, modificación, filtros, subida de imágenes).  
- Administrar **clientes y usuarios**, con distintos roles (admin / usuario).  
- Controlar **visitas a inmuebles**, generando PDFs e informes automáticos.  
- Integrar **autenticación y gestión de usuarios** mediante **Laravel Jetstream** y **Sanctum**.  
- Optimizar la interacción del usuario con un **asistente virtual por voz (SpeechSynthesis)**.  
- Centralizar imágenes y documentos en **Firebase** para un acceso ágil y seguro. 

---

## 🛠️ Tecnologías utilizadas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Jetstream](https://img.shields.io/badge/Jetstream-7F4BEF?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Firebase](https://img.shields.io/badge/Firebase-FFCA28?style=for-the-badge&logo=firebase&logoColor=black)
![Nginx](https://img.shields.io/badge/Nginx-009639?style=for-the-badge&logo=nginx&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)
![SpeechSynthesis API](https://img.shields.io/badge/Web_Speech_API-4285F4?style=for-the-badge&logo=googlechrome&logoColor=white)

---

## 🧩 Arquitectura del sistema
El proEl proyecto sigue el patrón **MVC (Modelo–Vista–Controlador)** y se apoya en **Laravel Jetstream** para el sistema de autenticación y gestión de sesiones.  
Incluye:
- **Eloquent ORM** para la comunicación con la base de datos.  
- **Blade y Livewire** para las vistas interactivas.  
- **Middlewares personalizados** para proteger rutas y roles.  
- **Storage y FileSystem** para almacenar imágenes y documentos.  
- **DomPDF** para la generación de informes en PDF.
- **SpeechSynthesis API** para el asistente de voz que guía al usuario.
---

## ⚙️ Funcionalidades principales
- 👤 Registro e inicio de sesión con autenticación por roles.  
- 🏘️ Gestión de inmuebles: alta, edición, filtrado y eliminación.  
- ⭐ Sistema de **favoritos para clientes** completamente funcional.  
- 📅 Control de visitas y generación de informes en PDF.  
- 💬 **Asistente virtual con voz** (SpeechSynthesis) que explica la interfaz y mejora la accesibilidad.  
- 📨 Envío de notificaciones automáticas.  
- 💾 Subida de imágenes y almacenamiento en Firebase.  
- 🔒 Acceso protegido mediante **Jetstream** y **Sanctum**.  

---

## 🧠 Estado actual del proyecto
📌 Proyecto funcional y en mejora continua.  
✅ Funcionalidades implementadas:
- [x] Sistema de favoritos para clientes.  
- [x] Asistente virtual con voz (SpeechSynthesis API).  
- [x] Gestión de inmuebles, clientes y visitas.  
- [x] Generación de PDFs e informes.  
- [x] Subida de imágenes a Firebase.  
- [x] Autenticación con Jetstream y Sanctum.  

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

```
## 📫 Contacto
👩‍💻 **Desarrolladora:** [Noelia Alafarga](https://www.linkedin.com/in/noelia-alafarga-backend/)  
📧 **Email:** [noelia.alafarga@gmail.com](mailto:noelia.alafarga@gmail.com)



