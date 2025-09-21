
# requisitos

## RF1 Roles
Establecemos 3 tipos de usuarios:
* Administrador
* Profesor
* Alumnos.

## Administración
* Admin puede asigar rol de admin a otros profesores

* Gestionar de forma administrativa (CRUD completo) los recursos involucrados:
    * * Teachers
    * * Students
    * * Guest
    * * Cycles
    * * Matrículas
    * * Family (Departaments)
    * * Speciality (Of Teachers)
    * * Projects
# Usuario de tipo profesor
* A nivel de administración (CRUD completo de):
* * Alumnos matriculados en un ciclo que pertenezca a su familia profesional
* * Proyectos de sus alumnos (que pertenezcan a su familia profesional)
* * Matrículas de sus alumnos
* 
* Uso de la aplicación
* * Consultar proyectos de sus alumnos
* * Generar informes de los proyectos de sus alumnos
* * Buscar información de los proyectos de sus alumnos


* Tener un listado de proyectos
* Ver o acceder a los mismos
* Poder buscar proyectos según información de criterios previamente establecidos

# Autenticación y autorización

* Gestionar la autenticación y los roles de usuario
* * Autenticar usuarios por nombre / pass
* * Autenticación por redes sociales (Google)
* * Roles: Admin, Teacher, Student, Guest

# Otras funcionalidades 
* Gestionar los proyectos a través de Google Drive
* Usar OpenAI para generar informes de los proyectos
* Usar OpenAI para buscar información de proyectos.

# Usuario Guest o visitante
 Una lading page con información de la aplicación.


O que solo Solo podemos acceder registrándonos. ?

> De momento que me muestre una página de bienvenida.





RF2. El Administrador puede crear, modificar y eliminar usuarios.
RF3. El Administrador puede crear, modificar y eliminar productos.
RF4. El Administrador puede crear, modificar y eliminar categorias.
<div align="center">
<table style="margin: auto; text-align: center;">
<tr>
<th colspan="2">
Bienvenida / Perfil
</th>
</tr>
<tr>
<td colspan="2">
Hola, Manuel 👋 (Rol: Profesor)
</td>
</tr>
<tr>
<td colspan="2">
Último acceso: 21/09/2025 08:34
</td>
</tr>
<tr>
<td colspan="2">
[Acceso rápido: Ver proyectos] [Generar informe]
</td>
</tr>
<tr><td colspan="2"></td></tr>
<tr>
<th>
Roles y permisos:
</th>
<th>Acciones rápidas:
</th>
</tr>
<tr>
<td>
✅ Ver proyectos
<br>
✅ Generar informes
<br>❌ Crear profesor
<br>→ [Solicitar al administrador]
</td>
<td>
[Mis Proyectos]
<br>[Buscar proyectos]
<br>[Subir documento]
<br>[Ver informes]
</td>
</tr>
<tr><td colspan="2"></td></tr>
<tr>
<th>
Estadísticas
</th>
<th>Notificaciones
</th>
</tr>
<tr>
<td>
• Proyectos activos: 8
<br>• Entregas pendientes: 3
<br>• Alumnos en ciclo: 24
</td>
<td>
- Alumno X subió archivo
<br>- Solicitud de <alta>  
<br>- Proyecto Y pendiente
</td>
</tr>
<tr><td colspan="2"></td></tr>
<tr>

<th colspan="2">
Enlaces útiles / Ayuda
</th>
</tr>
<tr>
<td colspan="2">
[Manual de usuario] [FAQ] [Soporte] [Google Drive]
</td>
</tr>
</table>
</div>
