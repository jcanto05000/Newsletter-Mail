DROP TABLE if exists email;
CREATE TABLE email(
  id int AUTO_INCREMENT,
  nom varchar(50),
  email varchar(75),
  valide boolean,
  erreur smallint,
  PRIMARY KEY(id)
)engine=innodb default charset=utf8;



INSERT INTO email (nom,email,valide,erreur) VALUES
("jessy","jessy.canto.sio@gmail.com",1,0),
("laposte","jessy.canto@laposte.net",1,0),
("gmail","jessy.canto.sio@gmail.com",1,0);
