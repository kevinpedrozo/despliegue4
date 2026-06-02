# 🎓 Sistema de Registro Dual de Estudiantes (SENA)

Aplicación web desarrollada en PHP para el registro y consulta de estudiantes, utilizando un enfoque de persistencia dual: almacenamiento relacional en **PostgreSQL** y respaldo NoSQL en **MongoDB Atlas**. Desplegado completamente en la plataforma **Render**.

---

## 🔗 Enlaces del Proyecto

*   **URL Pública de la Aplicación:** `https://tu-app-estudiantes.onrender.com` *(Reemplaza esto con tu link real de Render)*
*   **Repositorio de GitHub:** `https://github.com/tu-usuario/tu-repositorio` *(Reemplaza con tu link de GitHub)*

---

## 📸 Evidencias de Funcionamiento

### 1. Interfaz de Usuario y Registro Exitoso
A continuación se muestra la interfaz principal con el formulario de registro y la confirmación de que el estudiante se guardó correctamente en ambos soportes de manera simultánea.

![Interfaz Principal](Aquí_pegas_la_foto_de_tu_pagina_web.png)

---

### 2. Evidencia de Inserción en PostgreSQL (Render)
Consulta ejecutada en la base de datos relacional administrada por Render, demostrando la persistencia de los datos en la tabla `estudiantes`.

![Consola PostgreSQL](Aquí_pegas_la_foto_de_tu_base_de_datos_postgres.png)

---

### 3. Evidencia de Respaldo en MongoDB Atlas (NoSQL)
Vista desde el panel de MongoDB Atlas (Browse Collections) donde se comprueba la creación de los documentos correspondientes en formato BSON/JSON dentro de la colección.

![Dashboard MongoDB Atlas](Aquí_pegas_la_foto_de_tu_atlas_mongodb.png)

---

## 🛠️ Tecnologías Utilizadas

*   **Backend:** PHP (PDO para PostgreSQL)
*   **Gestor de Dependencias:** Composer (Librería oficial `mongodb/mongodb`)
*   **Base de Datos Relacional:** PostgreSQL (Hospedado en Render)
*   **Base de Datos NoSQL:** MongoDB Atlas (Cluster en la nube)
*   **Frontend:** HTML5 / Bootstrap 5 (Para el diseño estético)
*   **Despliegue:** Render Web Services