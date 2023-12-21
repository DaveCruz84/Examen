CREATE TABLE intermedia (
  idintermedia INT AUTO_INCREMENT PRIMARY KEY,
  fechavisualizacion date,
  calificacion INT DEFAULT 0,
  idpelicula INT,
  FOREIGN KEY (idpelicula) REFERENCES pelicula(idpelicula),  
  idusuario INT,
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) 
);