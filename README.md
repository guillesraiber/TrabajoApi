Api URL: https://localhost/TrabajoApi-main/api/libros
Obtiene todos los libros disponibes en la libreria

Get por ID
/TrabajoApi-main/api/libros/ID
Obtiene un libro en especifico segun su id

POST
/TrabajoApi-main/api/libros BODY{'ID_Libro':,'Titulo':'','Autor':'','Genero':'','Editorial':'','Precio':}
Crea un nuevo libro con los datos ingresados por el usuario

DELETE por ID
/TrabajoApi-main/api/libros/ID
Elimina un libro determinado segun el id proporcionado

PUT por ID
/TrabajoApi-main/api/libros/ID
Actualiza un libro segun su id

ORDENAR ASCENDENTE Y/O DESCENDENTE POR PRECIO
Ascendente:
/TrabajoApi-main/api/libros?order=asc&sort=precio
Descendente:
/TrabajoApi-main/api/libros?order=desc&sort=precio

Filtrado POR PRECIO
/TrabajoApi-main/api/libros?filter=precio

Obtener Token
/TrabajoApi-main/api/usuarios/token
Permite al admin obtener un token JWT
Usuario: webadmin
Password: admin
Se envian las credenciales y en basic auth completar los datos.
Si las credenciales son validas se retorna un token el cual luego en 'Bearer token' sera desencriptado y validado.
Si el token es correcto se retornan los datos solicitados.

