# Panel de Gestión de Alumnos FP - MVC PHP

## Descripción del Proyecto

Este es un sistema de gestión de alumnos de Formación Profesional desarrollado con el patrón arquitectónico Modelo-Vista-Controlador (MVC) en PHP. La aplicación permite gestionar comprehensive la información de estudiantes incluyendo su datos personales, académicos y de contacto, con un sistema de autenticación y control de acceso basado en roles.

## Arquitectura y Estructura

### Patrón MVC
- **Modelos (`models/`)**: Gestión de datos y lógica de negocio
- **Vistas (`views/`)**: Presentación de la interfaz de usuario
- **Controladores (`controllers/`)**: Coordinación entre modelos y vistas
- **Librerías (`libs/`)**: Clases base y funcionalidades comunes

### Estructura de Directorios
```
├── bd/                     # Scripts de base de datos
├── class/                  # Clases de entidad
├── config/                 # Configuración y privilegios
├── controllers/            # Controladores de la aplicación
├── functions/              # Funciones auxiliares
├── libs/                   # Librerías base (MVC)
├── public/                 # Recursos estáticos (Bootstrap, icons)
├── template/               # Plantillas y layouts
├── views/                  # Vistas específicas
└── index.php              # Punto de entrada
```

## Características Principales

### Gestión de Alumnos
- **CRUD Completo**: Crear, leer, actualizar y eliminar alumnos
- **Validación Robusta**: Validación del lado del servidor para todos los campos
- **Búsqueda y Ordenamiento**: Búsqueda textual y ordenamiento por múltiples criterios
- **Datos Completos**: 
  - Información personal (nombre, apellidos, DNI, fecha de nacimiento)
  - Contacto (email, teléfono, dirección, población, provincia)
  - Académicos (curso asignado)

### Sistema de Autenticación
- **Registro de Usuarios**: Sistema completo de registro con validación
- **Login Seguro**: Sesiones seguras con tokens CSRF
- **Gestión de Contraseñas**: Cambio y recuperación de contraseñas
- **Protección contra XSS**: Saneamiento de datos de entrada

### Control de Acceso Basado en Roles (RBAC)
- **Tres Niveles de Acceso**:
  - **Administrador (Rol 1)**: Acceso completo a todas las funcionalidades
  - **Editor (Rol 2)**: Puede consultar, modificar y añadir, pero no eliminar
  - **Registrado (Rol 3)**: Solo puede realizar consultas

### Seguridad
- **Protección CSRF**: Tokens en todos los formularios
- **Saneamiento de Datos**: Filtros para prevenir ataques XSS
- **Validación de Entrada**: Validación estricta de todos los datos
- **Sesiones Seguras**: Configuración segura de sesiones PHP

## Base de Datos

### Tablas Principales
- **alumnos**: Datos de los estudiantes
- **cursos**: Información de los cursos disponibles
- **users**: Sistema de usuarios para autenticación
- **roles**: Definición de roles de usuario
- **roles_users**: Relación muchos a muchos entre usuarios y roles

### Relaciones
- Los alumnos pertenecen a un curso (relación muchos a uno)
- Los usuarios pueden tener múltiples roles (relación muchos a muchos)

## Interfaz de Usuario

### Tecnologías Frontend
- **Bootstrap 5.3.8**: Framework CSS para diseño responsivo
- **Bootstrap Icons 1.13.1**: Iconos para la interfaz
- **HTML5 Semántico**: Estructura accesible y bien organizada

### Características UI
- **Diseño Responsivo**: Adaptado a móviles y tablets
- **Menús Contextuales**: Diferentes opciones según rol de usuario
- **Feedback Visual**: Mensajes de éxito, error y notificaciones
- **Formularios Validados**: Validación en tiempo real y feedback claro

## Flujo de Trabajo

### Flujo de Usuario Típico
1. **Login**: Usuario autentica sus credenciales
2. **Dashboard**: Acceso al panel principal según sus permisos
3. **Gestión**: Realiza operaciones permitidas según su rol
4. **Logout**: Cierre seguro de sesión

### Ejemplos por Rol
- **Administrador**: Puede crear, editar, eliminar y ver todos los alumnos
- **Editor**: Puede crear, editar y ver, pero no eliminar registros
- **Registrado**: Solo puede consultar y buscar información de alumnos

## Validación y Reglas de Negocio

### Validaciones Implementadas
- **Campos Obligatorios**: Nombre, apellidos, email, DNI, teléfono, fecha nacimiento, curso
- **Formatos Específicos**:
  - Email: formato de correo válido
  - DNI: 8 números + letra (formato español)
  - Teléfono: 9 dígitos
  - Fecha: formato Y-m-d
- **Unicidad**: Email y DNI deben ser únicos en el sistema
- **Claves Foráneas**: Curso debe existir en la tabla de cursos

## Desarrollo y Mantenimiento

### Buenas Prácticas Implementadas
- **Separación de Responsabilidades**: MVC claro y definido
- **Código Reutilizable**: Componentes y partials para vistas
- **Configuración Centralizada**: Constantes y settings en archivos dedicados
- **Manejo de Errores**: Sistema centralizado de gestión de errores
- **Logging**: Sistema de notificaciones y mensajes de error

### Consideraciones Técnicas
- **PHP 7.4+**: Compatible con versiones modernas de PHP
- **MySQL 5.7+**: Base de datos relacional
- **HTTPS**: Recomendado para producción
- **PHP Sessions**: Gestión de estado del usuario

## Extensibilidad

El sistema está diseñado para ser fácilmente extensible:
- **Nuevo Modelo**: Crear clase en `class/` y modelo en `models/`
- **Nuevo Controlador**: Extender de `Controller` base
- **Nuevas Vistas**: Utilizar sistema de layouts y partials
- **Nuevos Roles**: Configurar en `config/privileges.php`

## Próximos Pasos Sugeridos

1. **API REST**: Exponer funcionalidades como API
2. **Testing Unitario**: Implementar PHPUnit para tests
3. **Optimización**: Caching y optimización de consultas
4. ** Internacionalización**: Soporte multiidioma
5. **Auditoría**: Sistema de logs de cambios
6. **Exportación**: CSV/PDF exportación de datos
7. **Dashboard Analytics**: Estadísticas y gráficos

## Tecnologías Utilizadas

- **Backend**: PHP 7.4+, MySQL
- **Frontend**: HTML5, CSS3 (Bootstrap 5), JavaScript vanilla
- **Arquitectura**: MVC
- **Seguridad**: PHP Sessions, CSRF Protection, XSS Protection
- **Versionado**: Git (repositorio local)

---

*Documento generado automáticamente para el sistema de gestión de alumnos FP*