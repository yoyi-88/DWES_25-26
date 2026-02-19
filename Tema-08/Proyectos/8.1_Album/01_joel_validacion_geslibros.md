# Evaluación de Validación y Seguridad - Joel Gómez Benítez

## Información del Proyecto
- **Alumno**: Joel Gómez Benítez
- **Proyecto**: 07-crud-crud-usuarios (Gestión Libros)
- **Recurso Evaluado**: Formulario de Nuevo Libro
- **Fecha**: 12/02/2026

## Requisitos de Validación del Formulario

### 1. Título: Obligatorio ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada (línea 151)
- ✅ Mensaje de error claro: "El título es obligatorio."
- ✅ Campo marcado como required en el formulario (línea 76)
- ✅ Retroalimentación con clase CSS 'is-invalid'
- ✅ Mensaje de error específico para el campo

**Puntuación**: 10/10

### 2. Autor: Validación Clave Ajena ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada (líneas 154-158)
- ✅ Validación de formato numérico
- ✅ Validación de existencia en tabla autores mediante `validateAutor()`
- ✅ Mensajes de error específicos y claros
- ✅ Campo requerido en formulario con validación HTML5

**Puntuación**: 10/10

### 3. Editorial: Validación Clave Ajena ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada (líneas 161-163)
- ✅ Validación de formato numérico
- ✅ Validación de existencia en tabla editoriales
- ✅ Mensajes de error descriptivos
- ✅ Campo requerido en formulario

**Puntuación**: 10/10

### 4. Precio: Valor obligatorio ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada (línea 167)
- ✅ Validación de valor positivo
- ✅ Campo marcado como required en formulario
- ✅ Tipo input="number" con step="0.01"
- ✅ inputmode="decimal" para mejor UX móvil
- ✅ Placeholder informativo "0.00"

**Puntuación**: 10/10

### 5. Unidades: Opcional ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Campo implementado como opcional (sin validación de obligatoriedad)
- ✅ Validación solo si se proporciona valor
- ✅ Valor por defecto '0' adecuado
- ✅ Tipo input="number" apropiado

**Puntuación**: 10/10

### 6. Fecha Edición: Obligatorio, Formato tipo fecha ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada (línea 170)
- ✅ Campo tipo "date" HTML5
- ✅ Formato de fecha adecuado
- ✅ Validación de no vacío

**Puntuación**: 10/10

### 7. ISBN: Obligatorio, formato isbn (13 dígitos numéricos), Valor único ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad implementada
- ✅ Validación de formato mediante regex: `/^\d{13}$/`
- ✅ Validación de unicidad mediante `validateUniqueIsbn()`
- ✅ Máscara HTML5: maxlength="13" minlength="13" pattern="\d{13}"
- ✅ inputmode="numeric" para UX móvil
- ✅ JavaScript adicional para filtrado (líneas 149-152)
- ✅ Placeholder descriptivo: "Ej: 9788445077111"

**Puntuación**: 10/10

### 8. Géneros: Obligatorio (al menos 1), valores numéricos, valores existentes en tabla géneros ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Validación de obligatoriedad de al menos un género (línea 180-181)
- ✅ Checkbox para selección múltiple implementados
- ✅ Validación de valores numéricos implícita
- ✅ Valores cargados desde base de datos
- ✅ Manejo de arrays en PHP
- ✅ Retroalimentación visual de errores

**Puntuación**: 10/10

---

## Requisitos de Seguridad del Formulario

### 1. Reglas de validación ✅
**Estado**: IMPLEMENTADO EXCELENTE
**Análisis**:
- ✅ Validación completa del lado del servidor
- ✅ Validación de tipos de datos
- ✅ Validación de reglas de negocio
- ✅ Validación de claves foráneas
- ✅ Validación de unicidad
- ✅ Manejo estructurado de errores

**Puntuación**: 10/10

### 2. Prevenir ataques XSS ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Uso de `FILTER_SANITIZE_SPECIAL_CHARS` (líneas 24-31)
- ✅ Uso de `htmlspecialchars()` en la vista (línea 29, 75, 86, 96, 108)
- ✅ Limpieza de todas las entradas del formulario
- ✅ Sanitización antes de procesamiento

**Puntuación**: 10/10

### 3. Prevenir ataques CSRF ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Token CSRF generado con `bin2hex(random_bytes(32))` (línea 73)
- ✅ Token incluido como campo oculto en formulario (línea 23)
- ✅ Validación del token con `hash_equals()` (línea 117)
- ✅ Manejo de error si token inválido
- ✅ Regeneración de token por sesión

**Puntuación**: 10/10

### 4. Placeholder ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Título: "Ej: El Quijote" (línea 28)
- ✅ Precio: "0.00" (línea 74)
- ✅ ISBN: "Ej: 9788445077111" (línea 108)
- ✅ Placeholders descriptivos y útiles

**Puntuación**: 10/10

### 5. Mejorar accesibilidad ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Uso de etiquetas `<label>` correctamente asociadas con `for`
- ✅ Estructura semántica HTML5 apropiada
- ✅ Atributos `required` en campos obligatorios
- ✅ Tipos de input apropiados (text, number, date, etc.)
- ✅ Grupos de checkboxes con `<fieldset>` implícito
- ✅ Atributos `inputmode` para dispositivos móviles
- ✅ Mensajes de error asociados a campos

**Puntuación**: 9/10 (falta atributo `aria-describedby` para errores)

### 6. Máscaras para los campos requeridos ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ ISBN: maxlength="13", minlength="13", pattern="\d{13}" (línea 107)
- ✅ JavaScript adicional para filtrado de ISBN (líneas 149-152)
- ✅ Precio: step="0.01" para decimales (línea 72)
- ✅ Fecha: type="date" HTML5 nativo
- ✅ inputmode="numeric" para campos numéricos

**Puntuación**: 10/10

### 7. UX en Cancelar ✅
**Estado**: IMPLEMENTADO CORRECTAMENTE
**Análisis**:
- ✅ Botón cancelar implementado (línea 135)
- ✅ Confirmación JavaScript: `onclick="return confirm('¿Seguro que desea cancelar?')"`
- ✅ Redirección adecuada a lista de libros
- ✅ Estilo apropiado con clase `btn-secondary`

**Puntuación**: 9/10 (podría mejorarse con redirección más suave)

### 8. Mensajes de error ✅
**Estado**: IMPLEMENTADO EXCELENTE
**Análisis**:
- ✅ Mensajes específicos por campo
- ✅ Mensajes claros y descriptivos
- ✅ Uso de clases Bootstrap para feedback visual (`is-invalid`)
- ✅ Etiquetas `<div class="invalid-feedback">` para cada campo
- ✅ Mensaje general de error en formulario (línea 89)
- ✅ Persistencia de errores en sesión

**Puntuación**: 10/10

### 9. Retroalimentación de los campos del formulario ✅
**Estado**: IMPLEMENTADO EXCELENTE
**Análisis**:
- ✅ Sticky form: valores recuperados después de error (líneas 84-90)
- ✅ Clases CSS dinámicas según validación (`is-invalid`)
- ✅ Valores preseleccionados en selects (líneas 42, 58)
- ✅ Checkboxes marcados según selección previa (línea 123)
- ✅ Manejo de sesión para persistencia de datos

**Puntuación**: 10/10

---

## Aspectos Adicionales Observados

### Código y Calidad
- ✅ Estructura MVC correctamente implementada
- ✅ Código bien organizado y comentado
- ✅ Uso consistente de命名约定
- ✅ Manejo apropiado de excepciones

### Seguridad Adicional
- ✅ Validación de privilegios de usuario
- ✅ Sesiones seguras implementadas
- ✅ Separación clara de responsabilidades

### Experiencia de Usuario
- ✅ Diseño responsivo con Bootstrap
- ✅ Feedback visual inmediato
- ✅ Navegación intuitiva
- ✅ Formularios bien estructurados

---

## Calificación Final

### Rubrica de Validación (Peso: 50%)
- Título: 10/10
- Autor: 10/10
- Editorial: 10/10
- Precio: 10/10
- Unidades: 10/10
- Fecha Edición: 10/10
- ISBN: 10/10
- Géneros: 10/10

**Subtotal Validación**: 80/80 = **10.0/10**

### Rubrica de Seguridad (Peso: 50%)
- Reglas de validación: 10/10
- Prevención XSS: 10/10
- Prevención CSRF: 10/10
- Placeholders: 10/10
- Accesibilidad: 9/10
- Máscaras: 10/10
- UX Cancelar: 9/10
- Mensajes error: 10/10
- Retroalimentación: 10/10

**Subtotal Seguridad**: 98/100 = **9.8/10**

### Calificación Final
**Validación**: 10.0 × 0.5 = 5.0
**Seguridad**: 9.8 × 0.5 = 4.9
**Nota Final**: **9.9/10**

---

## Comentarios Finales

### Aspectos Excelentes
1. **Implementación completa** de todos los requisitos de validación
2. **Seguridad robusta** con protección CSRF y XSS
3. **Código de calidad** con buena estructura y comentarios
4. **UX bien cuidada** con feedback claro y útil
5. **Validación de negocio** adecuada (claves foráneas, unicidad)

### Mejoras Menores Sugeridas
1. Agregar atributo `aria-describedby` en campos con errores para mejor accesibilidad
2. Considerar transición más suave en la acción de cancelar
3. Posible validación de fecha futura para fecha de edición

### Conclusión
El proyecto de Joel Gómez Benítez demuestra un **excelente dominio** de las técnicas de validación de formularios y seguridad web. La implementación es **casi perfecta**, cumpliendo con todos los requisitos especificados y mostrando buenas prácticas de desarrollo web seguro.

**Calificación: SOBRESALIENTE (9.9/10)**